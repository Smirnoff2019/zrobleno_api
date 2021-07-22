<?php

namespace App\Schemes\ProjectPropertyCondition;

use App\Schemes\DefaultSchema;

interface ProjectPropertyConditionSchema extends DefaultSchema
{

    public const TABLE              = 'project_property_condition';

    public const COLUMN_NAME        = 'name';
    public const COLUMN_SLUG        = 'slug';
    
    public const COLUMN_STATUS_ID   = 'status_id';

}
