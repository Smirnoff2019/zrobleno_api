<?php

namespace App\Http\Resources\PostType;

use App\Http\Resources\ApiResourceCollection;
use App\Schemes\PostType\PostTypeSchema;

class PostTypeResourceCollection extends ApiResourceCollection implements PostTypeSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'PostTypes retrieved successfully!';

}
