<?php

namespace App\Http\Resources\Complaint\ComplaintResponse;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Complaint\ComplaintResource;
use App\Http\Resources\User\UserResource;
use App\Schemes\ComplaintResponse\ComplaintResponseSchema;
use Illuminate\Http\Request;

class ComplaintResponseResource extends ApiResource implements ComplaintResponseSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Complaint response retrieved successfully!';

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray( $request )
    {
        return [
            self::COLUMN_ID          => $this->{self::COLUMN_ID},
            'complaint'              => $this->when(
                                            $this->complaint,
                                            new ComplaintResource($this->complaint),
                                            null
                                        ),
            'response'               => $this->{self::COLUMN_RESPONSE_ID},//=> $this->when(
                                            //$this->complaint,
                                            //new ComplaintResource($this->complaint),
                                            //null
                                        //),
            'user'                   => $this->when(
                                            $this->user,
                                            new UserResource($this->user),
                                            null
                                        ),

            self::COLUMN_UPDATED_AT  => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT  => $this->{self::COLUMN_CREATED_AT},
        ];
    }

}
