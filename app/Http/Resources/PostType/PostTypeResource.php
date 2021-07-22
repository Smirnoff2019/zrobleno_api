<?php

namespace App\Http\Resources\PostType;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Meta\MetaResource;
use App\Http\Resources\Taxonomy\TaxonomyResource;
use App\Schemes\PostType\PostTypeSchema;
use Illuminate\Http\Request;

class PostTypeResource extends ApiResource implements PostTypeSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Post type retrieved successfully!';

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray( $request )
    {
//        $this->loadMissing('categories');
//        $this->loadMissing('taxonomy');
        $this->loadMissing('markupes');

        return [
            self::COLUMN_ID          => $this->{self::COLUMN_ID},
            self::COLUMN_SLUG        => $this->{self::COLUMN_SLUG},
            self::COLUMN_NAME        => $this->{self::COLUMN_NAME},
            self::COLUMN_DESCRIPTION => $this->{self::COLUMN_DESCRIPTION},

            'categories'             => CategoryResource::collection(
                                            $this->categories
                                        ),
            'taxonomies'             => TaxonomyResource::collection(
                                            $this->taxonomy
                                        ),
            'meta'                   => MetaResource::collection(
                                            $this->markupes
                                        ),
//            'meta_markup'            => $this->whenLoaded(
//                                            'markupes',
//                                            function ()
//                                            {
//                                                return $this->markupes->mapWithKeys(
//                                                    function ($item)
//                                                    {
//                                                        return [
//                                                            $item->slug => $item->pivot->value
//                                                        ];
//                                                    }
//                                                );
//                                            }
//                                        ),

            self::COLUMN_UPDATED_AT  => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT  => $this->{self::COLUMN_CREATED_AT},
        ];
    }

}
