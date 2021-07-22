<?php

namespace App\Schemes\ComplaintRecipient;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToComplaintSchema;
use App\Schemes\Relations\BelongsTo\BelongsToUserSchema;

interface ComplaintRecipientSchema extends DefaultSchema, BelongsToComplaintSchema, BelongsToUserSchema
{

    /**
     * table name in database
     */
    const TABLE = 'complaints_recipients';

}
