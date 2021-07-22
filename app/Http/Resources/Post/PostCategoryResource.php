<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Category\ParentCategory\ParentCategoryResource;
use App\Http\Resources\Image\ImageResource;
use App\Http\Resources\Meta\MetaResource;
use App\Http\Resources\Status\StatusResource;
use App\Http\Resources\Taxonomy\TaxonomyResource;
use App\Http\Resources\User\UserResource;
use App\Schemes\Category\CategorySchema;
use Illuminate\Http\Request;

class PostCategoryResource extends ApiResource implements CategorySchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Category retrieved successfully!';

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray( $request )
    {
        // $this->loadMissing(['taxonomies', 'meta', 'status', 'image', 'user', 'children']);

        return [
            self::COLUMN_ID          => $this->{self::COLUMN_ID},
            self::COLUMN_SLUG        => $this->{self::COLUMN_SLUG},
            self::COLUMN_NAME        => $this->{self::COLUMN_NAME},
            self::COLUMN_DESCRIPTION => $this->{self::COLUMN_DESCRIPTION},
            'children'               => $this->when(
                                            $this->children,
                                            static::collection($this->children),
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
            'meta'                   => MetaResource::collection($this->markupes),
            'meta_storage'           => $this->whenLoaded(
                                            'storage',
                                            function ()
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
            // 'taxonomies'             => TaxonomyResource::collection($this->taxonomy),

            self::COLUMN_UPDATED_AT  => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT  => $this->{self::COLUMN_CREATED_AT},
        ];
    }

}
