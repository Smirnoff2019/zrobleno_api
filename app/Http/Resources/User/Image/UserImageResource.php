<?php

namespace App\Http\Resources\User\Image;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Image\File\ImageFileResource;
use App\Http\Resources\Status\StatusResource;
use App\Schemes\Image\ImageSchema;
use Illuminate\Http\Request;

class UserImageResource extends ApiResource implements ImageSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Image from user retrieved successfully!';

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
            'file'                  => $this->when(
                                            $this->file,
                                            new ImageFileResource($this->file),
                                            null
                                        ),
            self::COLUMN_PARENT_ID  => $this->{self::COLUMN_PARENT_ID},
            'status'                => $this->when(
                                            $this->status,
                                            new StatusResource($this->status),
                                            null
                                        ),
            self::COLUMN_UPDATED_AT => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT => $this->{self::COLUMN_CREATED_AT},
        ];
    }
    
}
