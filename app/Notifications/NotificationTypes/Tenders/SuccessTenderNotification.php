<?php

namespace App\Notifications\NotificationTypes\Tenders;
use App\Models\Tender\Tender;
use App\Models\User\User;
use App\Notifications\GeneralNotification;

class SuccessTenderNotification extends GeneralNotification

{
    protected $status = 'success';
    protected $group = 'tenders';
    protected $notifyType = 'tender';


    public function __construct(Tender $payment, User $user, array $contentFields = [], array $sub_data = [] )
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


        event(new \App\Events\Tender\TenderEvent($this->{$this->notifyType}, $this->user, $eventData));

        return $eventData;
    }

}
