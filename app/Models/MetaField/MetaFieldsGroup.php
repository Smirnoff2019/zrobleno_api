<?php

namespace App\Models\MetaField;

use App\Traits\Models\MetaField\GetOrCreateScopes;
use Illuminate\Database\Eloquent\Builder;

class MetaFieldsGroup extends MetaField
{

    use GetOrCreateScopes;

    /**
     * The post post_type default value.
     *
     * @var string
     */
    const DEFAULT_SLUG = 'meta_fields_group';

    /**
     * The post post_type default value.
     *
     * @var string
     */
    const DEFAULT_NAME = 'Група мета-полів';

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
        static::addGlobalScope('slug', function(Builder $builder) {
            return $builder->where(self::COLUMN_SLUG, self::DEFAULT_SLUG)->take(1);
        });
    }

}
