<?php

namespace App\Models\Role;

use App\Models\User\User;
use App\Schemes\Role\RoleSchema;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\Role\RoleTypesScopes;
use App\Traits\Eloquent\BelongsTo\BelongsToImage;
use App\Traits\Eloquent\BelongsTo\BelongsToStatus;
use App\Models\Permission\Permission;
use App\Models\SupplierDiscount\SupplierDiscount;

class Role extends Model implements RoleSchema
{

    use BelongsToStatus,
        BelongsToImage,
        RoleTypesScopes;


    /**
     * The role slug default value.
     *
     * @var string
     */
    const DEFAULT_SLUG = '';

    /**
     * The role name default value.
     *
     * @var string
     */
    const DEFAULT_NAME = '';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = self::TABLE;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::COLUMN_SLUG,
        self::COLUMN_NAME,
        self::COLUMN_DESCRIPTION,
        self::COLUMN_IMAGE_ID,
        self::COLUMN_STATUS_ID,
    ];

    /**
     * List of main roles
     *
     * @var array
     */
    const MAIN_ROLES = [
        [
            self::COLUMN_SLUG => SuperUserRole::DEFAULT_SLUG,
            self::COLUMN_NAME => SuperUserRole::DEFAULT_NAME,
        ],
        [
            self::COLUMN_SLUG => SeniorAdminRole::DEFAULT_SLUG,
            self::COLUMN_NAME => SeniorAdminRole::DEFAULT_NAME,
        ],
        [
            self::COLUMN_SLUG => AdminRole::DEFAULT_SLUG,
            self::COLUMN_NAME => AdminRole::DEFAULT_NAME,
        ],
        [
            self::COLUMN_SLUG => ManagerRole::DEFAULT_SLUG,
            self::COLUMN_NAME => ManagerRole::DEFAULT_NAME,
        ],
        [
            self::COLUMN_SLUG => EditorRole::DEFAULT_SLUG,
            self::COLUMN_NAME => EditorRole::DEFAULT_NAME,
        ],
        [
            self::COLUMN_SLUG => ContractorRole::DEFAULT_SLUG,
            self::COLUMN_NAME => ContractorRole::DEFAULT_NAME,
        ],
        [
            self::COLUMN_SLUG => CustomerRole::DEFAULT_SLUG,
            self::COLUMN_NAME => CustomerRole::DEFAULT_NAME,
        ],
        [
            self::COLUMN_SLUG => UserRole::DEFAULT_SLUG,
            self::COLUMN_NAME => UserRole::DEFAULT_NAME,
        ],
    ];

    /**
     * Get the role owners.
     *
     * @return hasMany \App\Models\User\User
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the supplier discount for the this role.
     * 
     * @return HasMany \App\Models\SupplierDiscount\SupplierDiscount
     */
    public function supplierDiscounts()
    {
        return $this->hasMany(
            SupplierDiscount::class,
            SupplierDiscount::COLUMN_ROLE_ID
        );
    }

    /**
     * Get the main roles list
     *
     * @return array static::MAIN_ROLES
     */
    public static function getMainRolesList() : array
    {
        return (array) static::MAIN_ROLES;
    }

    public function permissions () {
        return $this->belongsToMany(Permission::class, 'roles_permissions');
    }

}
