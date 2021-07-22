<?php

namespace App\Models\PostType;

use App\Models\Category\PortfolioCategory;
use App\Models\Post\PortfolioPost;
use App\Models\Taxonomy\PortfolioCategoryTaxonomy;
use App\Models\Taxonomy\PortfolioTaxonomy;
use Illuminate\Database\Eloquent\Builder;

class PortfolioPostType extends PostType
{

    /**
     * The post type slug default value.
     *
     * @var string
     */
    const DEFAULT_SLUG = 'portfolio';

    /**
     * The post type name default value.
     *
     * @var string
     */
    const DEFAULT_NAME = 'Портфоліо';

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
     * Get all posts for the this post type.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(
            PortfolioPost::class,
            self::COLUMN_SLUG,
            PortfolioPost::DEFAULT_POST_TYPE
        );
    }

    /**
     * Get all of the categories for the post type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function categories(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany(
            PortfolioCategory::class,
            'categoryable'
        );
    }

    
    /**
     * Get all of the taxonomy for the post type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function taxonomies(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany(
            PortfolioTaxonomy::class,
            'taxonomyable',
            'taxonomyables',
            'taxonomyable_id',
            'taxonomy_id',
        );
    }

    /**
     * Get all of the taxonomy for the post type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function taxonomyCategories(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany(
            PortfolioCategoryTaxonomy::class,
            'taxonomyable',
            'taxonomyables',
            'taxonomy_id',
            'taxonomyable_id'
        );
    }

}