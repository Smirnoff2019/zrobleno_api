<?php

namespace App\Schemes\SupplierCategory;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToStatusSchema;

interface SupplierCategorySchema extends DefaultSchema, BelongsToStatusSchema
{

    public const TABLE = 'suppliers_categories';

    public const COLUMN_NAME = 'name';
    public const COLUMN_SLUG = 'slug';

}
