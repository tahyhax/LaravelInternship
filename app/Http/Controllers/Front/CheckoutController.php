<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutOrderingRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckoutController extends Controller
{

    public function show()
    {
        $products =  app(Cart::class)->productsList();
        $total = $products->sum('total');
        $paymentMethods = PaymentMethod::all();


        return view('front.checkout.show')->with(compact(['products', 'total', 'paymentMethods']));
    }

    public function ordering(CheckoutOrderingRequest $request)
    {

        DB::beginTransaction();

        try {
            //        TODO вынести в сервис
            $cart = app(Cart::class)->list();

            $products = collect($cart)->map(function ($item, $key) {
                return [
                    'product_id' => $key,
                    'quantity' => $item
                ];
            });


            $order = new Order($request->all());
            $order->paymentMethod()->associate($request->get('paymentMethod'));
            $order->user()->associate(auth()->id() ? : null);
            $order->save();
            $order->products()->sync($products);

            //TODO  использовать сервис
            app(Cart::class)->delete();

            DB::commit();



        } catch(\Exception $exception) {

            DB::rollBack();

            //TODO сделать нормльный $exception
            throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
        }

    }
}
