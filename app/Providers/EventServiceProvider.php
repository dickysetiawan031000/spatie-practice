<?php

namespace App\Providers;

use App\Events\Comment\CreatedEvent;
use App\Events\Comment\DeletedEvent;
use App\Events\Comment\GetEvent;
use App\Events\Comment\UpdatedEvent;
use App\Events\News\CreatedEvent as NewsCreatedEvent;
use App\Events\News\DeletedEvent as NewsDeletedEvent;
use App\Events\News\GetEvent as NewsGetEvent;
use App\Events\News\UpdatedEvent as NewsUpdatedEvent;
use App\Listeners\Comment\CreatedListener;
use App\Listeners\Comment\DeletedListener;
use App\Listeners\Comment\GetListener;
use App\Listeners\Comment\UpdatedListener;
use App\Listeners\News\DeletedListener as NewsDeletedListener;
use App\Listeners\News\GetListener as NewsGetListener;
use App\Listeners\News\UpdatedListener as NewsUpdatedListener;
use App\Listeners\NewsCreatedListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        // ------------------ COMMENT ------------------ //

        //Comment Get Event
        GetEvent::class => [
            GetListener::class,
        ],

        //Comment Created Event
        CreatedEvent::class => [
            CreatedListener::class,
        ],

        //Comment Updated Event
        UpdatedEvent::class => [
            UpdatedListener::class,
        ],

        //Comment Deleted Event
        DeletedEvent::class => [
            DeletedListener::class,
        ],

        // //Comment Deleted Event
        // DeletedEvent::class => [
        //     DeletedListener::class,
        // ],

        // //Comment Updated Event
        // UpdatedEvent::class => [
        //     UpdatedListener::class,
        // ],

        // ------------------ NEWS ------------------ //

        //News Get Event
        NewsGetEvent::class => [
            NewsGetListener::class,
        ],

        //News Created Event
        NewsCreatedEvent::class => [
            NewsCreatedListener::class,
        ],

        //News Updated Event
        NewsUpdatedEvent::class => [
            NewsUpdatedListener::class,
        ],

        //News Deleted Event
        NewsDeletedEvent::class => [
            NewsDeletedListener::class,
        ],

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
