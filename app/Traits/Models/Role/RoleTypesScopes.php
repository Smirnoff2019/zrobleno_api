<?php

namespace App\Traits\Models\Role;

use App\Models\Role\UserRole;
use App\Models\Role\AdminRole;
use App\Models\Role\EditorRole;
use App\Models\Role\ManagerRole;
use App\Models\Role\CustomerRole;
use App\Models\Role\SuperUserRole;
use App\Models\Role\ContractorRole;
use App\Models\Role\SeniorAdminRole;

trait RoleTypesScopes
{

    /**
     * Scope a query to only include statuses whose `slug` matches the specified
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \App\Models\Role\SuperUserRole
     */
    public function scopeSuperUser($query)
    {
        return SuperUserRole::union($query);
    }

    /**
     * Scope a query to only include statuses whose `slug` matches the specified
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \App\Models\Role\SeniorAdminRole
     */
    public function scopeSeniorAdmin($query)
    {
        return SeniorAdminRole::union($query);
    }

    /**
     * Scope a query to only include statuses whose `slug` matches the specified
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \App\Models\Role\AdminRole
     */
    public function scopeAdmin($query)
    {
        return AdminRole::union($query);
    }

    /**
     * Scope a query to only include statuses whose `slug` matches the specified
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \App\Models\Role\ManagerRole
     */
    public function scopeManager($query)
    {
        return ManagerRole::union($query);
    }

    /**
     * Scope a query to only include statuses whose `slug` matches the specified
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \App\Models\Role\EditorRole
     */
    public function scopeEditor($query)
    {
        return EditorRole::union($query);
    }

    /**
     * Scope a query to only include statuses whose `slug` matches the specified
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \App\Models\Role\ContractorRole
     */
    public function scopeContractor($query)
    {
        return ContractorRole::union($query);
    }

    /**
     * Scope a query to only include statuses whose `slug` matches the specified
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \App\Models\Role\CustomerRole
     */
    public function scopeCustomer($query)
    {
        return CustomerRole::union($query);
    }

    /**
     * Scope a query to only include statuses whose `slug` matches the specified
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \App\Models\Role\UserRole
     */
    public function scopeUser($query)
    {
        return UserRole::union($query);
    }
    
}
