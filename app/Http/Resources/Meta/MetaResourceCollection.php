<?php

namespace App\Http\Resources\Meta;

use App\Http\Resources\ApiResourceCollection;
use App\Schemes\Meta\MetaSchema;

class MetaResourceCollection extends ApiResourceCollection implements MetaSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Meta retrieved successfully!';

}
