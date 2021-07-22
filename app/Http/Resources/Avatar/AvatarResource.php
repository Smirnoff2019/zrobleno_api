<?php

namespace App\Http\Resources\Avatar;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Image\ImageCLKResource;
use App\Http\Resources\Status\StatusResource;
use App\Schemes\Avatar\AvatarSchema;

class AvatarResource extends ApiResource implements AvatarSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Avatar retrieved successfully!';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'     => $this->id,
            'name'   => $this->name,
            'gender' => $this->gender,
            'color'  => $this->color,
            'group'  => $this->group,
            'image'  => $this->whenLoaded('image', new ImageCLKResource($this->image)),
            'status' => $this->whenLoaded('status', new StatusResource($this->status)),
            
            self::COLUMN_UPDATED_AT => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT => $this->{self::COLUMN_CREATED_AT},
        ];
    }
    
}
