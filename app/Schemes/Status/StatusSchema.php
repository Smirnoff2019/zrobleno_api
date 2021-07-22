<?php

namespace App\Schemes\Status;

use App\Schemes\DefaultSchema;

interface StatusSchema extends DefaultSchema
{

    public const TABLE                  = 'statuses';
    
    public const COLUMN_SLUG            = 'slug';
    public const COLUMN_NAME            = 'name';
    public const COLUMN_DESCRIPTION     = 'description';
    public const COLUMN_TYPE            = 'type';
    public const COLUMN_GROUP           = 'group';

}
