<?php

namespace App\Listeners\News;

use App\Events\News\CreatedEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreatedListener implements ShouldQueue
{
    use InteractsWithQueue, Dispatchable, SerializesModels, Queueable;

    public function handle(CreatedEvent $event)
    {
        $this->delay(10);
        Log::info('News Created Listener Executed Successfully ');
    }
}
