<?php

namespace App\Listeners;

use App\Events\Tender\ConfirmRestartTenderApplicationEvent;
use App\Events\Tender\ConfirmTenderApplicationEvent;
use App\Events\Tender\NewTenderRestartApplicationCreatedEvent;
use App\Events\Tender\RejectRestartTenderApplicationEvent;
use App\Events\Tender\RejectTenderApplicationEvent;
use App\Notifications\CreatedNewTenderRestartApplicationNotification;
use App\Notifications\TenderRestartApplicationConfirmedNotification;
use App\Notifications\TenderRestartApplicationRejectedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class TenderRestartApplicationStatusChangeSubscriber implements ShouldQueue
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
     * Handle tender change status events.
     *
     * @param  NewTenderRestartApplicationCreatedEvent $event
     * @return void
     */
    public function handleNewTenderRestartApplicationCreated($event) 
    {
        $event->user->notifyNow(new CreatedNewTenderRestartApplicationNotification($event->tender));
    }

    /**
     * Handle tender change status events.
     *
     * @param  RejectRestartTenderApplicationEvent $event
     * @return void
     */
    public function handleRejectTenderRestartApplication($event) 
    {
        $event->user->notifyNow(new TenderRestartApplicationRejectedNotification($event->tender));
    }

    /**
     * Handle tender change status events.
     *
     * @param  ConfirmRestartTenderApplicationEvent $event
     * @return void
     */
    public function handleConfirmTenderRestartApplication($event) 
    {
        $event->user->notifyNow(new TenderRestartApplicationConfirmedNotification($event->tender));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            NewTenderRestartApplicationCreatedEvent::class,
            self::class.'@handleNewTenderRestartApplicationCreated'
        );
        
        $events->listen(
            RejectRestartTenderApplicationEvent::class,
            self::class.'@handleRejectTenderRestartApplication'
        );
        
        $events->listen(
            ConfirmRestartTenderApplicationEvent::class,
            self::class.'@handleConfirmTenderRestartApplication'
        );
    }
    
}
