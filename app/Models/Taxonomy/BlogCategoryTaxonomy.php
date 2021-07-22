<?php

namespace App\Models\Taxonomy;

use App\Models\Category\BlogCategory;
use App\Models\PostType\PostPostType;
use Illuminate\Database\Eloquent\Builder;

class BlogCategoryTaxonomy extends Taxonomy
{

    /**
     * The post type slug default value.
     *
     * @var string
     */
    const DEFAULT_SLUG = 'categories';

    /**
     * The post type name default value.
     *
     * @var string
     */
    const DEFAULT_NAME = 'Категория блога';

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
            return $builder->where(
                static::COLUMN_SLUG,
                static::DEFAULT_SLUG
            )
                ->hasPostType(PostPostType::DEFAULT_SLUG)
                ->take(1);
        });
    }

    /**
     * Get all of the categories for the taxonomy.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function categories(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany(
            BlogCategory::class,
            'categoryable',
            'categoryables',
            'categoryable_id',
            'category_id'
        );
    }

    /**
     * Get all of the posts that are assigned this tag.
     */
    public function postType()
    {
        return $this->morphedByMany(
            PostPostType::class,
            'taxonomyable',
            'taxonomyables',
            'taxonomy_id',
            'taxonomyable_id'
        );
    }

}
