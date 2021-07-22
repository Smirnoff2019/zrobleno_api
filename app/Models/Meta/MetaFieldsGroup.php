<?php

namespace App\Models\Meta;

use App\Models\Category\Category;
use App\Models\MetaField\MetaFieldsGroup as MetaFieldMetaFieldsGroup;
use App\Models\Post\Post;
use App\Models\PostType\PostType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MetaFieldsGroup extends Meta
{

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    // protected $attributes = [
    //     //self::COLUMN_OPTIONS => "{}",
    // ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('meta_field_type', function(Builder $query) {
            $query->has('metaField');
        });

        static::created(function ($meta) {
            $meta->metaField()->associate(MetaFieldMetaFieldsGroup::getOrCreate())->save();
        });
    }

    /**
     * Get the meta fields that it has.
     * 
     * @return BelongsTo MetaField
     */
    public function metaField()
    {
        return $this->belongsTo(
            MetaFieldMetaFieldsGroup::class,
            self::COLUMN_META_FIELD_ID
        );
    }

    /**
     * Get all of the post_types that are assigned this meta.
     */
    public function fields()
    {
        return $this->morphedByMany(
            Meta::class,
            'metable',
            'metables',
            'meta_id',
        );
    }

    /**
     * Get the meta fields groups.
     *
     * @param  array  $value
     * @return string|null
     */
    public function getFieldsGroupsAttribute($value)
    {
        return $this->fields->groupBy('parent_id') ?? [];
    }

    /**
     * Set the meta fields groups.
     *
     * @param  array  $value
     * @return void
     */
    public function setFieldsGroupsAttribute($value = [])
    {
        $this->fieldsGroups = $value ?? [];
    }

    /**
     * Get all of the post_types that are assigned this meta.
     */
    public function fieldsGroups()
    {
        return $this->fields->groupBy('parent_id');
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
     * Get all of the posts that are assigned this meta.
     */
    public function posts()
    {
        return $this->morphedByMany(
            Post::class,
            'metable'
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
