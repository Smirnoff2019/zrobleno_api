<?php

namespace App\Models\PostType;

use App\Models\Taxonomy\BlogTaxonomy;
use Illuminate\Database\Eloquent\Builder;

class PostPostType extends PostType
{

    /**
     * The post type slug default value.
     *
     * @var string
     */
    const DEFAULT_SLUG = 'post';

    /**
     * The post type name default value.
     *
     * @var string
     */
    const DEFAULT_NAME = 'Публікація';

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

    /**
     * Get all of the taxonomy for the post type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function taxonomies(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany(
            BlogTaxonomy::class,
            'taxonomyable',
            'taxonomyables',
            'taxonomyable_id',
            'taxonomy_id'
        );
    }

}
