<?php

namespace App\Http\Resources\Project\Option;

use App\Http\Resources\ApiResource;
use App\Schemes\Option\OptionSchema;
use App\Http\Resources\Status\StatusResource;

class OptionResource extends ApiResource implements OptionSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Option retrieved successfully!';

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
            'project_room_id'           => $this->when($this->project_room_id, $this->project_room_id),
            'room_id'                   => $this->{$this::COLUMN_ROOM_ID},
            // 'room_id'                   => $this->when($this->{$this::COLUMN_ROOM_ID}, $this->{$this::COLUMN_ROOM_ID}),
            'status'                    => new StatusResource($this->status),
            'image'                     => $this->image,
            self::COLUMN_UPDATED_AT     => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT     => $this->{self::COLUMN_CREATED_AT},
        ];
    }
    
}
