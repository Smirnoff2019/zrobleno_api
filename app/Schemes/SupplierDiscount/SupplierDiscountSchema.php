<?php

namespace App\Schemes\SupplierDiscount;

use App\Schemes\DefaultSchema;
use App\Schemes\TimestampExpiratedSchema;
use App\Schemes\Relations\BelongsTo\BelongsToRoleSchema;
use App\Schemes\Relations\BelongsTo\BelongsToStatusSchema;
use App\Schemes\Relations\BelongsTo\BelongsToSupplierSchema;

interface SupplierDiscountSchema extends DefaultSchema, TimestampExpiratedSchema, BelongsToRoleSchema, BelongsToStatusSchema, BelongsToSupplierSchema
{

    public const TABLE = 'suppliers_discounts';

    public const COLUMN_VALUE = 'value';

}
