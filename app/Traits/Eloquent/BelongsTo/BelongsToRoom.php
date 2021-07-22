<?php

namespace App\Traits\Eloquent\BelongsTo;

use App\Models\Room\Room;
use App\Schemes\Relations\BelongsTo\BelongsToRoomSchema;

/**
 *  @method room()
 */
trait BelongsToRoom
{

    /**
     * Get the Room for the this essence.
     * 
     * @return BelongsTo \App\Models\Room\Room
     */
    public function room()
    {
        return $this->belongsTo(
            Room::class,
            BelongsToRoomSchema::COLUMN_ROOM_ID
        );
    }
}
