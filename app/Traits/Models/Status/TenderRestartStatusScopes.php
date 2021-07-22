<?php

namespace App\Traits\Models\Status;

use App\Models\Status\TenderRestart\CanceledStatus;
use App\Models\Status\TenderRestart\ConfirmedStatus;
use App\Models\Status\TenderRestart\OnDesigningStatus;
use App\Models\Status\TenderRestart\AwaitingConfirmationStatus;

trait TenderRestartStatusScopes
{

    /**
     * Scope a query to only include statuses whose attribute slug value matches the "on_designing"
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string|null $slug
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeOnDesigning($query, string $slug = OnDesigningStatus::DEFAULT_SLUG)
    {
        return $query->slug($slug);
    }

    /**
     * Scope a query to only include statuses whose attribute slug value matches the "awaiting_confirmation"
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string|null $slug
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeAwaitingConfirmation($query, string $slug = AwaitingConfirmationStatus::DEFAULT_SLUG)
    {
        return $query->slug($slug);
    }

    /**
     * Scope a query to only include statuses whose attribute slug value matches the "confirmed"
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string|null $slug
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeConfirmed($query, string $slug = ConfirmedStatus::DEFAULT_SLUG)
    {
        return $query->slug($slug);
    }

    /**
     * Scope a query to only include statuses whose attribute slug value matches the "canceled"
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string|null $slug
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeCanceled($query, string $slug = CanceledStatus::DEFAULT_SLUG)
    {
        return $query->slug($slug);
    }

}
