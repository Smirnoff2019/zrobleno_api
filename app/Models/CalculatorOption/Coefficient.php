<?php

namespace App\Models\CalculatorOption;

use Illuminate\Database\Eloquent\Builder;

class Coefficient extends CalculatorOption
{
    /**
     * The status's default group.
     *
     * @var string
     */
    public const DEFAULT_TYPE = 'coefficient';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        self::COLUMN_TYPE => self::DEFAULT_TYPE
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('type_coefficient', function (Builder $builder) {
            $builder->whereType(static::DEFAULT_TYPE);
        });
    }
}
