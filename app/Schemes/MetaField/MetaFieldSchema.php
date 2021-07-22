<?php

namespace App\Schemes\MetaField;

use App\Schemes\DefaultSchema;

interface MetaFieldSchema extends DefaultSchema
{

    /**
     * table name in database
     */
    const TABLE = 'meta_fields';

    /**
     * columns name in table
     */
    const COLUMN_SLUG         = 'slug';
    const COLUMN_NAME         = 'name';
    const COLUMN_DESCRIPTION  = 'description';
    const COLUMN_OPTIONS      = 'options';

}
