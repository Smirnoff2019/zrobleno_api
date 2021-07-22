<?php

namespace App\Traits\Models\Status;

trait PaymentStatusScopes
{

    /**
     * Scope a query to only include statuses whose attribute slug value matches the 'approved'
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string|null $slug[:'approved']
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeApproved($query, string $slug = 'approved')
    {
        return $query->whereSlug($slug);
    }

    /**
     * Scope a query to only include statuses whose attribute slug value matches the 'pending'
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string|null $slug[:'pending']
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopePending($query, string $slug = 'pending')
    {
        return $query->whereSlug($slug);
    }

    /**
     * Scope a query to only include statuses whose attribute slug value matches the 'declined'
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string|null $slug[:'declined']
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeDeclined($query, string $slug = 'declined')
    {
        return $query->whereSlug($slug);
    }

    /**
     * Scope a query to only include statuses whose attribute slug value matches the 'inprocessing'
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string|null $slug[:'inprocessing']
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeInprocessing($query, string $slug = 'inprocessing')
    {
        return $query->whereSlug($slug);
    }
}
