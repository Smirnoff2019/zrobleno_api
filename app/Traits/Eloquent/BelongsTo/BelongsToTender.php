<?php

namespace App\Traits\Eloquent\BelongsTo;

use App\Models\Tender\Tender;
use App\Schemes\Relations\BelongsTo\BelongsToTenderSchema;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *  @method tender()
 */
trait BelongsToTender
{

    /**
     * Get the tender for the this essence.
     * 
     * @return BelongsTo \App\Models\Tender\Tender
     */
    public function tender()
    {
        return $this->belongsTo(
            Tender::class,
            BelongsToTenderSchema::COLUMN_TENDER_ID
        );
    }
    
}
