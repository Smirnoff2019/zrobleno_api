<?php

namespace App\Schemes\Category;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToCategorySchema;

interface CategoryableSchema extends DefaultSchema, BelongsToCategorySchema
{

    /**
     * table name in database
     */
    const TABLE = 'categoryables';

}
