<?php

namespace App\Http\Resources\Post\ParentPost;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Image\ImageResource;
use App\Http\Resources\PostType\PostTypeResource;
use App\Http\Resources\Status\StatusResource;
use App\Http\Resources\User\UserResource;
use App\Schemes\Post\PostSchema;
use Illuminate\Http\Request;

class ParentPostResource extends ApiResource implements PostSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Post retrieved successfully!';

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
            self::COLUMN_TITLE       => $this->{self::COLUMN_TITLE},
            self::COLUMN_DESCRIPTION => $this->{self::COLUMN_DESCRIPTION},
            self::COLUMN_CONTENT     => $this->{self::COLUMN_CONTENT},
            'post_type'              => $this->{self::COLUMN_POST_TYPE},
            'parent'                 => $this->{self::COLUMN_PARENT_ID},
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
//            'meta_fields' => new PostMetaFieldsResourceCollection(
//                $this->metaFields
//                        ->loadMissing(
//                            'children',
//                            'data',
//                            'type'
//                        )
//            ),
            self::COLUMN_UPDATED_AT  => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT  => $this->{self::COLUMN_CREATED_AT},
        ];

    }

}
