<?php

namespace App\Schemes\TenderApplication;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToStatusSchema;
use App\Schemes\Relations\BelongsTo\BelongsToTenderSchema;

interface TenderApplicationSchema extends DefaultSchema, BelongsToStatusSchema, BelongsToTenderSchema
{

    public const TABLE = 'tender_applications';

}
