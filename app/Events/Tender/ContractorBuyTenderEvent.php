<?php

namespace App\Events\Tender;

use App\Events\Payments\NewDebitEvent;
use App\Models\NotificationTemplate\NotificationTemplate;
use App\Models\Payment\Payment;
use App\Models\Tender\Tender;
use App\Models\User\User;
use App\Notifications\GeneralNotification;
use App\Notifications\NotificationHelper\TemplateParser;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContractorBuyTenderEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public  $user;
    private $model;
    private $notification_name;
    private $content;

    public  $show_content;
    public  $title;
    public  $status_slug;
    public  $action;
    public  $type;
    public  $reason_id;
    public  $reason;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Tender $tender, string $notification_name = "contractor_join_tender", string $status_slug = "success")
    {
        $this->user  = $user;
        $this->model = $tender;

        $this->notification_name = $notification_name;
        $this->status_slug = $status_slug;

        $this->content = NotificationTemplate::template($this->notification_name, $this->status_slug)->first();

        $template = new TemplateParser($this->content->content, ['id' => $this->model->id]);

        $this->reason_id =  $this->tender->id;
        $this->reason    =  'tender';
        $this->title     =  $this->content->name;
        $this->action    =  'https://contractor.zrobleno.com.ua/tender/'.$this->model->id;

        $this->show_content = $template->getContent();

        $data = [
            'title' => $this->title,
            'show_content' => $this->show_content,
            'status_slug'  => $this->status_slug,
            'action'  => $this->action,
            'reason'  => $this->reason,
            'reason_id' => $this->reason_id
        ];


        $this->user->notify(new GeneralNotification($data));


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
