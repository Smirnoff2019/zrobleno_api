<?php

namespace App\Schemes\File;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToStatusSchema;
use App\Schemes\Relations\BelongsTo\BelongsToUserSchema;

interface FileSchema extends DefaultSchema, BelongsToStatusSchema, BelongsToUserSchema
{

    /**
     * table name in database
     */
    const TABLE = 'files';

    /**
     * columns name in table
     */
    const COLUMN_URL         = 'url';
    const COLUMN_URI         = 'uri';
    const COLUMN_PATH        = 'path';
    const COLUMN_NAME        = 'name';
    const COLUMN_TITLE       = 'title';
    const COLUMN_DESCRIPTION = 'description';
    const COLUMN_FORMAT      = 'format';
    const COLUMN_SIZE        = 'size';
    const COLUMN_SORT        = 'sort';

}
