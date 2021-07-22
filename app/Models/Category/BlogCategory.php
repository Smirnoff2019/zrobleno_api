<?php

namespace App\Models\Category;

use App\Models\PostType\PostPostType;
use App\Models\Taxonomy\BlogCategoryTaxonomy;
use App\Models\Taxonomy\BlogTaxonomy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogCategory extends Category
{

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('categoryable', function (Builder $builder) {
            return $builder->whereHas(
                'taxonomies',
                function(Builder $query) {
                    $query->where(
                        BlogCategoryTaxonomy::COLUMN_SLUG,
                        BlogCategoryTaxonomy::DEFAULT_SLUG
                    );
                }
            );
        });
    }

    /**
     * Get all of the taxonomy for the categories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function taxonomies(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany(
            BlogTaxonomy::class,
            'categoryable',
            'categoryables',
            'category_id',
            'categoryable_id'
        );
    }

    /**
     * Get the children categories for the categories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(
            static::class,
            self::COLUMN_PARENT_ID,
            self::COLUMN_ID
        );
    }

    /**
     * Get all of the post_types that are assigned this categories.
     */
    public function postTypes()
    {
        return $this->morphedByMany(
            PostPostType::class,
            'categoryable'
        );
    }

}
