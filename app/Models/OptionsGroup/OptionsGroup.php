<?php

namespace App\Models\OptionsGroup;

use App\Models\Option\Option;
use App\Schemes\OptionsGroup\OptionsGroupSchema;
use App\Schemes\Relations\BelongsTo\BelongsToOptionsGroupSchema;
use App\Traits\Eloquent\BelongsTo\BelongsToImage;
use App\Traits\Eloquent\BelongsTo\BelongsToRoom;
use App\Traits\Eloquent\BelongsTo\BelongsToStatus;
use App\Traits\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class OptionsGroup extends Model implements OptionsGroupSchema
{

    use BelongsToStatus,
        BelongsToImage,
        BelongsToRoom,
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
        self::COLUMN_SORT,
        self::COLUMN_POSITION_X,
        self::COLUMN_POSITION_Y,
        self::COLUMN_DISPLAY,
        self::COLUMN_ROOM_ID,
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
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        self::COLUMN_UPDATED_AT,
        self::COLUMN_CREATED_AT,
    ];
    
    /**
     * The room options that has the room options group.
     * 
     * @return HasMany \App\Models\Options\Options
     */
    public function options()
    {
        return $this->hasMany(
            Option::class,
            BelongsToOptionsGroupSchema::COLUMN_OPTIONS_GROUP_ID
        );
    }

}
