<?php

namespace App\Schemes\AccountType;

use App\Schemes\DefaultSchema;

interface AccountTypeSchema extends DefaultSchema
{

    public const TABLE = 'account_types';


    public const COLUMN_NAME = 'name';
    public const COLUMN_SLUG = 'slug';
    public const COLUMN_DESCRIPTION = 'description';


}
