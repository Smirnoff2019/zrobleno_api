<?php

namespace App\Models\Category;

use App\Models\Meta\Meta;
use App\Models\Metables\Metables;
use App\Models\Post\Post;
use App\Models\PostType\PostType;
use App\Models\Taxonomy\PortfolioCategoryTaxonomy;
use App\Models\Taxonomy\Taxonomy;
use Illuminate\Database\Eloquent\Model;
use App\Schemes\Category\CategorySchema;
use App\Traits\Eloquent\BelongsTo\BelongsToImage;
use App\Traits\Eloquent\BelongsTo\BelongsToParent;
use App\Traits\Eloquent\BelongsTo\BelongsToStatus;
use App\Traits\Eloquent\BelongsTo\BelongsToUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model implements CategorySchema
{

    use BelongsToStatus,
        BelongsToUser,
        BelongsToImage,
        BelongsToParent;

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
        self::COLUMN_PARENT_ID,
        self::COLUMN_USER_ID,
        self::COLUMN_IMAGE_ID,
        self::COLUMN_STATUS_ID,
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
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [''];

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
     * Get the children categories for the categories.
     * @return hasMany
     */
    public function children()
    {
        return $this->hasMany(
            static::class,
            self::COLUMN_PARENT_ID
        );
    }

    /**
     * Get all of the post_types that are assigned this categories.
     */
    public function postTypes()
    {
        return $this->morphedByMany(
            PostType::class,
            'categoryable'
        );
    }

    /**
     * Get all of the posts that are assigned this categories.
     */
    public function posts()
    {
        return $this->morphedByMany(
            Post::class,
            'categoryable'
        );
    }

    /**
     * Get all of the meta for the categories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function meta()
    {
        return $this->morphToMany(
            Meta::class,
            'metable'
        )->withPivot([
            'value',
            'action'
        ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function markupes()
    {
        return $this->meta()
            ->wherePivot(
                'action',
                'markup'
            );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function storage()
    {
        return $this->meta()
            ->wherePivot(
                'action',
                'storage'
            );
    }

    /**
     * Get all of the taxonomy for the categories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function taxonomy()
    {
        return $this->morphedByMany(
            Taxonomy::class,
            'categoryable',
            'categoryables',
            'category_id',
            'categoryable_id'
        );
    }
    
    /**
     * Get all of the taxonomy for the category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function taxonomies()
    {
        return $this->morphedByMany(
            Taxonomy::class,
            'categoryable',
            'categoryables',
            'category_id',
            'categoryable_id'
        );
    }

    /**
     * Scope a query to only include taxonomy who have this post type
     *
     * @param Builder $query
     * @param string[:\App\Models\PostType\PostType]  $slug
     * @return Builder
     */
    public function scopeByPortfolio(Builder $query)
    {
        return PortfolioCategoryTaxonomy::firstOrCreate(
            [],
            factory(PortfolioCategoryTaxonomy::class)->make()->toArray()
        )->categories();
    }

}
