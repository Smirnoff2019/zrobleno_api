<?php

namespace App\Http\Resources\File;

use Illuminate\Http\Request;
use App\Schemes\File\FileSchema;
use App\Http\Resources\ApiResource;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\Status\StatusResource;

class FileResource extends ApiResource implements FileSchema
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
            'status'                 => $this->when(
                                            $this->status,
                                            new StatusResource($this->status),
                                            null
                                        ),
            'user'                   => $this->when(
                                            $this->user, 
                                            new UserResource($this->user), 
                                            null
                                        ),

            self::COLUMN_UPDATED_AT  => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT  => $this->{self::COLUMN_CREATED_AT},
        ];
    }

}
