<?php

namespace App\Http\Resources\Meta\MetaField;

use App\Http\Resources\ApiResourceCollection;
use App\Schemes\MetaField\MetaFieldSchema;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class MetaFieldResourceCollection extends ApiResourceCollection implements MetaFieldSchema
{

    /**
    * HTTP response status message
    *
    * @var string
    */
    protected $responseMessage = 'MetaFields retrieved successfully!';

    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return Collection
     */
    public function toArray( $request )
    {
        return $this->collection;
    }

}
