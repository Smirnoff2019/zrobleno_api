<?php

namespace App\Http\Resources\User;

use App\Http\Resources\ApiResourceCollection;

class UserResourceCollection extends ApiResourceCollection
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Users retrieved successfully!';

}
