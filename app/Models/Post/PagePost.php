<?php

namespace App\Models\Post;

use App\Models\PostType\PagePostType;
use Illuminate\Database\Eloquent\Builder;

class PagePost extends Post
{

    /**
     * The post post_type default value.
     *
     * @var string
     */
    const DEFAULT_POST_TYPE = 'page';

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
        static::addGlobalScope('post_type', function(Builder $builder) {
            return $builder->where(self::COLUMN_POST_TYPE, PagePostType::DEFAULT_SLUG);
        });
    }

    /**
     * Get all of the meta for the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function meta(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany(Meta::class, 'metable')
                    ->withPivot([
                        'value',
                        'action'
                    ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function storage(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->meta()->wherePivot('action', 'storage');
    }

}
