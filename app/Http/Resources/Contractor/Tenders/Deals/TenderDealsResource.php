<?php

namespace App\Http\Resources\Contractor\Tenders\Deals;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Status\StatusResource;
use App\Schemes\TenderApplication\TenderApplicationSchema;

class TenderDealsResource extends ApiResource implements TenderApplicationSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Tender deals retrieved successfully!';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            self::COLUMN_ID          => $this->{self::COLUMN_ID},
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
