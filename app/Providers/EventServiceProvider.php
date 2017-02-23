<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
        'App\Events\ArticleReleased' => [
            'App\Listeners\SendArticleReleasedNotification'
        ],
        'Illuminate\Mail\Events\MessageSending' => [
            'App\Listeners\LogSentMessage'
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }

    protected $subscribe = [
        'App\Handlers\Events\ArticleEventHandler'
    ];
}
