<?php

namespace App\Http\Resources\Calculator;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Status\StatusResource;
use App\Schemes\CalculatorOption\CalculatorOptionSchema;

class FormulaResource extends ApiResource implements CalculatorOptionSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Formula retrieved successfully!';

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
            self::COLUMN_DESCRIPTION => $this->{self::COLUMN_DESCRIPTION},
            self::COLUMN_SLUG        => $this->{self::COLUMN_SLUG},
            self::COLUMN_TYPE        => $this->{self::COLUMN_TYPE},
            self::COLUMN_VALUE       => $this->{self::COLUMN_VALUE},
            'status'                 => new StatusResource($this->status),
            self::COLUMN_UPDATED_AT  => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT  => $this->{self::COLUMN_CREATED_AT},
        ];
    }
    
}
