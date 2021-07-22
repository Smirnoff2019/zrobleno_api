<?php

namespace App\Schemes\ComplaintResponse;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToComplaintSchema;
use App\Schemes\Relations\BelongsTo\BelongsToComplaintResponseSchema;
use App\Schemes\Relations\BelongsTo\BelongsToUserSchema;

interface ComplaintResponseSchema extends DefaultSchema, BelongsToComplaintSchema, BelongsToComplaintResponseSchema, BelongsToUserSchema
{

    /**
     * table name in database
     */
    const TABLE = 'complaints_responses';

}
