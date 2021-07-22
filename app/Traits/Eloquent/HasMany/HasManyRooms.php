<?php

namespace App\Traits\Eloquent\HasMany;

use App\Models\Room\Room;

trait HasManyRooms
{

    /**
     * Get the related Rooms
     * 
     * @return HasMany 
     */
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
    
}
