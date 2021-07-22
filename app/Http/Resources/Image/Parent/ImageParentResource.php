<?php

namespace App\Http\Resources\Image\Parent;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Status\StatusResource;
use App\Schemes\Image\ImageSchema;
use Illuminate\Http\Request;

class ImageParentResource extends ApiResource implements ImageSchema
{
    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Image retrieved successfully!';

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            self::COLUMN_ID         => $this->{self::COLUMN_ID},
            self::COLUMN_FILE_ID    => $this->{self::COLUMN_FILE_ID},
            self::COLUMN_PARENT_ID  => $this->{self::COLUMN_PARENT_ID},
            self::COLUMN_STATUS_ID  => $this->when(
                                           $this->status,
                                           new StatusResource($this->status),
                                           null
                                        ),
            self::COLUMN_UPDATED_AT => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT => $this->{self::COLUMN_CREATED_AT},
        ];
    }
}