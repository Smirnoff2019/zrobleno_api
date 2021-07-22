<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\ApiResourceCollection;
use App\Schemes\Category\CategorySchema;

class CategoryResourceCollection extends ApiResourceCollection implements CategorySchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Categories retrieved successfully!';

}
