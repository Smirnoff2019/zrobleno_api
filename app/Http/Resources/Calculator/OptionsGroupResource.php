<?php

namespace App\Http\Resources\Calculator;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Image\ImageCLKResource;
use App\Http\Resources\Status\StatusResource;
use App\Schemes\OptionsGroup\OptionsGroupSchema;

class OptionsGroupResource extends ApiResource implements OptionsGroupSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Options group retrieved successfully!';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            self::COLUMN_ID         => $this->{self::COLUMN_ID},
            self::COLUMN_NAME       => $this->{self::COLUMN_NAME},
            self::COLUMN_SLUG       => $this->{self::COLUMN_SLUG},
            self::COLUMN_POSITION_X => $this->{self::COLUMN_POSITION_X},
            self::COLUMN_POSITION_Y => $this->{self::COLUMN_POSITION_Y},
            self::COLUMN_DISPLAY    => $this->{self::COLUMN_DISPLAY},
            self::COLUMN_SORT       => $this->{self::COLUMN_SORT},
            'options'               => new OptionResourceCollection($this->options->sortBy('sort')),
            'image'                 => $this->whenLoaded('image', new ImageCLKResource($this->image)),
            'status'                => $this->whenLoaded('status', new StatusResource($this->status)),
            self::COLUMN_UPDATED_AT => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT => $this->{self::COLUMN_CREATED_AT},
        ];
    }
    
}
