<?php

namespace App\Models\PermissionRole;

use App\Schemes\PermissionRole\PermissionRoleSchema;
use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model implements PermissionRoleSchema
{



    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = self::TABLE;

    public $timestamps = false;

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

}
