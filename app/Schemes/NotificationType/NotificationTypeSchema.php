<?php

namespace App\Schemes\NotificationType;

use App\Schemes\DefaultSchema;

interface NotificationTypeSchema extends DefaultSchema
{

    public const TABLE = 'notification_types';

    public const COLUMN_SLUG = 'slug';
    public const COLUMN_NAME = 'name';

}
