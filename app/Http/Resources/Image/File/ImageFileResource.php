<?php

namespace App\Http\Resources\Image\File;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Status\StatusResource;
use App\Schemes\File\FileSchema;
use Illuminate\Http\Request;

class ImageFileResource extends ApiResource implements FileSchema
{
    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'File retrieved successfully!';

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
            self::COLUMN_URL         => $this->{self::COLUMN_URL},
            self::COLUMN_URI         => $this->{self::COLUMN_URI},
            self::COLUMN_PATH        => $this->{self::COLUMN_PATH},
            self::COLUMN_NAME        => $this->{self::COLUMN_NAME},
            self::COLUMN_TITLE       => $this->{self::COLUMN_TITLE},
            self::COLUMN_DESCRIPTION => $this->{self::COLUMN_DESCRIPTION},
            self::COLUMN_FORMAT      => $this->{self::COLUMN_FORMAT},
            self::COLUMN_SIZE        => $this->{self::COLUMN_SIZE},
            self::COLUMN_SORT        => $this->{self::COLUMN_SORT},
            self::COLUMN_STATUS_ID   => $this->when(
                                            $this->status,
                                            new StatusResource($this->status),
                                            null
                                        ),
            self::COLUMN_USER_ID     => $this->{self::COLUMN_USER_ID},

            self::COLUMN_UPDATED_AT  => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT  => $this->{self::COLUMN_CREATED_AT},
        ];
    }
}
