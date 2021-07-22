<?php

namespace App\Schemes\ProjectRoom;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToRoomSchema;
use App\Schemes\Relations\BelongsTo\BelongsToProjectSchema;

interface ProjectRoomSchema extends DefaultSchema, BelongsToRoomSchema, BelongsToProjectSchema
{

    public const TABLE             = 'project_room';

    public const COLUMN_AREA       = 'area';

}
