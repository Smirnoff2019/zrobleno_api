<?php

namespace App\Schemes\NotificationTemplate;

use App\Schemes\DefaultSchema;

interface NotificationTemplateSchema extends DefaultSchema
{

    public const TABLE = 'notification_templates';

    public const COLUMN_NAME        = 'name';
    public const COLUMN_SLUG        = 'slug';
    public const COLUMN_CONTENT     = 'content';
    public const COLUMN_GROUP_SLUG  = 'group_slug';

    public const COLUMN_COVER_ID    = 'cover_id';
    public const COLUMN_NOTIFICATION_NAME = 'notification_name';
    public const COLUMN_STATUS_SLUG = 'status_slug';

//    public const COLUMN_TYPE_SLUG   = 'type_slug';
}
