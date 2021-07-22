<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use App\Services\Telegram\TelegramSms;

class TelegramChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toTelegram($notifiable);

        (new TelegramSms())->sendRequest(
            $message->getUser(),
            $message->getContent(),
            $message->getAction()
        );
    }
}
