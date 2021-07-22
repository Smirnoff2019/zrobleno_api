<?php

namespace App\Traits\Models\Status;

use App\Models\Status\Tender\ActiveStatus;
use App\Models\Status\Tender\RecruitmentOfParticipantsStatus;
use App\Models\Status\Tender\AwaitingConfirmationStatus;
use App\Models\Status\Tender\SuspendedStatus;
use App\Models\Status\Tender\CompletedStatus;
use App\Models\Status\Tender\CanceledStatus;

trait TenderStatusScopes
{

    /**
     * Scope a query to only include statuses whose attribute slug value matches the "active"
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string|null $slug
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeActive($query, $slug = ActiveStatus::DEFAULT_SLUG)
    {
        return $query->slug($slug);
    }

    /**
     * Scope a query to only include statuses whose attribute slug value matches the "recruitment_of_participants"
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string|null $slug
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeRecruitmentOfParticipants($query, $slug = RecruitmentOfParticipantsStatus::DEFAULT_SLUG)
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
    public function scopeAwaitingConfirmation($query, $slug = AwaitingConfirmationStatus::DEFAULT_SLUG)
    {
        return $query->slug($slug);
    }

    /**
     * Scope a query to only include statuses whose attribute slug value matches the "suspended"
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string|null $slug
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeSuspended($query, $slug = SuspendedStatus::DEFAULT_SLUG)
    {
        return $query->slug($slug);
    }

    /**
     * Scope a query to only include statuses whose attribute slug value matches the "completed"
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string|null $slug
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeCompleted($query, $slug = CompletedStatus::DEFAULT_SLUG)
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
    public function scopeCanceled($query, $slug = CanceledStatus::DEFAULT_SLUG)
    {
        return $query->slug($slug);
    }
    
}
