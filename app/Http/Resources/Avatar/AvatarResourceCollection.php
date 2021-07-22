<?php

namespace App\Http\Resources\Avatar;

use App\Http\Resources\ApiResourceCollection;

class AvatarResourceCollection extends ApiResourceCollection
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Avatars retrieved successfully!';
    
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return Collection
     */
    public function toArray($request)
    {
        return $this->collection
            ->groupBy([
                'gender',
                function ($item) {
                    return $item['color'];
                },
            ], $preserveKeys = true);
    }
}
