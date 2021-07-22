<?php


namespace App\Http\Resources\Image;

use App\Http\Resources\ApiResourceCollection;
use App\Schemes\Image\ImageSchema;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ImageResourceCollection extends ApiResourceCollection implements ImageSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Images retrieved successfully!';

    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return Collection
     */
    public function toArray($request)
    {
        return $this->collection;
    }

}
