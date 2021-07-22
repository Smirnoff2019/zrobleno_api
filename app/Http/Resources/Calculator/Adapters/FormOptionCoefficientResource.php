<?php

namespace App\Http\Resources\Calculator\Adapters;

use App\Http\Resources\ApiResource;
use App\Schemes\CalculatorOption\CalculatorOptionSchema;

class FormOptionCoefficientResource extends ApiResource implements CalculatorOptionSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Coefficient retrieved successfully!';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            self::COLUMN_ID          => $this->{self::COLUMN_ID},
            self::COLUMN_NAME        => $this->{self::COLUMN_NAME},
            self::COLUMN_SLUG        => $this->{self::COLUMN_SLUG},
            self::COLUMN_VALUE       => $this->{self::COLUMN_VALUE},
        ];
    }
    
}
