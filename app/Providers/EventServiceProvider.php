<?php

namespace App\Providers;

use App\Events\ImagesEvent;
use App\Events\OrderCreatedEvent;
use App\Listeners\ImagesListener;
use App\Listeners\OrderCreatedListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ImagesEvent::class => [
            ImagesListener::class
        ],
        OrderCreatedEvent::class => [
            OrderCreatedListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
