<?php

namespace App\Schemes\Room;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToImageSchema;
use App\Schemes\Relations\BelongsTo\BelongsToStatusSchema;

interface RoomSchema extends DefaultSchema, BelongsToStatusSchema, BelongsToImageSchema
{

    public const TABLE = 'rooms';

    public const COLUMN_NAME          = 'name';
    public const COLUMN_SLUG          = 'slug';
    public const COLUMN_SORT          = 'sort';
    public const COLUMN_MAX_COUNT     = 'max_count';
    public const COLUMN_DEFAULT_COUNT = 'default_count';

}
