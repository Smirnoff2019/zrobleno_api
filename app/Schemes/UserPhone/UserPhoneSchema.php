<?php

namespace App\Schemes\UserPhone;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToUserSchema;

interface UserPhoneSchema extends DefaultSchema, BelongsToUserSchema
{

    public const TABLE = 'user_phones';
    
    public const COLUMN_PHONE = 'phone'; 

}
