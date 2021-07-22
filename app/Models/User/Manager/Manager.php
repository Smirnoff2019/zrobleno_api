<?php

namespace App\Models\User\Manager;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Builder;

class Manager extends User
{

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(
            'manager_role',
            function(Builder $builder)
            {
                $builder->manager();
            }
        );
    }

}
