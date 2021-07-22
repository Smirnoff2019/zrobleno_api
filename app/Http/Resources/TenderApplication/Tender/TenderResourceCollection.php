<?php

namespace App\Http\Resources\TenderApplication\Tender;

use App\Http\Resources\ApiResourceCollection;

class TenderResourceCollection extends ApiResourceCollection
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Tenders retrieved successfully!';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection;
    }
}
