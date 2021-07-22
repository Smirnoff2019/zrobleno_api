<?php

namespace App\Models\Taxonomy;

use App\Models\Category\Category;
use App\Models\PostType\PortfolioPostType;
use App\Models\PostType\PostType;
use App\Schemes\Taxonomy\TaxonomySchema;
use App\Traits\Eloquent\BelongsTo\BelongsToStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model implements TaxonomySchema
{

    use BelongsToStatus;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = self::TABLE;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::COLUMN_SLUG,
        self::COLUMN_NAME,
        self::COLUMN_DESCRIPTION,
        self::COLUMN_STATUS_ID
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        //
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        self::COLUMN_UPDATED_AT,
        self::COLUMN_CREATED_AT,
    ];

    /**
     * Get all of the categories for the taxonomy.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function categories(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany(
            Category::class,
            'categoryable',
        );
    }

    /**
     * Get all of the posts that are assigned this tag.
     */
    public function postType()
    {
        return $this->morphedByMany(
            PostType::class, 
            'taxonomyable',
            'taxonomyables',
            'taxonomy_id',
            'taxonomyable_id',
        );
    }
    
    /**
     * Scope a query to only include taxonomy who have this post type
     *
     * @param Builder $query
     * @param string[:\App\Models\PostType\PostType]  $slug
     * @return Builder
     */
    public function scopeHasPostType( Builder $query, string $slug): Builder
    {
        return $query->whereHas('postType', function (Builder $query) use ($slug) {
            $query->where(
                PostType::COLUMN_SLUG,
                $slug
            );
        });
    }

}
