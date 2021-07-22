<?php

namespace App\Http\Resources\TenderDeals;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Status\StatusResource;
use App\Http\Resources\Tender\TenderResource;
use App\Http\Resources\TenderDeals\users\UserDealsResource;
use App\Schemes\TenderDeals\TenderDealsSchema;
use Illuminate\Http\Request;

class TenderDealsResource extends ApiResource implements TenderDealsSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Deals from tender retrieved successfully!';

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
            'customer'              => $this->when(
                                            $this->customer,
                                            new UserDealsResource($this->customer),
                                            null
                                    ),
            'contractor'            => $this->when(
                                            $this->contractor,
                                            new UserDealsResource($this->contractor),
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
