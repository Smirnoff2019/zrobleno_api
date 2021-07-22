<?php

namespace App\Models\Taxonomy;

use App\Models\Category\PortfolioCategory;
use App\Models\PostType\PortfolioPostType;
use Illuminate\Database\Eloquent\Builder;

class PortfolioTaxonomy extends Taxonomy
{

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('by_portfolio', function (Builder $builder) {
            return $builder->hasPostType(PortfolioPostType::DEFAULT_SLUG);
        });
    }

    
    /**
     * Get all of the posts that are assigned this tag.
     */
    public function postType()
    {
        return $this->morphedByMany(
            PortfolioPostType::class, 
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
            PortfolioCategory::class,
            'categoryable',
            'categoryables',
            'categoryable_id',
            'category_id'
        );
    }

}
