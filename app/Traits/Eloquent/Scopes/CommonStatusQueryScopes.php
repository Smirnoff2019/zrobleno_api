<?php

namespace App\Traits\Eloquent\Scopes;

use App\Models\Image\Image;
use App\Models\Status\Common\ActiveStatus;
use App\Models\Status\Common\InactiveStatus;
use App\Schemes\Relations\BelongsTo\BelongsToImageSchema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *  @method active()
 *  @method inactive()
 */ 
trait CommonStatusQueryScopes
{

    /**
     * Scope a query by status
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query)
    {
        return $query->whereHas('status', function($query) {
            return $query->where('type', ActiveStatus::DEFAULT_SLUG);
        });
    }

    /**
     * Scope a query by status
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return Builder
     */
    public function scopeInactive(Builder $query)
    {
        return $query->whereHas('status', function($query) {
            return $query->where('type', InactiveStatus::DEFAULT_SLUG);
        });
    }
    
}
