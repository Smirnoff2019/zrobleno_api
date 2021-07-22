<?php

namespace App\Events\Payments;

use App\Models\NotificationTemplate\NotificationTemplate;
use App\Models\Payment\Payment;
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

class RefillPaymentEvent implements ShouldBroadcast
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
    public function  __construct(User $user, Payment $payment, string $notification_name = "refill_payment", string $status_slug = "success")
    {
        $this->user   = $user;
        $this->model = $payment;

        $this->status_slug = $status_slug;
        $this->notification_name = $notification_name;

        $this->content = NotificationTemplate::template($this->notification_name, $this->status_slug)->first();

        $template = new TemplateParser($this->content->content, ['value' => $this->model->value]);

        $this->reason_id =  $this->model->id;
        $this->reason    =  'payment';
        $this->title     =  $this->content->name;
        $this->action    =  'https://contractor.zrobleno.com.ua/refill';

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

    public function broadcastOn()
    {
        return  [new Channel('notification.'. $this->user->id)];
    }

}
