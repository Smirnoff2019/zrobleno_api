<?php

namespace App\Schemes\Option;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToImageSchema;
use App\Schemes\Relations\BelongsTo\BelongsToRoomSchema;
use App\Schemes\Relations\BelongsTo\BelongsToStatusSchema;
use App\Schemes\Relations\BelongsTo\BelongsToOptionsGroupSchema;

interface OptionSchema extends DefaultSchema, BelongsToStatusSchema, BelongsToImageSchema, BelongsToRoomSchema, BelongsToOptionsGroupSchema
{

    public const TABLE = 'options';

    public const COLUMN_NAME         = 'name';
    public const COLUMN_SLUG         = 'slug';
    public const COLUMN_DESCRIPTION  = 'description';
    public const COLUMN_MIDDLEWARES  = 'middlewares';
    public const COLUMN_PRICE        = 'price';
    public const COLUMN_COEFFICIENT  = 'coefficient';
    public const COLUMN_QUANTITY     = 'quantity';
    public const COLUMN_DISPLAY      = 'display';
    public const COLUMN_FORMULA_NAME = 'formula_name';
    public const COLUMN_DEFAULT      = 'default';
    public const COLUMN_SORT         = 'sort';
    
}
