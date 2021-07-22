<?php

namespace App\Observers\Payment;

use App\Events\GeneralEvent;
use App\Models\Payment\Payment;
use App\Models\Status\Status;
use App\Models\Tender\Tender;
use App\Models\User\User;
use App\Notifications\NotificationTypes\Payments\InformationPaymentNotification;
use App\Notifications\NotificationTypes\Payments\SuccessPaymentNotification;
use phpDocumentor\Reflection\Types\Boolean;

class PaymentObserver
{
    /**
     * Handle the payment "created" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function created(Payment $payment)
    {

        $account = $payment->account;
        $user = User::find($account->user_id);
        $tender = Tender::find($payment->tender_id);

        if($payment->type === 'debit') $this->debitNotification($payment, $user, $tender);

        if($payment->type === 'refill') $this->pendingReffillNotification($payment, $user);


    }

    /**
     * Handle the payment "updated" event.
     *
     * @param  \App\Models\Payment\Payment  $payment
     * @return void
     */
    public function updated(Payment $payment)
    {
        $account = $payment->account;
        $user = User::find($account->user_id);
        $tender = Tender::find($payment->tender_id);

        if($payment->type === 'refill') $this->reffillNotification($payment, $user);

    }

    /**
     * Handle the payment "deleted" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function deleted(Payment $payment)
    {
        //
    }

    /**
     * Handle the payment "restored" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function restored(Payment $payment)
    {
        //
    }

    /**
     * Handle the payment "force deleted" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function forceDeleted(Payment $payment)
    {
        //
    }

    private function debitNotification (Payment $payment, User $user, $tender = null)
    {
        $content = 'Списание со счёта на сумму ' . $payment->value . ' грн';
        $title = 'Участие в тендере';

        event(new GeneralEvent($user, $content, $title, 'https://contractor.zrobleno.com.ua/refill', 'tender', $tender->id, 'success', 'payment'));

    }

    private function pendingReffillNotification (Payment $payment, User $user)
    {
        $content = 'Зафіксована спроба поповнення рахунку ' . $payment->value . ' грн';
        $title = 'Поповнення рахунку';

        event(new GeneralEvent($user, $content, $title, 'https://contractor.zrobleno.com.ua/refill', '', '', 'information', 'payment'));

    }

    private function reffillNotification (Payment $payment, User $user) {
        $title = 'Пополнение счёта';

        if($payment->status->slug === 'approved'){
            $content = 'Вам зачисленно ' . $payment->value . ' грн';
            event(new GeneralEvent($user, $content, $title, 'https://contractor.zrobleno.com.ua/refill', '', '', 'success', 'payment'));

        }else if ($payment->status->slug === 'pending') {
            $content = 'Платёж в ожидании подтверждения от банка ' . $payment->value . ' грн';
            event(new GeneralEvent($user, $content, $title, 'https://contractor.zrobleno.com.ua/refill', '', '', 'information', 'payment'));

        }




    }
}
