<?php

namespace App\Http\Resources\TenderRefresh;

use App\Http\Resources\ApiResourceCollection;
use App\Schemes\TenderRefresh\TenderRefreshSchema;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class TenderRefreshResourceCollection extends ApiResourceCollection implements TenderRefreshSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Refresh from tender retrieved successfully!';

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
