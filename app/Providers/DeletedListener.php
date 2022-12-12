<?php

namespace App\Providers;

use App\Providers\DeletedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeletedListener
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
     * @param  \App\Providers\DeletedEvent  $event
     * @return void
     */
    public function handle(DeletedEvent $event)
    {
        //
    }
}
