<?php

namespace App\Traits\Eloquent\BelongsTo;

use App\Models\Option\Option;

/**
 *  @method option()
 */
trait BelongsToOption
{

    /**
     * Get the option for the this essence.
     * 
     * @return BelongsTo \App\Models\Option\Option
     */
    public function option()
    {
        return $this->belongsTo(Option::class);
    }
    
}
