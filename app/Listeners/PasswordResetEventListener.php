<?php

namespace App\Listeners;

use App\Events\PasswordResetEvent;
use App\Notifications\PasswordResetRequest;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordResetEventListener implements ShouldQueue
{

    public $queue = 'api-listeners';

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
     * @param  PasswordResetEvent  $event
     * @return void
     */
    public function handle(PasswordResetEvent $event)
    {
        $event->user->notifyNow(new PasswordResetRequest($event->notifyData));
    }
    
}
