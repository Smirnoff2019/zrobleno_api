<?php

namespace App\Schemes\Metables;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToMetaSchema;
use App\Schemes\Relations\BelongsTo\BelongsToMetablesSchema;

interface MetablesSchema extends DefaultSchema, BelongsToMetaSchema, BelongsToMetablesSchema
{

    /**
     * table name in database
     */
    const TABLE = 'metables';

    /**
     * columns name in table
     */
    const COLUMN_VALUE  = 'value';
    const COLUMN_ACTION = 'action';

}
