<?php

namespace App\Schemes\Project;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToStatusSchema;
use App\Schemes\Relations\BelongsTo\BelongsToUserSchema;

interface ProjectSchema extends DefaultSchema, BelongsToUserSchema, BelongsToStatusSchema
{

    public const TABLE = 'projects';

    public const COLUMN_TOTAL_AREA            = 'total_area';
    public const COLUMN_TOTAL_PRICE           = 'total_price';
    public const COLUMN_ADDRESS               = 'address';
    public const COLUMN_CITY                  = 'city';
    public const COLUMN_REGION_ID             = 'region_id';
    public const COLUMN_CEILING_HEIGHT_ID     = 'ceiling_height_id';
    public const COLUMN_WALLS_CONDITION_ID    = 'walls_condition_id';
    public const COLUMN_PROPERTY_CONDITION_ID = 'property_condition_id';
    public const COLUMN_COMPONENTS            = 'components';

}
