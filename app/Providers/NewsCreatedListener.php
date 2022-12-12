<?php

namespace App\Providers;

use App\Providers\NewsCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewsCreatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Providers\NewsCreatedEvent  $event
     * @return void
     */
    public function handle(NewsCreatedEvent $event)
    {
        //
    }
}
