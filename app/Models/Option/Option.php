<?php

namespace App\Models\Option;

use App\Schemes\Option\OptionSchema;
use App\Traits\Eloquent\BelongsTo\BelongsToImage;
use App\Traits\Eloquent\BelongsTo\BelongsToOptionsGroup;
use App\Traits\Eloquent\BelongsTo\BelongsToRoom;
use App\Traits\Eloquent\BelongsTo\BelongsToStatus;
use App\Traits\Filters\Filterable;
use App\Traits\Models\Option\OptionByRoomScopes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Option extends Model implements OptionSchema
{

    use BelongsToStatus,
        BelongsToImage,
        BelongsToRoom,
        BelongsToOptionsGroup,
        OptionByRoomScopes,
        Filterable;

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
        self::COLUMN_NAME,
        self::COLUMN_SLUG,
        self::COLUMN_DESCRIPTION,
        self::COLUMN_MIDDLEWARES,
        self::COLUMN_PRICE,
        self::COLUMN_COEFFICIENT,
        self::COLUMN_QUANTITY,
        self::COLUMN_DISPLAY,
        self::COLUMN_FORMULA_NAME,
        self::COLUMN_DEFAULT,
        self::COLUMN_SORT,
        self::COLUMN_ROOM_ID,
        self::COLUMN_OPTIONS_GROUP_ID,
        self::COLUMN_IMAGE_ID,
        self::COLUMN_STATUS_ID,
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        self::COLUMN_MIDDLEWARES => 'json',
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
     * Scope a query to only include posts with query
     *
     * @param Builder $query
     * @return Builder
     *
     * @method Builder defaultSelected()
     */
    public function scopeDefaultSelected(Builder $query): Builder
    {
        return $query->where(self::COLUMN_DEFAULT, true);
    }

}
