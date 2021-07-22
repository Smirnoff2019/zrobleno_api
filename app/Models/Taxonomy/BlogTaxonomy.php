<?php

namespace App\Models\Taxonomy;

use App\Models\Category\BlogCategory;
use App\Models\PostType\PostPostType;
use Illuminate\Database\Eloquent\Builder;

class BlogTaxonomy extends Taxonomy
{

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(
            'by_blog',
            function (Builder $builder)
            {
                return $builder->hasPostType(
                    PostPostType::DEFAULT_SLUG
                );
            }
        );
    }


    /**
     * Get all of the posts that are assigned this tag.
     *
     * * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function postType(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany(
            PostPostType::class,
            'taxonomyable',
            'taxonomyables',
            'taxonomy_id',
            'taxonomyable_id'
        );
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

}
