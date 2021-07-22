<?php

namespace App\Models\File;

use App\Schemes\File\FileSchema;
use App\Traits\Eloquent\BelongsTo\BelongsToStatus;
use App\Traits\Eloquent\BelongsTo\BelongsToUser;
use Illuminate\Database\Eloquent\Model;

class File extends Model implements FileSchema
{
    use BelongsToStatus,
        BelongsToUser;

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
        self::COLUMN_URL,
        self::COLUMN_URI,
        self::COLUMN_PATH,
        self::COLUMN_NAME,
        self::COLUMN_TITLE,
        self::COLUMN_DESCRIPTION,
        self::COLUMN_FORMAT,
        self::COLUMN_SIZE,
        self::COLUMN_SORT,
        self::COLUMN_STATUS_ID,
        self::COLUMN_USER_ID,
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
}
