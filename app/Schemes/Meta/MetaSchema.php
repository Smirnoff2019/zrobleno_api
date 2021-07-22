<?php

namespace App\Schemes\Meta;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToParentSchema;
use App\Schemes\Relations\BelongsTo\BelongsToMetaFieldSchema;

interface MetaSchema extends DefaultSchema, BelongsToParentSchema, BelongsToMetaFieldSchema
{

    /**
     * table name in database
     */
    const TABLE = 'meta';

    /**
     * columns name in table
     */
    const COLUMN_SLUG        = 'slug';
    const COLUMN_NAME        = 'name';
    const COLUMN_DESCRIPTION = 'description';
    const COLUMN_OPTIONS     = 'options';

}
