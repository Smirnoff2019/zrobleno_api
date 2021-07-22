<?php

namespace App\Models\Post;

use App\Models\Meta\Meta;
use App\Schemes\Post\PostSchema;
use App\Models\Category\Category;
use App\Models\PostType\PostType;
use App\Models\Taxonomy\Taxonomy;
use App\Traits\Eloquent\BelongsTo\BelongsToUser;
use App\Traits\Models\Post\PostScopes;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Eloquent\BelongsTo\BelongsToImage;
use App\Traits\Eloquent\BelongsTo\BelongsToParent;
use App\Traits\Eloquent\BelongsTo\BelongsToStatus;
use App\Traits\Filters\Filterable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model implements PostSchema
{

    use BelongsToParent,
        BelongsToUser,
        BelongsToImage,
        BelongsToStatus,
        PostScopes,
        Filterable;
    
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
        self::COLUMN_TITLE,
        self::COLUMN_DESCRIPTION,
        self::COLUMN_CONTENT,
        self::COLUMN_POST_TYPE,
        self::COLUMN_PARENT_ID,
        self::COLUMN_IMAGE_ID,
        self::COLUMN_USER_ID,
        self::COLUMN_STATUS_ID
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
     * Get the post_type for the post.
     * 
     * @return BelongsTo
     */
    public function postType(): BelongsTo
    {
        return $this->belongsTo(
            PostType::class,
            self::COLUMN_POST_TYPE,
            PostType::COLUMN_SLUG
        );
    }

    /**
     * Get all allowed of the categories for the post by post type.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function allowedCategories(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->postType()
                    ->getResults()
                    ->taxonomies()
                    ->whereSlug('categories')
                    ->take(1)
                    ->getResults()
                    ->first()
                    ->categories();
    }

    /**
     * Get all of the categories for the post.
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
     * Get all of the meta for the post.
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
    public function storage(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->meta()
            ->wherePivot(
                'action',
                'storage'
            );
    }
    
}
