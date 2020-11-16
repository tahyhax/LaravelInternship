<?php

namespace App\Observers;

use App\Models\Order;
use App\Notifications\OrderCreatedNotification;
use App\Notifications\OrderUpdatedNotification;
use Illuminate\Support\Facades\Notification;

class OrderObserver
{

    /**
     * Handle the order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        Notification::route('mail', $order->email)->notify(new OrderUpdatedNotification($order));
    }

}
