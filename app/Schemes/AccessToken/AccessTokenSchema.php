<?php

namespace App\Schemes\AccessToken;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToUserSchema;

interface AccessTokenSchema extends DefaultSchema, BelongsToUserSchema
{

    /**
     * table name in database
     */
    const TABLE = 'access_tokens';

    /**
     * columns name in table
     */
    const COLUMN_GROUP  = 'group';
    const COLUMN_TOKEN  = 'token';
    const COLUMN_ACTIVE = 'active';

}
