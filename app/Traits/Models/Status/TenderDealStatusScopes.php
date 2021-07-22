<?php

namespace App\Traits\Models\Status;

trait TenderDealStatusScopes
{

    /**
     * Scope a query to only include statuses whose attribute slug value matches the 'pending'
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string|null $slug
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopePending($query, $slug = 'pending')
    {
        return $query->slug($slug);
    }

    /**
     * Scope a query to only include statuses whose attribute slug value matches the 'agreed'
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string|null $slug
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeAgreed($query, $slug = 'agreed')
    {
        return $query->slug($slug);
    }
    

    /**
     * Scope a query to only include statuses whose attribute slug value matches the 'rejected'
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string|null $slug
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeRejected($query, $slug = 'rejected')
    {
        return $query->slug($slug);
    }
    
}
