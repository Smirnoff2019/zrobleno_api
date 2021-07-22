<?php

namespace App\Traits\Eloquent\BelongsTo;

use App\Models\Account\Account;
use App\Schemes\Relations\BelongsTo\BelongsToAccountSchema;

/**
 *  @method account()
 */
trait BelongsToAccount
{

    /**
     * Get the account for the this essence.
     *
     * @return BelongsTo \App\Models\Account\Account
     */
    public function account()
    {
        return $this->belongsTo(
            Account::class,
            BelongsToAccountSchema::COLUMN_ACCOUNT_ID
        );
    }

}
