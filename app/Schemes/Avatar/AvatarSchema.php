<?php

namespace App\Schemes\Avatar;

use App\Schemes\DefaultSchema;

interface AvatarSchema extends DefaultSchema
{

    public const TABLE = 'avatars';

    public const COLUMN_NAME      = 'name';
    public const COLUMN_COLOR     = 'color';
    public const COLUMN_GENDER    = 'gender';
    public const COLUMN_GROUP     = 'group';
    public const COLUMN_IMAGE_ID  = 'image_id';
    public const COLUMN_STATUS_ID = 'status_id';

}
