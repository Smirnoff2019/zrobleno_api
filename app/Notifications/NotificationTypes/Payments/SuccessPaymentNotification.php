<?php

namespace App\Notifications\NotificationTypes\Payments;

use App\Models\Payment\Payment;
use App\Models\User\User;
use App\Notifications\GeneralNotification;
use App\Notifications\NotificationHelper\TemplateParser;


class SuccessPaymentNotification extends GeneralNotification

{
    protected $status = 'success';
    protected $group = 'payments';
    protected $notifyType = 'payment';

    public function __construct(Payment $payment, User $user, array $contentFields = [], array $sub_data = [] )
    {
        parent::__construct( $payment, $user, $contentFields, $sub_data);
    }

    public function toArray($notifiable)
    {
        $data = $this->dataWrapper->getDatabaseData();

//        $content = new TemplateParser($data['content'], $this->fields);

        $eventData = [
            'title'     => $this->fields['title'],
            'content'   => $this->fields['content'],
            'sub_data'  => json_encode($this->sub_data),
            'status'    => $this->status
        ];


        event(new \App\Events\Payments\NewPaymentEvent($this->{$this->notifyType}, $this->user, $eventData));

        return $eventData;
    }



}
