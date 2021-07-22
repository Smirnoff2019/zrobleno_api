<?php

namespace App\Http\Resources\Complaint\ComplaintResponse;

use App\Http\Resources\ApiResourceCollection;
use App\Schemes\ComplaintResponse\ComplaintResponseSchema;

class ComplaintResponseResourceCollection extends ApiResourceCollection implements ComplaintResponseSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Complaints response retrieved successfully!';

}
