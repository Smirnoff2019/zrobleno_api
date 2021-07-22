<?php

namespace App\Listeners;

use App\Events\PasswordResetEvent;
use App\Events\PasswordResetSuccessfullyEvent;
use App\Events\Tender\NewParticipant;
use App\Jobs\Tender\ActivateTender;
use App\Notifications\Contractor\NewParticipantSuccessfullyArrivedToTender;
use App\Notifications\Customer\NewParticipantSuccessfullyArrivedToTender as CustomerNewParticipantSuccessfullyArrivedToTender;
use App\Notifications\CustomerRegisteredNotification;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccessfully;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewParticipantEventListener implements ShouldQueue
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
     * @param  NewParticipant  $event
     * @return void
     */
    public function handle(NewParticipant $event)
    {
        $event->user->notifyNow(new NewParticipantSuccessfullyArrivedToTender($event->tender));
        $event->tender->user->notifyNow(new CustomerNewParticipantSuccessfullyArrivedToTender($event->tender));
    
        if($event->tender->participants_count == $event->tender->max_participants) {
            ActivateTender::dispatchNow($event->tender)->onQueue('api-listeners');
        }
    }
    
}
