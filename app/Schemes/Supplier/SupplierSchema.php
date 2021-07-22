<?php

namespace App\Schemes\Supplier;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToImageSchema;
use App\Schemes\Relations\BelongsTo\BelongsToStatusSchema;

interface SupplierSchema extends DefaultSchema, BelongsToImageSchema, BelongsToStatusSchema
{

    public const TABLE = 'suppliers';

    public const COLUMN_NAME         = 'name';
    public const COLUMN_DESCRIPTION  = 'description';
    public const COLUMN_CATALOG_URL  = 'catalog_url';

}
