<?php

namespace App\Http\Resources\Project\Room;

use App\Schemes\Room\RoomSchema;
use App\Http\Resources\ApiResource;
use App\Http\Resources\Status\StatusResource;

class RoomResource extends ApiResource implements RoomSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Room retrieved successfully!';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            self::COLUMN_NAME   => $this->{self::COLUMN_NAME},
            self::COLUMN_SLUG   => $this->{self::COLUMN_SLUG},
            'area'              => $this->when($this->pivot, $this->pivot['area'], null),
            'options'           => $this->when($this->options, $this->options),
            'status'            => new StatusResource($this->status),
        ];
    }
    
}
