<?php

namespace App\Schemes\Complaint;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToStatusSchema;
use App\Schemes\Relations\BelongsTo\BelongsToUserSchema;

interface ComplaintSchema extends DefaultSchema, BelongsToUserSchema, BelongsToStatusSchema
{

    /**
     * table name in database
     */
    const TABLE = 'complaints';

    /**
     * columns name in table
     */
    const COLUMN_SUBJECT = 'subject';
    const COLUMN_MESSAGE = 'message';

}
