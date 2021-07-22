<?php

namespace App\Models\MetaField;

use Illuminate\Database\Eloquent\Model;
use App\Schemes\MetaField\MetaFieldSchema;

class MetaField extends Model implements MetaFieldSchema
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
        self::COLUMN_SLUG,
        self::COLUMN_NAME,
        self::COLUMN_DESCRIPTION,
        self::COLUMN_OPTIONS
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        self::COLUMN_OPTIONS => 'json',
    ];

}
