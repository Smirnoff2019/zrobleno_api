<?php

namespace App\Traits\Eloquent\BelongsTo;

use App\Models\Tender\Tender;
use App\Schemes\Relations\BelongsTo\BelongsToTenderRestartSchema;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *  @method newTender()
 */
trait BelongsToTenderRestart
{

    /**
     * Get the tender for the this essence.
     *
     * @return BelongsTo \App\Models\Tender\Tender
     */
    public function newTender()
    {
        return $this->belongsTo(
            Tender::class,
            BelongsToTenderRestartSchema::COLUMN_NEW_TENDER_ID
        );
    }

}
