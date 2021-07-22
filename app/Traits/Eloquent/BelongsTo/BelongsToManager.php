<?php

namespace App\Traits\Eloquent\BelongsTo;

use App\Models\User\User;

/**
 *  @method manager()
 */
trait BelongsToManager
{

    /**
     * Get the user with role manager for the this essence.
     * 
     * @return BelongsTo \App\Models\User\User
     */
    public function manager()
    {
        return $this->belongsTo(User::class);
    }

}
