<?php

namespace App\Models\UserLegalData;

use App\Schemes\UserLegalData\UserLegalDataSchema;
use App\Traits\Eloquent\BelongsTo\BelongsToUser;
use Illuminate\Database\Eloquent\Model;

class UserLegalData extends Model implements UserLegalDataSchema
{

    use BelongsToUser;

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
        self::COLUMN_BILL,
        self::COLUMN_MFO,
        self::COLUMN_EDRPOU_CODE,
        self::COLUMN_SERIAL_NUMBER,
        self::COLUMN_LEGAL_STATUS,
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

}
