<?php

namespace App\Models\ProjectRoom;

use App\Models\Option\Option;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProjectOption\ProjectOption;
use App\Schemes\ProjectRoom\ProjectRoomSchema;
use App\Models\ProjectOption\ProjectOptionPivot;
use App\Traits\Eloquent\BelongsTo\BelongsToRoom;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Traits\Eloquent\BelongsTo\BelongsToProject;

class ProjectRoom extends Model implements ProjectRoomSchema
{

    use BelongsToRoom, 
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
        self::COLUMN_AREA,
        self::COLUMN_PROJECT_ID,
        self::COLUMN_ROOM_ID,
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
     * The rooms Options that belong to the project.
     * 
     * @return belongsToMany \App\Models\Option\Option
     */
    public function options()
    {
        return $this->belongsToMany(
            Option::class,
            ProjectOption::TABLE,
            ProjectOptionPivot::COLUMN_PROJECT_ROOM_ID,
        )
            ->using(ProjectOptionPivot::class)
            ->as('goohta')
            ->withTimestamps()
            ->withPivot([
                ProjectOptionPivot::COLUMN_ID,
                ProjectOptionPivot::COLUMN_OPTION_ID,
                ProjectOptionPivot::COLUMN_COUNT,
            ]);
    }

}
