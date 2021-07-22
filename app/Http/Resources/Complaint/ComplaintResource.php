<?php

namespace App\Http\Resources\Complaint;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Status\StatusResource;
use App\Http\Resources\User\UserResource;
use App\Schemes\Complaint\ComplaintSchema;
use Illuminate\Http\Request;

class ComplaintResource extends ApiResource implements ComplaintSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Complaint retrieved successfully!';

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            self::COLUMN_ID          => $this->{self::COLUMN_ID},
            self::COLUMN_SUBJECT     => $this->{self::COLUMN_SUBJECT},
            self::COLUMN_MESSAGE     => $this->{self::COLUMN_MESSAGE},
            'user'                   => $this->when(
                                            $this->user,
                                            new UserResource($this->user),
                                            null
                                        ),
            'recipient'             => $this->when(
                                            $this->recipient,
                                            new UserResource($this->recipient),
                                            null
                                        ),
            'status'                 => $this->when(
                                            $this->status,
                                            new StatusResource($this->status),
                                            null
                                        ),

            self::COLUMN_UPDATED_AT  => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT  => $this->{self::COLUMN_CREATED_AT},
        ];
    }

}
