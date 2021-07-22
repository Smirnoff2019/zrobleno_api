<?php

namespace App\Listeners;

use App\Events\ContractorRegisteredEvent;
use App\Events\CustomerRegisteredEvent;
use App\Events\PasswordResetEvent;
use App\Notifications\ContractorSuccessfullyRegisteredNotification;
use App\Notifications\CustomerRegisteredNotification;
use App\Notifications\PasswordResetRequest;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContractorRegisteredEventListener implements ShouldQueue
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
     * @param  ContractorRegisteredEvent  $event
     * @return void
     */
    public function handle(ContractorRegisteredEvent $event)
    {
        $event->user->notifyNow(new ContractorSuccessfullyRegisteredNotification($event->notifyData));
    }
    
}
