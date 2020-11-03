<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutOrderingRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Services\Cart\CartService;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckoutController extends Controller
{
    /**
     * @var CartService $cartService
     */
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function show()
    {
        $products = $this->cartService->productsList();
        $total = $products->sum('total');
        $paymentMethods = PaymentMethod::all();


        return view('front.checkout.show')->with(compact(['products', 'total', 'paymentMethods']));
    }

    public function ordering(CheckoutOrderingRequest $request)
    {

        DB::beginTransaction();

        try {

            //NOTE сомнительная штука !!
            $cartList = $this->cartService->productsList();

            $products = collect($cartList)->map(function ($item) {
                return [
                    'product_id' => $item->id,
                    'qty' => $item->qty
                ];
            });

            $order = new Order($request->all());
            $order->paymentMethod()->associate($request->get('paymentMethod'));
            $order->user()->associate(auth()->id() ? : null);
            $order->save();
            $order->products()->sync($products);

            $this->cartService->delete();

            DB::commit();

        } catch(\Exception $exception) {

            DB::rollBack();

            //TODO сделать нормльный $exception
            throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
        }

    }
}
