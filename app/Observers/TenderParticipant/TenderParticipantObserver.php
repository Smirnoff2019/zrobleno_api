<?php

namespace App\Observers\TenderParticipant;

use App\Events\GeneralEvent;
use App\Events\Payments\NewDebitEvent;
use App\Models\Payment\Payment;
use App\Models\Tender\Tender;
use App\Models\TenderParticipant\TenderParticipant;
use App\Models\User\User;
use App\Notifications\NotificationTypes\Tenders\SuccessTenderNotification;

class TenderParticipantObserver
{
    /**
     * Handle the tender participant "created" event.
     *
     * @param  \App\TenderParticipant  $tenderParticipant
     * @return void
     */
    public function created(TenderParticipant $tenderParticipant)
    {
        $tender = Tender::find($tenderParticipant->tender_id);
        
        $title = 'Присоединение к тендеру';
        $content = 'Вы успешно присоеденились к тендеру  № ' . $tender->id;
        $user = User::find($tenderParticipant->user_id);
        event(new GeneralEvent($user, $content, $title, 'https://contractor.zrobleno.com.ua/tender/'.$tender->id, 'tender', $tender->id, 'success', 'tender'));


        
        $tender = Tender::find($tenderParticipant->tender_id);
        $title = 'Присоединение к тендеру';
        $content = 'У вас новый учасник в тендере № ' . $tender->id;
        $customer = $tender->user;
        event(new GeneralEvent($customer, $content, $title, 'https://customer.zrobleno.com.ua/tender/'.$tender->id, 'tender', $tender->id, 'success', 'tender'));

    }

    /**
     * Handle the tender participant "updated" event.
     *
     * @param  \App\TenderParticipant  $tenderParticipant
     * @return void
     */
    public function updated(TenderParticipant $tenderParticipant)
    {
        //
    }

    /**
     * Handle the tender participant "deleted" event.
     *
     * @param  \App\TenderParticipant  $tenderParticipant
     * @return void
     */
    public function deleted(TenderParticipant $tenderParticipant)
    {
        //
    }

    /**
     * Handle the tender participant "restored" event.
     *
     * @param  \App\TenderParticipant  $tenderParticipant
     * @return void
     */
    public function restored(TenderParticipant $tenderParticipant)
    {
        //
    }

    /**
     * Handle the tender participant "force deleted" event.
     *
     * @param  \App\TenderParticipant  $tenderParticipant
     * @return void
     */
    public function forceDeleted(TenderParticipant $tenderParticipant)
    {
        //
    }
}
