<?php

namespace App\Models\Project;

use App\Models\Room\Room;
use Illuminate\Support\Str;
use App\Models\Option\Option;
use App\Models\Tender\Tender;
use App\Schemes\Project\ProjectSchema;
use App\Models\ProjectRoom\ProjectRoom;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProjectOption\ProjectOption;
use App\Models\ProjectRoom\ProjectRoomPivot;
use App\Traits\Eloquent\BelongsTo\BelongsToUser;
use App\Traits\Eloquent\BelongsTo\BelongsToStatus;
use App\Models\CalculatorOption\CoefficientPerRegion;
use App\Models\CalculatorOption\CeilingHeightCoefficient;
use App\Models\CalculatorOption\PropertyConditionCoefficient;
use App\Models\CalculatorOption\PropertyWallsConditionCoefficient;
use App\Traits\Filters\Filterable;

class Project extends Model implements ProjectSchema
{

    use BelongsToStatus,
        BelongsToUser,
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
        self::COLUMN_TOTAL_AREA,
        self::COLUMN_TOTAL_PRICE,
        self::COLUMN_CITY,
        self::COLUMN_REGION_ID,
        self::COLUMN_CEILING_HEIGHT_ID,
        self::COLUMN_WALLS_CONDITION_ID,
        self::COLUMN_PROPERTY_CONDITION_ID,
        self::COLUMN_COMPONENTS,
        self::COLUMN_USER_ID,
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
        self::COLUMN_COMPONENTS => 'json',
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
     * Get the 
     *
     * @param  string  $value
     * @return string
     */
    public function getUidAttribute($value)
    {
        return Str::of($this->id)->padLeft(6, '0');
    }

    /**
     * Get the 
     *
     * @param  string  $value
     * @return string
     * @property $price_per_area
     */
    public function getPricePerAreaAttribute($value)
    {
        return $this->total_price / $this->total_area;
    }

    /**
     * Get the 
     *
     * @param  string  $value
     * @return array
     * @property $rooms
     */
    public function getRoomsAttribute($value)
    {
        $data = $this->components;
        if(!is_array($this->components)) {
            $data = json_decode($this->components);
        }

        $rooms_data = collect($data);
        
        $rooms = Room::whereIn('slug', $rooms_data->pluck('name'))->get();
        
        $res = $rooms_data->map(function($item) {
            $item = (object) $item;
            $item->room = Room::where('slug', $item->name)->first();
            $item->options = collect($item->options)->map(function($item) {
                $item = (object) $item;
                $item->option = Option::find($item->id);

                return (object) $item;
            });
            return (object) $item;
        });

        return $res;
    }

    /**
     * The property condition that belong to the project.
     * 
     * @return BelongsTo
     */
    public function propertyCondition()
    {
        return $this->belongsTo(
            PropertyConditionCoefficient::class, 
            self::COLUMN_PROPERTY_CONDITION_ID
        );
    }

    /**
     * The region that belong to the project.
     * 
     * @return BelongsTo
     */
    public function region()
    {
        return $this->belongsTo(
            CoefficientPerRegion::class, 
            self::COLUMN_REGION_ID
        );
    }

    /**
     * The property ceiling height that belong to the project.
     * 
     * @return BelongsTo
     */
    public function ceilingHeight()
    {
        return $this->belongsTo(
            CeilingHeightCoefficient::class, 
            self::COLUMN_CEILING_HEIGHT_ID
        );
    }

    /**
     * The property walls condition that belong to the project.
     * 
     * @return BelongsTo
     */
    public function wallsCondition()
    {
        return $this->belongsTo(
            PropertyWallsConditionCoefficient::class, 
            self::COLUMN_WALLS_CONDITION_ID
        );
    }

    /**
     * The temders that belong to the project.
     * 
     * @return HasMany \App\Models\Tender\Tender
     */
    public function tenders()
    {
        return $this->hasMany(Tender::class);
    }

    /**
     * The rooms that belong to the project.
     * 
     * @return BelongsToMany \App\Models\Room\Room
     */
    // public function rooms()
    // {
    //     return $this->belongsToMany(
    //         Room::class, 
    //         ProjectRoom::TABLE
    //     )
    //         ->using(ProjectRoomPivot::class)
    //         ->as('goohta')
    //         ->withTimestamps()
    //         ->withPivot([
    //             ProjectRoomPivot::COLUMN_ID,
    //             ProjectRoomPivot::COLUMN_ROOM_ID,
    //             ProjectRoomPivot::COLUMN_AREA,
    //         ]);
    // }

    /**
     * The rooms pivot data for the project.
     * 
     * @return HasMany \App\Models\ProjectRoom\ProjectRoom
     */
    public function projectRooms()
    {
        return $this->hasMany(ProjectRoom::class);
    }

    /**
     * The rooms Options that belong to the project.
     * 
     * @return belongsToMany \App\Models\Option\Option
     */
    public function options()
    {
        return $this->belongsToMany(
            Option::class,
            ProjectOption::TABLE,
        );
    }

    /**
     * The rooms Options that belong to the project.
     * 
     * @return array
     */
    public static function generateNewProjectData()
    {
        return [
            "total_area" => 58,
            "ceiling_height" => 1,
            "total_price" => rand(150000, 900000),
            "address" => null,
            "city" => null,
            "property_condition_id" => 1,
            "rooms" => [
                [
                    "slug" => "bathroom",
                    "area" => 12,
                    "options" => [
                        [
                            "id" => 1,
                            "count" => 1
                        ],
                        [
                            "id" => 6,
                            "count" => 1
                        ],
                        [
                            "id" => 13,
                            "count" => 1
                        ],
                        [
                            "id" => 18,
                            "count" => 1
                        ],
                    ]
                ],
                [
                    "slug" => "living_room",
                    "area" => 40,
                    "options" => [
                        [
                            "id" => 22,
                            "count" => 1
                        ],
                        [
                            "id" => 24,
                            "count" => 1
                        ],
                        [
                            "id" => 27,
                            "count" => 1
                        ],
                        [
                            "id" => 31,
                            "count" => 1
                        ],
                    ]
                ],
                [
                    "slug" => "kitchen",
                    "area" => 24,
                    "options" => [
                        [
                            "id" => 22,
                            "count" => 1
                        ],
                        [
                            "id" => 24,
                            "count" => 1
                        ],
                        [
                            "id" => 27,
                            "count" => 1
                        ],
                        [
                            "id" => 31,
                            "count" => 1
                        ],
                    ]
                ],
            ]
        ];
    }

}
