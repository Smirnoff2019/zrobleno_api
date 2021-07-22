<?php

namespace App\Schemes\Portfolio;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToImageSchema;
use App\Schemes\Relations\BelongsTo\BelongsToStatusSchema;
use App\Schemes\Relations\BelongsTo\BelongsToUserSchema;

interface PortfolioSchema extends DefaultSchema, BelongsToUserSchema, BelongsToImageSchema, BelongsToStatusSchema
{

    public const TABLE = 'portfolios';

    public const COLUMN_NAME        = 'name';
    public const COLUMN_SLUG        = 'slug';
    public const COLUMN_TOTAL_AREA  = 'total_area';
    public const COLUMN_DURATION    = 'duration';
    public const COLUMN_BUDGET      = 'budget';

}
