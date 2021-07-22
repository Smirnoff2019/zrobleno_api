<?php

namespace App\Schemes\UserLegalData;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToUserSchema;

interface UserLegalDataSchema extends DefaultSchema, BelongsToUserSchema
{
    /**
     * table name in database
     */
    const TABLE = 'user_legal_datas';

    /**
     * columns name in table
     */
    const COLUMN_BILL            = 'bill';
    const COLUMN_MFO             = 'MFO';
    const COLUMN_EDRPOU_CODE     = 'EDRPOU_code';
    const COLUMN_SERIAL_NUMBER   = 'serial_number';
    const COLUMN_LEGAL_STATUS    = 'legal_status';

}
