<?php

namespace App\Http\Resources\Calculator\Adapters;

use App\Http\Resources\ApiResource;
use App\Schemes\Room\RoomSchema;

class FormFieldRoomResource extends ApiResource implements RoomSchema
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
            self::COLUMN_ID             => $this->{self::COLUMN_ID},
            self::COLUMN_NAME           => $this->{self::COLUMN_NAME},
            self::COLUMN_SLUG           => $this->{self::COLUMN_SLUG},
            self::COLUMN_MAX_COUNT      => $this->{self::COLUMN_MAX_COUNT },
            self::COLUMN_DEFAULT_COUNT  => $this->{self::COLUMN_DEFAULT_COUNT },
        ];
    }
    
}
