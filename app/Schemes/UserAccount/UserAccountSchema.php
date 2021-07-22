<?php

namespace App\Schemes\UserAccount;

use App\Schemes\DefaultSchema;

interface UserAccountSchema extends DefaultSchema
{

    public const TABLE = 'user_accounts';

    public const COLUMN_USER_ID = 'user_id';
    public const COLUMN_ACCOUNT_ID = 'account_id';

}
