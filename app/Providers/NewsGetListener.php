<?php

namespace App\Providers;

use App\Providers\NewsGetEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewsGetListener
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
     * @param  \App\Providers\NewsGetEvent  $event
     * @return void
     */
    public function handle(NewsGetEvent $event)
    {
        //
    }
}
