<?php

namespace App\Traits\Eloquent\BelongsTo;

use App\Models\Supplier\Supplier;

/**
 *  @method supplier()
 */ 
trait BelongsToSupplier
{

    /**
     * Get the supplier
     * 
     * @return BelongsTo \App\Models\Supplier\Supplier
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    
}
