<?php

namespace App\Listeners;

use App\Notifications\OrderCreatedNotification;
use Illuminate\Support\Facades\Notification;

class OrderCreatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(object $event): void
    {
        Notification::route('mail', $event->order->email)->notify(new OrderCreatedNotification($event->order));
    }
}
