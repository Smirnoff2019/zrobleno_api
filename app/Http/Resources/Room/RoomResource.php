<?php

namespace App\Http\Resources\Room;

use App\Schemes\Room\RoomSchema;
use App\Http\Resources\ApiResource;
use App\Http\Resources\Image\ImageCLKResource;
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
            self::COLUMN_ID         => $this->{self::COLUMN_ID},
            self::COLUMN_NAME       => $this->{self::COLUMN_NAME},
            self::COLUMN_SLUG       => $this->{self::COLUMN_SLUG},
            'optionsGroups'         => $this->optionsGroups->load('options')->toArray(),
            'image'                 => $this->whenLoaded('image', new ImageCLKResource($this->image)),
            'status'                => $this->whenLoaded('status', new StatusResource($this->status)),
            self::COLUMN_UPDATED_AT => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT => $this->{self::COLUMN_CREATED_AT},
        ];
    }
    
}
