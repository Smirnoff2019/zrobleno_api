<?php

namespace App\Models\Status;

use App\Schemes\Status\StatusSchema;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Eloquent\HasMany\HasManyRoles;
use App\Traits\Eloquent\HasMany\HasManyUsers;
use App\Traits\Eloquent\HasMany\HasManyImages;
use App\Traits\Eloquent\HasMany\HasManyPayments;
use App\Traits\Models\Status\BaseAttributesScopes;

class Status extends Model implements StatusSchema
{

    use HasManyImages, 
        HasManyRoles,
        HasManyPayments,
        HasManyUsers;
    
    use BaseAttributesScopes;

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
        self::COLUMN_TYPE,
        self::COLUMN_GROUP,
    ];

}