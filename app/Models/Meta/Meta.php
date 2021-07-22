<?php

namespace App\Models\Meta;

use App\Models\Category\Category;
use App\Models\MetaField\MetaField;
use App\Models\Post\PortfolioPost;
use App\Models\Post\Post;
use App\Models\PostType\PostType;
use App\Models\Taxonomy\Taxonomy;
use App\Traits\Eloquent\BelongsTo\BelongsToParent;
use Illuminate\Database\Eloquent\Model;
use App\Schemes\Meta\MetaSchema;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Meta extends Model implements MetaSchema
{

    use BelongsToParent;

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
        self::COLUMN_OPTIONS,
        self::COLUMN_PARENT_ID,
        self::COLUMN_META_FIELD_ID,
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        //
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        //self::COLUMN_OPTIONS => "{}",
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        self::COLUMN_OPTIONS => "json",
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
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        //
    ];
    
    /**
     * Get the meta fields type.
     *
     * @return string|null
     */
    public function getTypeAttribute()
    {
        return $this->metaField->slug ?? null;
    }

    /**
     * Set the meta fields type.
     *
     * @param  string  $type
     * @return void
     */
    public function setTypeAttribute($type = null)
    {
        return $this;
    }

    /**
     * Get the meta fields that it has.
     * 
     * @return BelongsTo MetaField
     */
    public function metaField()
    {
        return $this->belongsTo(
            MetaField::class,
            self::COLUMN_META_FIELD_ID
        );
    }

    /**
     * Get all of the post_types that are assigned this meta.
     */
    public function postTypes()
    {
        return $this->morphedByMany(
            PostType::class,
            'metable',
            'metables',
            'meta_id',
        );
    }

    /**
     * Get all of the post_types that are assigned this meta.
     */
    public function portfolioStorage()
    {
        return $this->morphedByMany(
            PortfolioPost::class,
            'metable',
            'metables',
            'meta_id',
            'metable_id',
        )->wherePivot('action', 'storage')->withPivot(['action', 'value']);
    }

    /**
     * Get all of the posts that are assigned this meta.
     */
    public function posts()
    {
        return $this->morphedByMany(
            Post::class,
            'metable',
            'metables',
            'meta_id',
        );
    }

    /**
     * Get all of the posts that are assigned this meta.
     */
    public function taxonomies()
    {
        return $this->morphedByMany(
            Taxonomy::class,
            'metable',
            'metables',
            'meta_id',
        );
    }

    /**
     * Get all of the categories that are assigned this meta.
     */
    public function categories()
    {
        return $this->morphedByMany(
            Category::class,
            'metable'
        );
    }

}


