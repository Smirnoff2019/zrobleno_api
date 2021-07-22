<?php

namespace App\Schemes\PortfolioImage;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToImageSchema;
use App\Schemes\Relations\BelongsTo\BelongsToUserSchema;

interface PortfolioImageSchema extends DefaultSchema, BelongsToImageSchema
{

    public const TABLE = 'portfolios_images';

    public const COLUMN_PORTFOLIO_ID = 'portfolio_id';

}
