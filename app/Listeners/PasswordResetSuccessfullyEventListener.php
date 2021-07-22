<?php

namespace App\Listeners;

use App\Events\PasswordResetEvent;
use App\Events\PasswordResetSuccessfullyEvent;
use App\Notifications\CustomerRegisteredNotification;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccessfully;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordResetSuccessfullyEventListener implements ShouldQueue
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
     * @param  PasswordResetSuccessfullyEvent  $event
     * @return void
     */
    public function handle(PasswordResetSuccessfullyEvent $event)
    {
        $event->user->notifyNow(new PasswordResetSuccessfully($event->notifyData));
    }
    
}
