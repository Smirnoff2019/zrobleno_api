<?php

namespace App\Http\Resources\TenderApplication;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Status\StatusResource;
use App\Http\Resources\Tender\TenderResource;
use App\Schemes\TenderApplication\TenderApplicationSchema;

class TenderApplicationResource extends ApiResource implements TenderApplicationSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Tender application retrieved successfully!';

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
            'uid'                   => $this->tender->uid,
            'tender'                => $this->when(
                $this->tender,
                new TenderResource($this->tender),
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
