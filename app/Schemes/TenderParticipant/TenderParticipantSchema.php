<?php

namespace App\Schemes\TenderParticipant;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToOptionSchema;
use App\Schemes\Relations\BelongsTo\BelongsToProjectSchema;
use App\Schemes\Relations\BelongsTo\BelongsToTenderSchema;
use App\Schemes\Relations\BelongsTo\BelongsToUserSchema;

interface TenderParticipantSchema extends DefaultSchema, BelongsToTenderSchema, BelongsToUserSchema
{

    public const TABLE = 'tender_participants';

}
