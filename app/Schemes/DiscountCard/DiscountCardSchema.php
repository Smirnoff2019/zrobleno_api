<?php

namespace App\Schemes\DiscountCard;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToStatusSchema;
use App\Schemes\Relations\BelongsTo\BelongsToTenderSchema;
use App\Schemes\Relations\BelongsTo\BelongsToUserSchema;
use App\Schemes\TimestampExpiratedSchema;

interface DiscountCardSchema extends DefaultSchema, TimestampExpiratedSchema, BelongsToTenderSchema, BelongsToUserSchema, BelongsToStatusSchema
{

    public const TABLE = 'discount_cards';

    public const COLUMN_CARD_NUMBER     = 'card_number';
    public const COLUMN_CARD_THEME_ID   = 'discount_cards_theme_id';

}
