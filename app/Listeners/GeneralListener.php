<?php

namespace App\Listeners;

use App\Events\GeneralEvent;
use App\Notifications\GeneralNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;


class GeneralListener implements ShouldQueue
{
    
    public $queue = 'api-listeners';

//    public $delay = 10;
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
     * @param  GeneralEvent  $event
     * @return void
     */
    public function handle(GeneralEvent $event)
    {
        $event->user->notify(new GeneralNotification($event->notifyData));
    }
}
