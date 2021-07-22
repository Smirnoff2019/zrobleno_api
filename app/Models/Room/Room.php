<?php

namespace App\Models\Room;

use App\Models\Option\Option;
use App\Models\OptionsGroup\OptionsGroup;
use App\Models\Project\Project;
use App\Schemes\Room\RoomSchema;
use App\Models\ProjectRoom\ProjectRoom;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Eloquent\BelongsTo\BelongsToStatus;
use Illuminate\Database\Eloquent\Builder;
use App\Models\ProjectRoom\ProjectRoomPivot;
use App\Schemes\Relations\BelongsTo\BelongsToRoomSchema;
use App\Traits\Eloquent\BelongsTo\BelongsToImage;
use App\Traits\Eloquent\Scopes\CommonStatusQueryScopes;

class Room extends Model implements RoomSchema
{

    use BelongsToStatus,
        BelongsToImage,
        CommonStatusQueryScopes;

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
        self::COLUMN_MAX_COUNT,
        self::COLUMN_DEFAULT_COUNT,
        self::COLUMN_IMAGE_ID,
        self::COLUMN_STATUS_ID,
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

    /**
     * The projects that belong to the room.
     * 
     * @return BelongsToMany \App\Models\Project\Project
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class)
            ->using(ProjectRoomPivot::class);
    }

    /**
     * The Project rooms that has the room.
     * 
     * @return HasMany \App\Models\ProjectRoom\ProjectRoom
     */
    public function projectRooms()
    {
        return $this->hasMany(ProjectRoom::class);
    }

    /**
     * The options groups for this room.
     * 
     * @return HasMany \App\Models\OptionsGroup\OptionsGroup
     */
    public function optionsGroups()
    {
        return $this->hasMany(
            OptionsGroup::class,
            BelongsToRoomSchema::COLUMN_ROOM_ID
        );
    }

    /**
     * The options for this room.
     * 
     * @return HasMany \App\Models\Options\Options
     */
    public function options()
    {
        return $this->hasMany(
            Option::class,
            BelongsToRoomSchema::COLUMN_ROOM_ID
        );
    }

    /**
     * Scope a query to only include rooms whose slug matches the specified
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string $slug
     * @return self
     */
    public function scopeSlug(Builder $query, string $slug)
    {
        return $query->whereSlug($slug);
    }

    /**
     * Scope a query to only include rooms whose slug matches the 'bathroom'
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return self
     */
    public function scopeBathroom(Builder $query)
    {
        return $query->whereSlug('bathroom')->first();
    }

    /**
     * Scope a query to only include rooms whose slug matches the 'living_room'
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return self
     */
    public function scopeLivingRoom(Builder $query)
    {
        return $query->whereSlug('living_room')->first();
    }

    /**
     * Scope a query to only include rooms whose slug matches the 'kitchen'
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return self
     */
    public function scopeKitchen(Builder $query)
    {
        return $query->whereSlug('kitchen')->first();
    }

    /**
     * Scope a query to only include rooms whose slug matches the 'bedroom'
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return self
     */
    public function scopeBedroom(Builder $query)
    {
        return $query->whereSlug('bedroom')->first();
    }

}
