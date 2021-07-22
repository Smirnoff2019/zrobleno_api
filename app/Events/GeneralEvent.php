<?php

namespace App\Events;

use App\Models\NotificationTemplate\NotificationTemplate;
use App\Models\User\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Notifications\NotificationHelper\TemplateParser;

class GeneralEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $content;
    public $title;
    public $user;
    public $action;
    public $notifyData = [];
    public $reason = "";
    public $reason_id = "";
    public $status = "";
    public $type = "";
    public $status_slug = "";
    public $show_content = "";

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $content, $title, $action, $reason, $reson_id, $status, $type)
    {
        $this->user = $user;
        $this->content = $content;
        $this->title = $title;
        $this->action = $action;
        $this->reason = $reason;
        $this->reason_id = $reson_id;
        $this->status = $status;
        $this->type = $type;
        $this->status_slug = $status;
        $this->show_content = $content;

        $this->notifyData = [
            'show_content' => $content,
            'title' => $title,
            'action' => $action,
            'reason' => $reason,
            'reason_id' => $reson_id,
            'status_slug' => $status,
            'type' => $type
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return  [new Channel('notification.'. $this->user->id)];
    }
}
