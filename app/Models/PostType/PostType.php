<?php

namespace App\Models\PostType;

use App\Models\Category\Category;
use App\Models\Meta\Meta;
use App\Models\Meta\MetaFieldsGroup;
use App\Models\Post\Post;
use App\Models\Taxonomy\Taxonomy;
use App\Schemes\PostType\PostTypeSchema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PostType extends Model implements PostTypeSchema
{

    /**
     * The post type slug default value.
     *
     * @var string
     */
    const DEFAULT_SLUG = self::COLUMN_SLUG;

    /**
     * The post type name default value.
     *
     * @var string
     */
    const DEFAULT_NAME = self::COLUMN_NAME;

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
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [''];

    /**
     * Get all posts for the this post type.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function post(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(
            Post::class,
            self::COLUMN_SLUG,
            Post::COLUMN_POST_TYPE
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
            Category::class,
            'categoryable'
        );
    }

    /**
     * Get all of the categories for the post type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function metaFieldsGroups()
    {
        return $this->morphToMany(
            MetaFieldsGroup::class,
            'metable',
            'metables',
            'metable_id',
            'meta_id',
        )->withPivot([
            'value',
            'action'
        ]);
    }

    /**
     * Get all of the categories for the post type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function meta(): \Illuminate\Database\Eloquent\Relations\MorphToMany
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
    public function markupes(): \Illuminate\Database\Eloquent\Relations\MorphToMany
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
    public function metaStorage(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->meta()
            ->wherePivot(
                'action',
                'storage'
            );
    }

    /**
     * Get all of the taxonomy for the post type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function taxonomy(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany(
            Taxonomy::class,
            'taxonomyable'
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
            Taxonomy::class,
            'taxonomyable'
        );
    }
    
    /**
     * Scope a query to only include posts who have this post type Portfolio
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePortfolio(Builder $query)
    {
        return $query->where(self::COLUMN_SLUG, PortfolioPostType::DEFAULT_SLUG);
    }

}
