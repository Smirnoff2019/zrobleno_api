<?php

namespace App\Schemes\Payment;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToAccountSchema;
use App\Schemes\Relations\BelongsTo\BelongsToStatusSchema;

interface PaymentSchema extends DefaultSchema, BelongsToStatusSchema, BelongsToAccountSchema
{

    public const TABLE = 'payments';

    public const COLUMN_VALUE           = 'value';
    public const COLUMN_BALANCE         = 'balance';
    public const COLUMN_TYPE            = 'type';
    public const COLUMN_ORDER_REFERENCE = 'order_reference';
    public const COLUMN_IS_BONUS        = 'is_bonus';


}
