<?php

namespace App\Schemes\CalculatorOption;

use App\Schemes\DefaultSchema;
use App\Schemes\Relations\BelongsTo\BelongsToStatusSchema;

interface CalculatorOptionSchema extends DefaultSchema, BelongsToStatusSchema
{

    public const TABLE = 'calculator_options';

    public const COLUMN_VALUE        = 'value';
    public const COLUMN_TYPE         = 'type';
    public const COLUMN_SLUG         = 'slug';
    public const COLUMN_NAME         = 'name';
    public const COLUMN_DESCRIPTION  = 'description';
}
