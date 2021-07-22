<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\ApiResourceCollection;
use App\Schemes\Category\CategorySchema;

class PostCategoryResourceCollection extends ApiResourceCollection implements CategorySchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Categories retrieved successfully!';

}
