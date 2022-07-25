<?php

namespace App\Listeners;

use App\Events\ImagesEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class ImagesListener
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
     * @param  ImagesEvent  $event
     * @return void
     */
    public function handle(ImagesEvent $event): void
    {
        //TODO  непонтянтно почуму не работает если сразу передать массив на удаление
        foreach ($event->image as $item) {
            Storage::delete($item->storage_link . '/' . $item->name);
        }

    }
}
