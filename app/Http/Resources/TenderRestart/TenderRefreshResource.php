<?php

namespace App\Http\Resources\TenderRestart;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Status\StatusResource;
use App\Http\Resources\Tender\TenderResource;
use App\Schemes\TenderRestart\TenderRestartSchema;
use Illuminate\Http\Request;

class TenderRestartResource extends ApiResource implements TenderRestartSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Refresh from tender retrieved successfully!';

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            self::COLUMN_ID         => $this->{self::COLUMN_ID},
            'tender'                => $this->when(
                                           $this->tender,
                                           new TenderResource($this->tender),
                                           null
                                       ),
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
