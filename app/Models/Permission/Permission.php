<?php

namespace App\Models\Permission;

use App\Models\Role\Role;
use App\Schemes\Permission\PermissionSchema;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model implements PermissionSchema
{

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
        //self::COLUMN_,
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        //
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        //
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        self::COLUMN_UPDATED_AT,
        self::COLUMN_CREATED_AT,
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        //
    ];

    public function roles () {
        return $this->belongsToMany(Role::class, 'roles_permissions');
    }

    public function sub_permissions () {
        return $this->hasMany(Permission::class, 'parent_id', 'id');
    }

}
