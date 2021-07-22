<?php

namespace App\Listeners;

use App\Events\Tender\ConfirmTenderApplicationEvent;
use App\Models\User\Contractor\Contractor;
use App\Models\User\User;
use App\Notifications\GeneralNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class TenderApplicationChangeStatusSubscriber implements ShouldQueue
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

    public function handleConfirmTenderApplication($event)
    {
        $data = [
            'title' => "Нове замовлення №{$event->tender->uid}",
            'show_content' => "Було додано нове замовлення, поспішайте взяти участь !",
            'status_slug'  => 'information',
            'action'  => 'https://contractor.zrobleno.com.ua/tenders',
            'reason'  => 'tender',
            'reason_id' => $event->tender->id,
            'type' => 'tender'
        ];

        $users = User::contractor()->get();

        Notification::send($users, new GeneralNotification($data));

    }

    public function subscribe ($events) {
        $events->listen(
            ConfirmTenderApplicationEvent::class,
            'App\Listeners\TenderApplicationChangeStatusSubscriber@handleConfirmTenderApplication'
        );
    }
}
