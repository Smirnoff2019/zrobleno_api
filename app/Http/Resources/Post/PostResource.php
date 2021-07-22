<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Image\ImageResource;
use App\Http\Resources\Meta\MetaResource;
use App\Http\Resources\Post\ParentPost\ParentPostResource;
use App\Http\Resources\PostType\PostTypeResource;
use App\Http\Resources\Status\StatusResource;
use App\Http\Resources\User\UserResource;
use App\Schemes\Post\PostSchema;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;

class PostResource extends ApiResource implements PostSchema
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

        $this->loadMissing(['storage', 'status', 'image', 'user', 'postType']);

        return [
            self::COLUMN_ID          => $this->{self::COLUMN_ID},
            self::COLUMN_SLUG        => $this->{self::COLUMN_SLUG},
            self::COLUMN_TITLE       => $this->{self::COLUMN_TITLE},
            self::COLUMN_DESCRIPTION => $this->{self::COLUMN_DESCRIPTION},
            self::COLUMN_CONTENT     => $this->{self::COLUMN_CONTENT},
            'post_type'              => $this->when(
                                            $this->postType,
                                            new PostTypeResource($this->postType),
                                            null
                                        ),
            'parent'                 => $this->when(
                                            $this->parent,
                                            new ParentPostResource($this->parent),
                                            null
                                        ),
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
            'categories'             => $this->when(
                                            $this->categories,
                                            new PostCategoryResourceCollection($this->categories),
                                            null
                                        ),
        //    'meta'                   => MetaResource::collection(
        //                                    $this->meta
        //                                ),
            'meta_storage'           => $this->whenLoaded(
                                            'storage',
                                            function()
                                            {
                                                return $this->storage->mapWithKeys(
                                                    function ($item)
                                                    {
                                                        return [
                                                            $item->slug => $item->pivot->value
                                                        ];
                                                    }
                                                );
                                            }
                                        ),

            self::COLUMN_UPDATED_AT  => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT  => $this->{self::COLUMN_CREATED_AT},
        ];

    }

}
