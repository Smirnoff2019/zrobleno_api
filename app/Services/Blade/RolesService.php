<?php

namespace App\Services\Blade;

use App\Models\Role\Role;

class RolesService
{

    /**
     * The role model
     *
     * @var Role
     */
    public $model;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get roles
     *
     * @return Role
     */
    public function getRole()
    {
        return Role::get()->map(function($role) {
            return [
                'label' => $role->name,
                'value' => $role->id,
            ];
        });
    }

}