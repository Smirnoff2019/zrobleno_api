<?php

namespace App\Http\Resources\Status;

use App\Http\Resources\ApiResourceCollection;

class StatusResourceCollection extends ApiResourceCollection
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Status records retrieved successfully!';

}
