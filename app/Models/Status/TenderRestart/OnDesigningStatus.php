<?php

namespace App\Models\Status\TenderRestart;

use App\Models\Status\TenderRestartStatus;
use Illuminate\Database\Eloquent\Builder;

class OnDesigningStatus extends TenderRestartStatus 
{
    
    /**
     * The status's default name attribute value.
     *
     * @var string
     */
    public const DEFAULT_NAME = 'На проектуванні';

    /**
     * The status's default slug attribute value.
     *
     * @var string
     */
    public const DEFAULT_SLUG = 'on_designing';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        self::COLUMN_NAME   => self::DEFAULT_NAME,
        self::COLUMN_SLUG   => self::DEFAULT_SLUG,
        self::COLUMN_TYPE   => self::DEFAULT_SLUG,
        self::COLUMN_GROUP  => self::DEFAULT_GROUP
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        parent::booted();
      
        static::addGlobalScope('slug', function (Builder $builder) {
            $builder->whereSlug(static::DEFAULT_SLUG);
        });

    }

}
