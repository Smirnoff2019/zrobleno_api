<?php

namespace App\Http\Resources\Matables;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Meta\MetaResource;
use App\Schemes\Metables\MetablesSchema;
use Illuminate\Http\Request;

class MetablesResource extends ApiResource implements MetablesSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Metables retrieved successfully!';

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray( $request )
    {
        return [
            self::COLUMN_ID            => $this->{self::COLUMN_ID},
            'meta'                     => $this->when(
                                              $this->meta,
                                              new MetaResource($this->meta),
                                              null
                                          ),
            self::COLUMN_VALUE         => $this->{self::COLUMN_VALUE},
            self::COLUMN_ACTION        => $this->{self::COLUMN_ACTION},

            self::COLUMN_UPDATED_AT   => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT   => $this->{self::COLUMN_CREATED_AT},
        ];
    }

}