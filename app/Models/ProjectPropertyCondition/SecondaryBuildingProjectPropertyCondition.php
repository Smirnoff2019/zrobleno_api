<?php

namespace App\Models\ProjectPropertyCondition;

use Illuminate\Database\Eloquent\Builder;
use App\Models\ProjectPropertyCondition\ProjectPropertyCondition;

class SecondaryBuildingProjectPropertyCondition extends ProjectPropertyCondition
{

    /**
     * The column "name" default value.
     *
     * @var string
     */
    public const DEFAULT_NAME = 'Вторичка';


    /**
     * The column "slug" default value.
     *
     * @var string
     */
    public const DEFAULT_SLUG = 'secondary-building';


    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        self::COLUMN_NAME => self::DEFAULT_NAME,
        self::COLUMN_SLUG => self::DEFAULT_SLUG,
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('slug', function (Builder $builder) {
            $builder->where(static::COLUMN_SLUG, static::DEFAULT_SLUG)
                ->take(1);
        });
    }

}
