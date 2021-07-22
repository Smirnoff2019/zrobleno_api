<?php


namespace App\Http\Resources\Complaint\ComplaintRecipient;


use App\Http\Resources\ApiResource;
use App\Http\Resources\Complaint\ComplaintResource;
use App\Http\Resources\User\UserResource;
use App\Schemes\ComplaintRecipient\ComplaintRecipientSchema;
use Illuminate\Http\Request;

class ComplaintRecipientResource extends ApiResource implements ComplaintRecipientSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Complaint recipient retrieved successfully!';

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
            'complaint'              => $this->when(
                                            $this->complaint,
                                            new ComplaintResource($this->complaint),
                                            null
                                        ),
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
