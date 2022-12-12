<?php

namespace App\Providers;

use App\Events\Comment\CreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreatedListener
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
     * @param  \App\Events\Comment\CreatedEvent  $event
     * @return void
     */
    public function handle(CreatedEvent $event)
    {
        //
    }
}
