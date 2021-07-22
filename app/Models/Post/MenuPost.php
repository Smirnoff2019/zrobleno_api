<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Builder;

class MenuPost extends Post
{

    /**
     * The post post_type default value.
     *
     * @var string
     */
    const DEFAULT_POST_TYPE = 'menu';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        self::COLUMN_POST_TYPE => self::DEFAULT_POST_TYPE,
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(
            'menu_postType',
            function(Builder $builder)
            {
                $builder->menu();
            }
        );
    }

}
