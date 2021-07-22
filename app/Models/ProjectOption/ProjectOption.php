<?php

namespace App\Models\ProjectOption;

use App\Models\ProjectRoom\ProjectRoom;
use App\Schemes\ProjectOption\ProjectOptionSchema;
use App\Traits\Eloquent\BelongsTo\BelongsToOption;
use App\Traits\Eloquent\BelongsTo\BelongsToProject;
use Illuminate\Database\Eloquent\Model;

class ProjectOption extends Model implements ProjectOptionSchema
{

    use BelongsToOption,
        BelongsToProject;

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
        self::COLUMN_OPTION_ID,
        self::COLUMN_PROJECT_ROOM_ID,
        self::COLUMN_PROJECT_ID,
        self::COLUMN_COUNT,
        self::COLUMN_PRICE,
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        self::COLUMN_COUNT => 1,
        self::COLUMN_PRICE => 0,
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

    /**
     * Get a belongs option
     *
     * @return BelongsTo \App\Models\ProjectRoom\ProjectRoom
     */
    public function projectRoom()
    {
        return $this->belongsTo(ProjectRoom::class);
    }

}
