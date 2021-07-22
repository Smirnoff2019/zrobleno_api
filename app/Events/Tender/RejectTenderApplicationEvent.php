<?php

namespace App\Events\Tender;

use App\Models\Tender\Tender;
use App\Models\User\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RejectTenderApplicationEvent implements ShouldBroadcast
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
    public function __construct(Tender $tender)
    {
        $this->user   = $tender->customer;
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
