<?php

namespace App\Schemes\PostType;

use App\Schemes\DefaultSchema;

interface PostTypeSchema extends DefaultSchema
{

    /**
     * table name in database
     */
    const TABLE = 'post_types';

    /**
     * columns name in table
     */
    const COLUMN_SLUG         = 'slug';
    const COLUMN_NAME         = 'name';
    const COLUMN_DESCRIPTION  = 'description';

}
