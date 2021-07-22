<?php

namespace App\Traits\Models\User;



use App\Models\Payment\Payment;
use App\Models\Status\Status;

trait UserTenderParticipant
{
    public function minusFromMainAccount ($price, $tender_id)
    {
        $account = $this->accountMain()->first();
        $remainder = ($account && $account->balance > 0) ?
            $this->calculate($price, $account->balance, 0, $tender_id) :
            $price;

        $account->update([Payment::COLUMN_BALANCE => $remainder == 0 ?  $account->balance - $price :
            ($price - $remainder) - $account->balance
        ]);

        return $remainder;
    }

    public function calculate ($price, $balance, $is_bonus = 0, $tender_id) {

        $remainder = $balance >= $price ? 0 : $price - $balance;
        $status = Status::where(Status::COLUMN_TYPE,'approved')->where(Status::COLUMN_GROUP, 'payments')->first();
        Payment::create(
            [
                Payment::COLUMN_VALUE => $price - $remainder,
                Payment::COLUMN_BALANCE => $balance,
                Payment::COLUMN_TYPE => 'debit',
                Payment::COLUMN_ACCOUNT_ID => request()->user()->account->id,
                Payment::COLUMN_STATUS_ID => $status->id,
                Payment::COLUMN_ORDER_REFERENCE => time() . request()->user()->id,
                Payment::COLUMN_IS_BONUS => $is_bonus,
                'tender_id' => $tender_id
            ]
        );
        return $remainder;
    }

    public function minusFromBonusAccount ($price, $tender_id)
    {
        $account = $this->accountBonus()->first();

        if(!$account || ( $account && $account->balance <= 0)) return $price;

        $remainder = $this->calculate($price, $account->balance, 1, $tender_id);

        $account->update([Payment::COLUMN_BALANCE=> $remainder == 0 ?  $account->balance - $price :
            ($price - $remainder) - $account->balance
        ]);

        return $remainder;
    }

}
