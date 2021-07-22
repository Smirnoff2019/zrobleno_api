<?php

namespace App\Traits\Eloquent\BelongsTo;

use App\Models\User\User;

/**
 *  @method user()
 */
trait BelongsToUser
{

    /**
     * Get the user for the this essence.
     * 
     * @return BelongsTo \App\Models\User\User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
