<?php

namespace App\Channels;

use BadMethodCallException;
use Illuminate\Notifications\Notification;
use Services\ElasticEmail\ElasticEmailable;

class ElasticEmailChannel
{

    /**
     * Send the given notification.
     * 
     * @param  \App\Models\User\User|Illuminate\Database\Eloquent\Collection[] $notifiable
     * @param  \Illuminate\Notifications\Notification $notification
     * 
     * @throws \BadMethodCallException
     * 
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        if(! method_exists($notification, $method = 'toElastic')) {
            throw new BadMethodCallException(sprintf(
                'Call to undefined method %s() in %s',
                $method,
                static::class
            ));
        }

        ElasticEmailable::send(
            $notifiable,
            $notification->toElastic()
        );
    }

}
