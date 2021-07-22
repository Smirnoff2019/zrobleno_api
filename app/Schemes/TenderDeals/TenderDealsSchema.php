<?php

namespace App\Schemes\TenderDeals;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToStatusSchema;
use App\Schemes\Relations\BelongsTo\BelongsToTenderSchema;
use App\Schemes\Relations\BelongsTo\BelongsToCustomerSchema;
use App\Schemes\Relations\BelongsTo\BelongsToContractorSchema;

interface TenderDealsSchema extends DefaultSchema,
                                    BelongsToStatusSchema,
                                    BelongsToTenderSchema,
                                    BelongsToCustomerSchema,
                                    BelongsToContractorSchema
{

    /**
     * table name in database
     */
    public const TABLE = 'tender_deals';

}
