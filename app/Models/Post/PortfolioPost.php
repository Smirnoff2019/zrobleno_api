<?php

namespace App\Models\Post;

use App\Models\Meta\Meta;
use Illuminate\Database\Eloquent\Builder;

class PortfolioPost extends Post
{

    /**
     * The post post_type default value.
     *
     * @var string
     */
    const DEFAULT_POST_TYPE = 'portfolio';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        self::COLUMN_POST_TYPE => self::DEFAULT_POST_TYPE,
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(
            'portfolio_postType',
            function(Builder $builder)
            {
                $builder->portfolio();
            }
        );
    }

    
    /**
     * Get the customer of the tender
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany \App\Models\User\User
     */
    public function metaFieldsSchema()
    {
        return $this->postType->metaFieldsGroups();
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
     * Get all of the meta for the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function metaStorage(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany(
            Meta::class,
            'metable',
            'metables',
            'metable_id',
            'meta_id',
        )->wherePivot('action', 'storage');
    }

}
