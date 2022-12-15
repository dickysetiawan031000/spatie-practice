<?php

namespace App\Listeners\Comment;

use App\Events\Comment\CreatedEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreatedListener implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels, Dispatchable;

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CreatedEvent $event)
    {
        //Log Created Comment
        $this->delay(10);
        Log::info('Comment Created Listener Executed Successfully ');
        // sleep(10);
    }
}
