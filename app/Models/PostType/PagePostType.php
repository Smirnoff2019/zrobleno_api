<?php

namespace App\Models\PostType;

use Illuminate\Database\Eloquent\Builder;

class PagePostType extends PostType
{

    /**
     * The post type slug default value.
     *
     * @var string
     */
    const DEFAULT_SLUG = 'page';

    /**
     * The post type name default value.
     *
     * @var string
     */
    const DEFAULT_NAME = 'Сторінка';

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
        static::addGlobalScope('slug', function (Builder $builder) {
            $builder->where(static::COLUMN_SLUG, static::DEFAULT_SLUG)
                ->take(1);
        });
    }

}
