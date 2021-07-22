<?php

namespace App\Schemes\NotificationButton;

use App\Schemes\DefaultSchema;

interface NotificationButtonSchema extends DefaultSchema
{

    public const TABLE = 'notification_buttons';

    public const COLUMN_NAME    = 'name';
    public const COLUMN_URL     = 'url';
    public const COLUMN_TYPE    = 'type';
    public const COLUMN_SERVICE = 'service';

}
