<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\ApiResourceCollection;
use App\Schemes\Post\PostSchema;

class PostResourceCollection extends ApiResourceCollection implements PostSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Posts retrieved successfully!';

}
