<?php

namespace App\Traits\Eloquent\HasMany;

use App\Models\Role\Role;

/**
 *  @method roles()
 */ 
trait HasManyRoles
{

    /**
     * Get the related roles
     * 
     * @return HasMany \App\Models\Role\Role
     */
    public function roles()
    {
        return $this->hasMany(Role::class);
    }
    
}
