<?php

namespace App\Listeners;

use App\Events\CustomerRegisteredEvent;
use App\Events\PasswordResetEvent;
use App\Notifications\CustomerRegisteredNotification;
use App\Notifications\PasswordResetRequest;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomerRegisteredEventListener implements ShouldQueue
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
     * @param  CustomerRegisteredEvent  $event
     * @return void
     */
    public function handle(CustomerRegisteredEvent $event)
    {
        $event->user->notifyNow(new CustomerRegisteredNotification($event->notifyData));
    }
    
}
