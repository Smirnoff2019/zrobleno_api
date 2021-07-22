<?php

namespace App\Traits\Eloquent\BelongsTo;

use App\Models\Role\Role;

/**
 *  @method role()
 */
trait BelongsToRole
{

    /**
     * Get the role for the this essence.
     * 
     * @return BelongsTo \App\Models\Role\Role
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    
}
