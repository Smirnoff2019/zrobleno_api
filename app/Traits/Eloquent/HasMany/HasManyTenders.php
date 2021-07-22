<?php

namespace App\Traits\Eloquent\HasMany;

use App\Models\Tender\Tender;
use App\Schemes\Relations\BelongsTo\BelongsToTenderSchema;
use App\Schemes\Relations\BelongsTo\BelongsToUserSchema;

/**
 *  @method tenders()
 */
trait HasManyTenders
{

    /**
     * Get the all tenders for the this essence.
     * 
     * @return HasMany \App\Models\Tender\Tender
     */
    public function tenders()
    {
        return $this->hasMany(
            Tender::class,
            BelongsToUserSchema::COLUMN_USER_ID
        );
    }
    
}
