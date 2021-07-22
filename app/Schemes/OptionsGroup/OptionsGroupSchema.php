<?php

namespace App\Schemes\OptionsGroup;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToImageSchema;
use App\Schemes\Relations\BelongsTo\BelongsToRoomSchema;
use App\Schemes\Relations\BelongsTo\BelongsToStatusSchema;

interface OptionsGroupSchema extends DefaultSchema, BelongsToRoomSchema, BelongsToImageSchema, BelongsToStatusSchema
{

    public const TABLE = 'options_groups';

    public const COLUMN_NAME       = 'name';
    public const COLUMN_SLUG       = 'slug';
    public const COLUMN_SORT       = 'sort';
    public const COLUMN_POSITION_X = 'position_x';
    public const COLUMN_POSITION_Y = 'position_y';
    public const COLUMN_DISPLAY    = 'display';

}
