<?php

namespace App\Traits\Models\Status;

trait BaseAttributesScopes
{

    /**
     * Scope a query to only include statuses whose `slug` matches the specified
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string|array[:string] $slug
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeSlug($query, $slug)
    {
        return $query->whereSlug($slug);
    }

    /**
     * Scope a query to only include statuses whose `type` matches the specified
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string|array[:string] $type
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeType($query, $type)
    {
        return $query->whereType($type);
    }

    /**
     * Scope a query to only include statuses whose `group` matches the specified
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string|array[:string] $group
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeGroup($query, $group)
    {
        return $query->whereGroup($group);
    }
    
}
