<?php

namespace App\Http\Resources\Meta\Parent;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Meta\MetaField\MetaFieldResource;
use App\Schemes\Meta\MetaSchema;
use Illuminate\Http\Request;

class ParentMetaResource extends ApiResource implements MetaSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Parent meta retrieved successfully!';

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
            self::COLUMN_SLUG          => $this->{self::COLUMN_SLUG},
            self::COLUMN_NAME          => $this->{self::COLUMN_NAME},
            self::COLUMN_DESCRIPTION   => $this->{self::COLUMN_DESCRIPTION},

            'parent'                   => $this->{self::COLUMN_PARENT_ID},
            'metaField'                => $this->when(
                                              $this->metaField,
                                              new MetaFieldResource($this->metaField),
                                              null
                                          ),
            self::COLUMN_UPDATED_AT    => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT    => $this->{self::COLUMN_CREATED_AT},
        ];
    }

}
