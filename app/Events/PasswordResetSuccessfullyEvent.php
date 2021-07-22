<?php

namespace App\Events;

use App\Models\PasswordReset\PasswordReset;
use App\Models\User\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PasswordResetSuccessfullyEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * User password reset model
     *
     * @var User
     */
    public $user;

    /**
     * Data from event for notification
     *
     * @var array
     */
    public $notifyData;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $data = [])
    {
        $this->user       = $user;
        $this->notifyData = $data;
    }
    
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return [];
    }

}
