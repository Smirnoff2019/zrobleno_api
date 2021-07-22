<?php

namespace App\Schemes\Role;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToImageSchema;
use App\Schemes\Relations\BelongsTo\BelongsToStatusSchema;

interface RoleSchema extends DefaultSchema, BelongsToStatusSchema, BelongsToImageSchema
{

    public const TABLE = 'roles';

    public const COLUMN_SLUG        = 'slug';
    public const COLUMN_NAME        = 'name';
    public const COLUMN_DESCRIPTION = 'description';

}
