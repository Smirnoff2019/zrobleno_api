<?php

namespace App\Traits\Eloquent\BelongsTo;

use App\Models\OptionsGroup\OptionsGroup;
use App\Schemes\Relations\BelongsTo\BelongsToOptionsGroupSchema;

/**
 *  @method optionsGroup()
 */
trait BelongsToOptionsGroup
{

    /**
     * Get the Options Group for the this essence.
     * 
     * @return BelongsTo \App\Models\OptionsGroup\OptionsGroup
     */
    public function optionsGroup()
    {
        return $this->belongsTo(
            OptionsGroup::class,
            BelongsToOptionsGroupSchema::COLUMN_OPTIONS_GROUP_ID
        );
    }
    
}
