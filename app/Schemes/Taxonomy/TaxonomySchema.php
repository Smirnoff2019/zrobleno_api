<?php

namespace App\Schemes\Taxonomy;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToStatusSchema;

interface TaxonomySchema extends DefaultSchema, BelongsToStatusSchema
{

    /**
     * table name in database
     */
    const TABLE = 'taxonomies';

    /**
     * columns name in table
     */
    const COLUMN_SLUG        = 'slug';
    const COLUMN_NAME        = 'name';
    const COLUMN_DESCRIPTION = 'description';

}
