<?php

namespace App\Models\Avatar;

use Illuminate\Database\Eloquent\Builder;

class FemaleAvatar extends Avatar
{
    /**
     * The status's default group.
     *
     * @var string
     */
    const DEFAULT_GENDER = 'woman';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        self::COLUMN_GENDER => self::DEFAULT_GENDER
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('gender', function (Builder $builder) {
            $builder->where(self::COLUMN_GENDER, static::DEFAULT_GENDER);
        });
    }
}
