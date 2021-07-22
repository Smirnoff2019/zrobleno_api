<?php

namespace App\Notifications\NotificationTypes\Payments;

use App\Models\Payment\Payment;
use App\Models\User\User;
use App\Notifications\GeneralNotification;

class ErrorPaymentNotification extends GeneralNotification

{
    protected $status = 'error';
    protected $group = 'payments';

    public function __construct(array $sub_data = [], array $fields = [], Payment $payment, User $user)
    {
        parent::__construct($sub_data, $fields, $payment, $user);
    }
}
