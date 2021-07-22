<?php

namespace App\Http\Resources\MetaField;

use App\Http\Resources\ApiResourceCollection;
use App\Schemes\MetaField\MetaFieldSchema;

class MetaFieldResourceCollection extends ApiResourceCollection implements MetaFieldSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'MetaFields retrieved successfully!';

}
