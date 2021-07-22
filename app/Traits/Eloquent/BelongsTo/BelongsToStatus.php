<?php

namespace App\Traits\Eloquent\BelongsTo;

use App\Models\Status\Status;
use App\Schemes\Relations\BelongsTo\BelongsToStatusSchema;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *  @method status()
 */
trait BelongsToStatus
{

    /**
     * Get the status for the essence.
     * 
     * @return BelongsTo \App\Models\Status\Status
     */
    public function status()
    {
        return $this->belongsTo(
            Status::class,
            BelongsToStatusSchema::COLUMN_STATUS_ID
        );
    }

}
