<?php

namespace App\Providers;

use App\Providers\UpdatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdatedListener
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
     * @param  \App\Providers\UpdatedEvent  $event
     * @return void
     */
    public function handle(UpdatedEvent $event)
    {
        //
    }
}
