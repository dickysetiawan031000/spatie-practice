<?php

namespace App\Listeners\Comment;

use App\Events\Comment\DeletedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

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
     * @param  object  $event
     * @return void
     */
    public function handle(DeletedEvent $event)
    {
        //Log Deleted Comment
        Log::info('Comment Deleted Successfully');
    }
}
