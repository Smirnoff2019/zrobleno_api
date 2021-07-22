<?php

namespace App\Models\MetaField;

use Illuminate\Database\Eloquent\Builder;

class TextareaField extends MetaField
{

    /**
     * The post post_type default value.
     *
     * @var string
     */
    const DEFAULT_SLUG = 'textarea';

    /**
     * The post post_type default value.
     *
     * @var string
     */
    const DEFAULT_NAME = 'Область тексту';
    
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        self::COLUMN_SLUG => self::DEFAULT_SLUG,
        self::COLUMN_NAME => self::DEFAULT_NAME
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('slug', function(Builder $query) {
            $query->where(self::COLUMN_SLUG, self::DEFAULT_SLUG)->take(1);
        });
    }

}
