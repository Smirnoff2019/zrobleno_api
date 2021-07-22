<?php

namespace App\Http\Resources\UserPersonalDataChangeResource;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Status\StatusResource;
use App\Http\Resources\User\UserResource;
use App\Schemes\UserPersonalDataChangeRequests\UserPersonalDataChangeRequestsSchema;

class UserPersonalDataChangeResource extends ApiResource implements UserPersonalDataChangeRequestsSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'User personal data change retrieved successfully';

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
            self::COLUMN_DATA       => $this->{self::COLUMN_DATA},
            'user'                  => $this->when(
                                           $this->user,
                                           new UserResource($this->user),
                                           null
                                       ),
            'status'                => $this->when(
                                          $this->status,
                                          new StatusResource($this->status),
                                          null
                                       ),
            self::COLUMN_UPDATED_AT => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT => $this->{self::COLUMN_CREATED_AT},
        ];
    }

}
