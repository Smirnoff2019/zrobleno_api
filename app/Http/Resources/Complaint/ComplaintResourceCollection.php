<?php

namespace App\Http\Resources\Complaint;

use App\Http\Resources\ApiResourceCollection;
use App\Schemes\Complaint\ComplaintSchema;

class ComplaintResourceCollection extends ApiResourceCollection implements ComplaintSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Complaints retrieved successfully!';

}
