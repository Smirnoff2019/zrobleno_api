<?php

namespace App\Schemes\SupplierCategory;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToSupplierCategorySchema;
use App\Schemes\Relations\BelongsTo\BelongsToSupplierSchema;

interface SupplierCategoryPivotSchema extends DefaultSchema, BelongsToSupplierCategorySchema, BelongsToSupplierSchema
{

    public const TABLE = 'supplier_suppliers_categories';

}
