<?php

namespace App\Schemes\ImagesGroup;

use App\Schemes\DefaultSchema;

interface ImagesGroupSchema extends DefaultSchema
{

    public const TABLE = 'images_groups';

    const COLUMN_NAME = 'name';

}
