<?php

namespace App\Notifications\NotificationTypes\Auths;

use App\Notifications\GeneralNotification;

class CommonAuthNotification extends GeneralNotification

{
    protected $status = 'common';
    protected $group = 'auth';

    public function __construct(array $sub_data = [])
    {
        parent::__construct($sub_data);
    }
}
