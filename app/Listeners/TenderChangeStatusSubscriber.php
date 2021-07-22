<?php

namespace App\Listeners;

use App\Events\Tender\ConfirmTenderApplicationEvent;
use App\Events\Tender\RejectTenderApplicationEvent;
use App\Events\Tender\TenderActivation;
use App\Events\Tender\TenderDealConfirmEvent;
use App\Events\Tender\TenderDealCreatedEvent;
use App\Models\User\User;
use App\Notifications\GeneralNotification;
use App\Notifications\HasNewDealNotification;
use App\Notifications\NewAvailableTenderNotification;
use App\Notifications\ShareCustomerDataNotification;
use App\Notifications\TenderActivationNotification;
use App\Notifications\TenderApplicationConfirmedNotification;
use App\Notifications\TenderApplicationRejectedNotification;
use App\Notifications\TenderDealConfirmedNotification;
use App\Notifications\TenderDealCreatedNotification;
use App\Notifications\TenderDealRejectedNotification;
use App\Traits\Logs\Loger;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class TenderChangeStatusSubscriber implements ShouldQueue
{

    use Loger;

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
     * Handle tender change status events.
     *
     * @param  TenderActivation $event
     * @return void
     */
    public function handleTenderActivation($event)
    {
        $event->user->notifyNow(new TenderActivationNotification($event->tender));

        $users = $event->tender->participants;

        if(!empty($users)) {
            Notification::send($users, new ShareCustomerDataNotification($event->tender));
        }
    }

    /**
     * Handle tender change status events.
     *
     * @param  RejectTenderApplicationEvent $event
     * @return void
     */
    public function handleRejectTenderApplication($event)
    {
        $event->user->notifyNow(new TenderApplicationRejectedNotification($event->tender));
    }

    /**
     * Handle tender change status events.
     *
     * @param  ConfirmTenderApplicationEvent $event
     * @return void
     */
    public function handleConfirmTenderApplication($event)
    {
        $event->user->notifyNow(new TenderApplicationConfirmedNotification($event->tender));
    }

    /**
     * Handle tender change status events.
     *
     * @param  TenderDealConfirmEvent $event
     * @return void
     */
    public function handleConfirmTenderDeal($event)
    {
        $event->user->notifyNow(new TenderDealConfirmedNotification($event->tender));
    }

    /**
     * Handle tender change status events.
     *
     * @param  TenderDealRejectEvent $event
     * @return void
     */
    public function handleRejectedTenderDeal($event)
    {
        $event->user->notifyNow(new TenderDealRejectedNotification($event->tender));
    }

    /**
     * Handle tender change status events.
     *
     * @param  TenderDealCreatedEvent $event
     * @return void
     */
    public function handleCreateTenderDeal($event)
    {
        $event->tender->user->notifyNow(new TenderDealCreatedNotification($event->tender));
        $event->user->notifyNow(new HasNewDealNotification($event->tender));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            TenderActivation::class,
            'App\Listeners\TenderChangeStatusSubscriber@handleTenderActivation'
        );

        $events->listen(
            RejectTenderApplicationEvent::class,
            'App\Listeners\TenderChangeStatusSubscriber@handleRejectTenderApplication'
        );

        $events->listen(
            ConfirmTenderApplicationEvent::class,
            'App\Listeners\TenderChangeStatusSubscriber@handleConfirmTenderApplication'
        );

        $events->listen(
            TenderDealConfirmEvent::class,
            'App\Listeners\TenderChangeStatusSubscriber@handleConfirmTenderDeal'
        );

        $events->listen(
            TenderDealRejectEvent::class,
            'App\Listeners\TenderChangeStatusSubscriber@handleRejectedTenderDeal'
        );

        $events->listen(
            TenderDealCreatedEvent::class,
            'App\Listeners\TenderChangeStatusSubscriber@handleCreateTenderDeal'
        );
    }

}
