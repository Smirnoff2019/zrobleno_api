<?php

namespace App\Schemes\NotificationGroup;

use App\Schemes\DefaultSchema;

interface NotificationGroupSchema extends DefaultSchema
{

    public const TABLE = 'notification_groups';

    public const COLUMN_SLUG          = 'slug';
    public const COLUMN_NAME          = 'name';
    public const COLUMN_DESCRIPTION   = 'description';

}
