<?php

namespace App\Schemes\Account;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToStatusSchema;

interface AccountSchema extends DefaultSchema, BelongsToStatusSchema
{

    /**
     * table name in database
     */
    const TABLE = 'accounts';

    /**
     * columns name in table
     */
    const COLUMN_PID            = 'pid';
    const COLUMN_BALANCE        = 'balance';
    const COLUMN_ACCOUNT_TYPE   = 'account_type';
    const COLUMN_USER_ID        = 'user_id';

}
