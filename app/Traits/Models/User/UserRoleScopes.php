<?php

namespace App\Traits\Models\User;

use App\Models\Role\Role;
use App\Models\Role\UserRole;
use App\Models\Role\AdminRole;
use App\Models\Role\EditorRole;
use App\Models\Role\ManagerRole;
use App\Models\Role\OwnerQARole;
use App\Models\Role\CustomerRole;
use App\Models\Role\SuperUserRole;
use App\Models\Role\ContractorRole;
use App\Models\Role\SeniorAdminRole;
use Illuminate\Database\Eloquent\Builder;

trait UserRoleScopes
{

    /**
     * Scope a query to only include users who have this role
     *
     * @param  Builder  $query
     * @param  string[:\App\Models\Role\Role]  $roleClassName
     * @return Builder
     */
    public function scopeHasRole($query, string $roleClassName)
    {
        return $query->whereHas('role', function (Builder $query) use ($roleClassName) {
            $query->where(
                Role::COLUMN_SLUG,
                $roleClassName::DEFAULT_SLUG
            );
        });
    }

    /**
     * Scope a query to only include users who have this role Admin
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeAdmin($query)
    {
        return $query->whereHas('role', function (Builder $query) {
            $query->where(
                Role::COLUMN_SLUG,
                AdminRole::DEFAULT_SLUG
            );
        });
    }

    /**
     * Scope a query to only include users who have this role Contractor
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeContractor($query)
    {
        return $query->whereHas('role', function (Builder $query) {
            $query->where(
                Role::COLUMN_SLUG,
                ContractorRole::DEFAULT_SLUG
            );
        });
    }

    /**
     * Scope a query to only include users who have this role Customer
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeCustomer($query)
    {
        return $query->whereHas('role', function (Builder $query) {
            $query->where(
                Role::COLUMN_SLUG,
                CustomerRole::DEFAULT_SLUG
            );
        });
    }

    /**
     * Scope a query to only include users who have this role Editor
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeEditor($query)
    {
        return $query->whereHas('role', function (Builder $query) {
            $query->where(
                Role::COLUMN_SLUG,
                EditorRole::DEFAULT_SLUG
            );
        });
    }

    /**
     * Scope a query to only include users who have this role Manager
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeManager($query)
    {
        return $query->whereHas('role', function (Builder $query) {
            $query->where(
                Role::COLUMN_SLUG,
                ManagerRole::DEFAULT_SLUG
            );
        });
    }

    /**
     * Scope a query to only include users who have this role OwnerQA
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeOwnerQA($query)
    {
        return $query->whereHas('role', function (Builder $query) {
            $query->where(
                Role::COLUMN_SLUG,
                OwnerQARole::DEFAULT_SLUG
            );
        });
    }

    /**
     * Scope a query to only include users who have this role SeniorAdmin
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeSeniorAdmin($query)
    {
        return $query->whereHas('role', function (Builder $query) {
            $query->where(
                Role::COLUMN_SLUG,
                SeniorAdminRole::DEFAULT_SLUG
            );
        });
    }

    /**
     * Scope a query to only include users who have this role SuperUser
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeSuperUser($query)
    {
        return $query->whereHas('role', function (Builder $query) {
            $query->where(
                Role::COLUMN_SLUG,
                SuperUserRole::DEFAULT_SLUG
            );
        });
    }

    /**
     * Scope a query to only include users who have this role User
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeUser($query)
    {
        return $query->whereHas('role', function (Builder $query) {
            $query->where(
                Role::COLUMN_SLUG,
                UserRole::DEFAULT_SLUG
            );
        });
    }

    /**
     * Scope a query to only include users who have this role User
     *
     * @return bool
     */
    public function scopeIsCustomer($query, $callback = null)
    {
        $result = (bool) $this->role && $this->role->{Role::COLUMN_SLUG} === CustomerRole::DEFAULT_SLUG;
        
        if($result && $callback) {
            return with($this, $callback);
        }

        return $result;
    }

    /**
     * Scope a query to only include users who have this role User
     *
     * @return bool
     */
    public function scopeIsContractor($query, $callback = null)
    {
        $result = (bool) $this->role && $this->role->{Role::COLUMN_SLUG} === ContractorRole::DEFAULT_SLUG;
        
        if($result && $callback) {
            return with($this, $callback);
        }

        return $result;
    }

    /**
     * Scope a query to only include users who have this role User
     *  
     * @param string  $roleClass
     * @return bool
     */
    public function scopeIsRole($query, string $roleClass, $callback = null)
    {
        $result = (bool) $this->role && $this->role->{Role::COLUMN_SLUG} === $roleClass::DEFAULT_SLUG;
        
        if($result && $callback) {
            return with($this, $callback);
        }

        return $result;
    }
    
}
