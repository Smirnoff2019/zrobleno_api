<?php

namespace App\Schemes\TenderRestart;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToStatusSchema;
use App\Schemes\Relations\BelongsTo\BelongsToTenderSchema;
use App\Schemes\Relations\BelongsTo\BelongsToTenderRestartSchema;

interface TenderRestartSchema extends DefaultSchema, BelongsToStatusSchema, BelongsToTenderSchema, BelongsToTenderRestartSchema
{

    /**
     * table name in database
     */
    const TABLE = 'tenders_restarts';

}
