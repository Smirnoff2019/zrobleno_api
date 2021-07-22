<?php

namespace App\Traits\Eloquent\HasMany;

use App\Models\User\User;

trait HasManyUsers
{

    /**
     * Get the related Users
     * 
     * @return HasMany \App\Models\User\User
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
    
}
