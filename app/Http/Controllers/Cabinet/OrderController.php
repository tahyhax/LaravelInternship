<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * @var integer
     */
    const PERPAGE = 10;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $orders = Order::query()
            ->whereHas(
                'user', function ($query) {
                $query->where('id', Auth::id());
            })
            ->with('paymentMethod')
            ->paginate(self::PERPAGE);

        return view('cabinet.orders.index')->with(['orders' => $orders]);
    }

    /**
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Order $order)
    {
        return view('cabinet.orders.show')->with([
            'order' => $order->load(['paymentMethod']),
            'products' => $order->products()->paginate(self::PERPAGE)
        ]);
    }
}
