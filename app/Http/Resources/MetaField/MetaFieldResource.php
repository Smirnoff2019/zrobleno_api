<?php

namespace App\Http\Resources\MetaField;

use App\Http\Resources\ApiResource;
use App\Schemes\MetaField\MetaFieldSchema;
use Illuminate\Http\Request;

class MetaFieldResource extends ApiResource implements MetaFieldSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Meta field retrieved successfully!';

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            self::COLUMN_ID          => $this->{self::COLUMN_ID},
            self::COLUMN_SLUG        => $this->{self::COLUMN_SLUG},
            self::COLUMN_NAME        => $this->{self::COLUMN_NAME},
            self::COLUMN_DESCRIPTION => $this->{self::COLUMN_DESCRIPTION},
            self::COLUMN_OPTIONS     => $this->{self::COLUMN_OPTIONS},

            self::COLUMN_UPDATED_AT  => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT  => $this->{self::COLUMN_CREATED_AT},
        ];
    }

}
