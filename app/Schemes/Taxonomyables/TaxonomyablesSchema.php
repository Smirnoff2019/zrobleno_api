<?php

namespace App\Schemes\Taxonomyables;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToTaxonomySchema;

interface TaxonomyablesSchema extends DefaultSchema, BelongsToTaxonomySchema
{

    /**
     * table name in database
     */
    const TABLE = 'taxonomyables';

}
