<?php

namespace App\Http\Resources\TenderDeals;

use App\Http\Resources\ApiResourceCollection;
use App\Schemes\TenderDeals\TenderDealsSchema;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class TenderDealsResourceCollection extends ApiResourceCollection implements TenderDealsSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Deals from tender retrieved successfully!';

    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return Collection
     */
    public function toArray($request)
    {
        return $this->collection;
    }

}
