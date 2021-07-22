<?php

namespace App\Http\Resources\User\Tender;

use App\Http\Resources\ApiResourceCollection;

class TenderResourceCollection extends ApiResourceCollection
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'User tenders retrieved successfully';

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
