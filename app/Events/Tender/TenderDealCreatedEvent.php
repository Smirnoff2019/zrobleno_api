<?php

namespace App\Events\Tender;

use App\Models\PasswordReset\PasswordReset;
use App\Models\Tender\Tender;
use App\Models\User\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TenderDealCreatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The tender owner
     *
     * @var User
     */
    public $user;

    /**
     * Data from event for notification
     *
     * @var Tender
     */
    public $tender;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Tender $tender, User $user)
    {
        $this->user   = $user;
        $this->tender = $tender;
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
