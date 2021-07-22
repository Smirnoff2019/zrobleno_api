<?php

namespace App\Models\Category;

use App\Models\Taxonomy\PortfolioCategoryTaxonomy;
use App\Models\Taxonomy\PortfolioTaxonomy;
use Illuminate\Database\Eloquent\Builder;

class PortfolioCategory extends Category
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
                        PortfolioCategoryTaxonomy::COLUMN_SLUG,
                        PortfolioCategoryTaxonomy::DEFAULT_SLUG,
                    );
                }
            );
        });
    }
    
    /**
     * Get all of the taxonomy for the category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function taxonomies()
    {
        return $this->morphedByMany(
            PortfolioTaxonomy::class,
            'categoryable',
            'categoryables',
            'category_id',
            'categoryable_id'
        );
    }
    
    /**
     * Get the children categories for the category.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(
            static::class,
            self::COLUMN_PARENT_ID,
            self::COLUMN_ID
        );
    }

}
