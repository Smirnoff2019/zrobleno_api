<?php

namespace App\Traits\Models\MetaField;

use Illuminate\Database\Eloquent\Builder;

trait GetOrCreateScopes
{

    /**
     * Execute the query and get the first result.
     *
     * @param  Builder       $query
     * @param  array|string  $columns
     * @return \Illuminate\Database\Eloquent\Model|object|static|null
     */
    public function scopeGetOrCreate(Builder $query, $columns = ['*'])
    {
        return $this->firstOr($columns, function() {
            return factory(static::class)->create();
        });
    }

}
