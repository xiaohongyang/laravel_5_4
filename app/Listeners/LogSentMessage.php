<?php

namespace App\Listeners;

use Illuminate\Mail\Events\MessageSending;
use IlluminateMailEventsMessageSending;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogSentMessage
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
     * @param  IlluminateMailEventsMessageSending  $event
     * @return void
     */
    public function handle(MessageSending $event)
    {
        //
        info($event->message->getBody());
    }
}
