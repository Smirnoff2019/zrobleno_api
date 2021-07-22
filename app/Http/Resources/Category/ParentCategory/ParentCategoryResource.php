<?php

namespace App\Http\Resources\Category\ParentCategory;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Image\ImageResource;
use App\Http\Resources\Status\StatusResource;
use App\Http\Resources\User\UserResource;
use App\Schemes\Category\CategorySchema;
use Illuminate\Http\Request;

class ParentCategoryResource extends ApiResource implements CategorySchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Parent categories retrieved successfully!';

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray( $request )
    {
        return [
            self::COLUMN_ID          => $this->{self::COLUMN_ID},
            self::COLUMN_SLUG        => $this->{self::COLUMN_SLUG},
            self::COLUMN_NAME        => $this->{self::COLUMN_NAME},
            self::COLUMN_DESCRIPTION => $this->{self::COLUMN_DESCRIPTION},
            self::COLUMN_PARENT_ID   => $this->{self::COLUMN_PARENT_ID},
            'user'                   => $this->when(
                                            $this->user,
                                            new UserResource($this->user),
                                            null
                                        ),
            'image'                  => $this->when(
                                            $this->image,
                                            new ImageResource($this->image),
                                            null
                                        ),
            'status'                 => $this->when(
                                            $this->status,
                                            new StatusResource($this->status),
                                            null
                                        ),

            self::COLUMN_UPDATED_AT  => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT  => $this->{self::COLUMN_CREATED_AT},
        ];
    }

}
