<?php

namespace App\Schemes\PasswordReset;

use App\Schemes\DefaultSchema;

interface PasswordResetSchema extends DefaultSchema
{

    public const TABLE = 'password_resets';
    
    public const COLUMN_EMAIL = 'email';
    public const COLUMN_TOKEN = 'token';

}
