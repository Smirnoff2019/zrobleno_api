<?php

namespace App\Http\Resources\Status;

use App\Http\Resources\ApiResource;
use App\Schemes\Status\StatusSchema;

class StatusResource extends ApiResource implements StatusSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Status record retrieved successfully!';

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
            self::COLUMN_SLUG           => $this->{self::COLUMN_SLUG},
            self::COLUMN_NAME           => $this->{self::COLUMN_NAME},
            self::COLUMN_DESCRIPTION    => $this->{self::COLUMN_DESCRIPTION},
            self::COLUMN_TYPE           => $this->{self::COLUMN_TYPE},
            self::COLUMN_GROUP          => $this->{self::COLUMN_GROUP},
            self::COLUMN_UPDATED_AT     => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT     => $this->{self::COLUMN_CREATED_AT},
        ];
    }
    
}
