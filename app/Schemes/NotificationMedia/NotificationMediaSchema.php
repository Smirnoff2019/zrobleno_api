<?php

namespace App\Schemes\NotificationMedia;

use App\Schemes\DefaultSchema;

interface NotificationMediaSchema extends DefaultSchema
{

    public const TABLE = 'notification_medias';

    public const COLUMN_NAME        = 'name';
    public const COLUMN_MEDIA_TYPE  = 'media_type';
    public const COLUMN_MEDIA_ID    = 'media_id';
    public const COLUMN_TEMPLATE_ID = 'template_id';
    public const MORPHS_MEDIA       = 'media';
}
