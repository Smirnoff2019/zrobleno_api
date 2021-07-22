<?php

namespace App\Schemes\Category;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToUserSchema;
use App\Schemes\Relations\BelongsTo\BelongsToImageSchema;
use App\Schemes\Relations\BelongsTo\BelongsToParentSchema;
use App\Schemes\Relations\BelongsTo\BelongsToStatusSchema;

interface CategorySchema extends DefaultSchema, BelongsToStatusSchema, BelongsToUserSchema, BelongsToImageSchema, BelongsToParentSchema
{

    /**
     * table name in database
     */
    const TABLE = 'categories';

    /**
     * columns name in table
     */
    const COLUMN_SLUG        = 'slug';
    const COLUMN_NAME        = 'name';
    const COLUMN_DESCRIPTION = 'description';

}
