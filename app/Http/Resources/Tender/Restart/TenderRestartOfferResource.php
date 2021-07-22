<?php

namespace App\Http\Resources\Tender\Restart;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Status\StatusResource;
use App\Schemes\TenderRestart\TenderRestartSchema;

class TenderRestartOfferResource extends ApiResource implements TenderRestartSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Tender restart offer retrieved successfully!';

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
            'tender'                => $this->{self::COLUMN_TENDER_ID},
            'new_tender'            => $this->{self::COLUMN_NEW_TENDER_ID},
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
