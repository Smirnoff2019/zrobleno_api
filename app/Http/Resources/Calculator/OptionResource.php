<?php

namespace App\Http\Resources\Calculator;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Image\ImageCLKResource;
use App\Http\Resources\Status\StatusResource;
use App\Schemes\Option\OptionSchema;

class OptionResource extends ApiResource implements OptionSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Option retrieved successfully!';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            self::COLUMN_ID           => $this->{self::COLUMN_ID},
            self::COLUMN_NAME         => $this->{self::COLUMN_NAME},
            self::COLUMN_SLUG         => $this->{self::COLUMN_SLUG},
            self::COLUMN_DESCRIPTION  => $this->{self::COLUMN_DESCRIPTION},
            self::COLUMN_MIDDLEWARES  => $this->{self::COLUMN_MIDDLEWARES},
            self::COLUMN_PRICE        => $this->{self::COLUMN_PRICE},
            self::COLUMN_COEFFICIENT  => $this->{self::COLUMN_COEFFICIENT},
            self::COLUMN_QUANTITY     => $this->{self::COLUMN_QUANTITY},
            self::COLUMN_DISPLAY      => $this->{self::COLUMN_DISPLAY},
            self::COLUMN_FORMULA_NAME => $this->{self::COLUMN_FORMULA_NAME},
            self::COLUMN_DEFAULT      => $this->{self::COLUMN_DEFAULT},
            self::COLUMN_SORT         => $this->{self::COLUMN_SORT},
            'image'                   => $this->whenLoaded('image', new ImageCLKResource($this->image)),
            'status'                  => $this->whenLoaded('status', new StatusResource($this->status)),
            self::COLUMN_UPDATED_AT   => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT   => $this->{self::COLUMN_CREATED_AT},
        ];
    }
    
}
