<?php

namespace App\Models\ProjectRoom;

use App\Traits\Eloquent\BelongsTo\BelongsToRoom;
use App\Traits\Eloquent\BelongsTo\BelongsToProject;
use App\Schemes\ProjectRoom\ProjectRoomSchema;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProjectRoomPivot extends Pivot implements ProjectRoomSchema
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
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        self::COLUMN_UPDATED_AT,
        self::COLUMN_CREATED_AT,
    ];
    

}
