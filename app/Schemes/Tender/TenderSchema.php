<?php

namespace App\Schemes\Tender;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToProjectSchema;
use App\Schemes\Relations\BelongsTo\BelongsToStatusSchema;
use App\Schemes\Relations\BelongsTo\BelongsToTenderApplicationSchema;
use App\Schemes\Relations\BelongsTo\BelongsToUserSchema;

interface TenderSchema extends DefaultSchema, BelongsToStatusSchema, BelongsToProjectSchema, BelongsToUserSchema
{
    
    public const TABLE = 'tenders';

    public const COLUMN_UID              = 'uid';
    public const COLUMN_NAME             = 'name';
    public const COLUMN_MAX_PARTICIPANTS = 'max_participants';
    public const COLUMN_PRICE            = 'price';
    public const COLUMN_APPLICATION_ID   = 'application_id';
    public const COLUMN_FINISHED_AT      = 'finished_at';
    public const COLUMN_STARTED_AT       = 'started_at';

}
