<?php

namespace App\Schemes\User;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToRoleSchema;
use App\Schemes\Relations\BelongsTo\BelongsToImageSchema;
use App\Schemes\Relations\BelongsTo\BelongsToStatusSchema;
use App\Schemes\Relations\BelongsTo\BelongsToAccountSchema;
use App\Schemes\Relations\BelongsTo\BelongsToAvatarSchema;

interface UserSchema extends DefaultSchema, BelongsToImageSchema, BelongsToStatusSchema, BelongsToRoleSchema, BelongsToAccountSchema, BelongsToAvatarSchema
{

    public const TABLE = 'users';

    public const COLUMN_FIRST_NAME        = 'first_name';         // имя
    public const COLUMN_MIDDLE_NAME       = 'middle_name';        // Отчество
    public const COLUMN_LAST_NAME         = 'last_name';          // Фамилия
    public const COLUMN_GENDER            = 'gender';
    public const COLUMN_PHONE             = 'phone';
    public const COLUMN_EMAIL             = 'email';
    public const COLUMN_EMAIL_VERIFIED_AT = 'email_verified_at';
    public const COLUMN_REMEMBER_TOKEN    = 'remember_token';
    public const COLUMN_PASSWORD          = 'password';

}
