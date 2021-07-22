<?php

namespace App\Schemes\ProjectOption;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToOptionSchema;
use App\Schemes\Relations\BelongsTo\BelongsToProjectSchema;

interface ProjectOptionSchema extends DefaultSchema, BelongsToOptionSchema, BelongsToProjectSchema
{

    public const TABLE = 'project_option';

    public const COLUMN_PROJECT_ROOM_ID        = 'project_room_id';
    public const COLUMN_COUNT                  = 'count';
    public const COLUMN_PRICE                  = 'price';

}
