<?php

namespace App\Traits\Eloquent\BelongsTo;

use App\Models\TenderApplication\TenderApplication;
use App\Schemes\Relations\BelongsTo\BelongsToTenderApplicationSchema;

/**
 *  @method application()
 */
trait BelongsToTenderApplication
{

    /**
     * Get the tender application for the this essence.
     * 
     * @return BelongsTo \App\Models\TenderApplication\TenderApplication
     */
    public function application()
    {
        return $this->belongsTo(
            TenderApplication::class,
            BelongsToTenderApplicationSchema::COLUMN_TENDER_APPLICATION_ID
        );
    }
    
}
