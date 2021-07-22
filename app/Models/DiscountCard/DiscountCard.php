<?php

namespace App\Models\DiscountCard;

use App\Schemes\DiscountCard\DiscountCardSchema;
use App\Traits\Eloquent\BelongsTo\BelongsToStatus;
use App\Traits\Eloquent\BelongsTo\BelongsToTender;
use App\Traits\Eloquent\BelongsTo\BelongsToUser;
use Illuminate\Database\Eloquent\Model;

class DiscountCard extends Model implements DiscountCardSchema
{

    use BelongsToTender,
        BelongsToUser,
        BelongsToStatus;

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
        self::COLUMN_TENDER_ID,
        self::COLUMN_USER_ID,
        self::COLUMN_STATUS_ID,
        self::COLUMN_EXPIRATED_AT,
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
        self::COLUMN_EXPIRATED_AT,
        self::COLUMN_UPDATED_AT,
        self::COLUMN_CREATED_AT,
    ];
    
}
