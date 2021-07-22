<?php

namespace App\Http\Resources\Role;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Status\StatusResource;
use App\Schemes\Role\RoleSchema;

class RoleResource extends ApiResource implements RoleSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Role retrieved successfully';

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
            self::COLUMN_DESCRIPTION    => $this->{self::COLUMN_DESCRIPTION},
            'image'                     => $this->when($this->image, $this->image),
            'status'                    => $this->when($this->status, new StatusResource($this->status)),
            'permissions'               => $this->when($this->permissions, $this->permissions, []),
            self::COLUMN_UPDATED_AT     => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT     => $this->{self::COLUMN_CREATED_AT},
        ];
    }
    
}
