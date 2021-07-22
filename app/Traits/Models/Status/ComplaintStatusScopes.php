<?php

namespace App\Traits\Models\Status;

trait ComplaintStatusScopes
{

    /**
     * Scope a query to only include statuses whose attribute slug value matches the 'in processing'
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string|null $slug
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeInProcessing( $query, $slug = 'in_processing' )
    {
        return $query->slug($slug);
    }

    /**
     * Scope a query to only include statuses whose attribute slug value matches the 'processed'
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string|null $slug
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeProcessed($query, $slug = 'processed')
    {
        return $query->slug($slug);
    }

    /**
     * Scope a query to only include statuses whose attribute slug value matches the 'satisfied'
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string|null $slug
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeSatisfied($query, $slug = 'satisfied')
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
