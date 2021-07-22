<?php

namespace App\Http\Resources\Tender\Application;

use App\Http\Resources\ApiResourceCollection;

class TenderApplicationResourceCollection extends ApiResourceCollection
{
    
    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Tenders applications retrieved successfully!';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

}
