<?php

namespace App\Schemes\MetaFieldsGroups;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToStatusSchema;

interface MetaFieldsGroupsSchema extends DefaultSchema, BelongsToStatusSchema
{

    /**
     * table name in database
     */
    const TABLE = 'meta_fields_groups';

    /**
     * columns name in table
     */
    const COLUMN_NAME = 'name';

}
