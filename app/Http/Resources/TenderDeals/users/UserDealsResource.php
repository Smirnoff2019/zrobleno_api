<?php

namespace App\Http\Resources\TenderDeals\users;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Role\RoleResource;
use App\Http\Resources\Status\StatusResource;
use App\Http\Resources\User\Image\UserImageResource;
use App\Schemes\User\UserSchema;

class UserDealsResource extends ApiResource implements UserSchema
{
    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'User retrieved successfully';

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
            self::COLUMN_FIRST_NAME     => $this->{self::COLUMN_FIRST_NAME},
            self::COLUMN_MIDDLE_NAME    => $this->{self::COLUMN_MIDDLE_NAME},
            self::COLUMN_LAST_NAME      => $this->{self::COLUMN_LAST_NAME},
            self::COLUMN_EMAIL          => $this->{self::COLUMN_EMAIL},
            self::COLUMN_PHONE          => $this->{self::COLUMN_PHONE},
            self::COLUMN_IMAGE_ID       => $this->when(
                                               $this->image,
                                               new UserImageResource($this->image),
                                               null
                                           ),
            self::COLUMN_ROLE_ID        => $this->when(
                                               $this->role,
                                               new RoleResource($this->role),
                                               null
                                           ),
            self::COLUMN_STATUS_ID      => $this->when(
                                               $this->role,
                                               new StatusResource($this->role),
                                               null
                                           ),
            self::COLUMN_ACCOUNT_ID     => $this->when(
                                               $this->account,
                                               $this->account,
                                               null
                                           ),
            self::COLUMN_UPDATED_AT     => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT     => $this->{self::COLUMN_CREATED_AT},
        ];
    }
}
