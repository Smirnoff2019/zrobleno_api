<?php

namespace App\Traits\Models\Status;

trait CommonStatusScopes
{

    /**
     * Scope a query to only include statuses whose attribute slug value matches the 'active'
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string|null $slug[:'active']
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeActive($query, string $slug = 'active')
    {
        return $query->slug($slug);
    }

    /**
     * Scope a query to only include statuses whose attribute slug value matches the 'inactive'
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string|null $slug[:'inactive']
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeInactive($query, string $slug = 'inactive')
    {
        return $query->slug($slug);
    }
    
}
