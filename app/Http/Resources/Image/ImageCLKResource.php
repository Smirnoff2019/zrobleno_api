<?php

namespace App\Http\Resources\Image;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Image\File\ImageFileResource;
use App\Http\Resources\Image\Parent\ImageParentResource;
use App\Http\Resources\Status\StatusResource;
use App\Schemes\Image\ImageSchema;
use Illuminate\Http\Request;

class ImageCLKResource extends ApiResource implements ImageSchema
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
            'file_id'                => $this->whenLoaded('file', $this->file_id, null),
            'url'                    => $this->whenLoaded('file', $this->url, null),
            'uri'                    => $this->whenLoaded('file', $this->uri, null),
            'path'                   => $this->whenLoaded('file', $this->path, null),
            'sort'                   => $this->whenLoaded('file', $this->sort, null),
            'size'                   => $this->whenLoaded('file', $this->size, null),
            'format'                 => $this->whenLoaded('file', $this->format, null),
            'name'                   => $this->whenLoaded('file', $this->name, null),
            'title'                  => $this->whenLoaded('file', $this->title, null),
            'description'            => $this->whenLoaded('file', $this->description, null),
            // 'file'                  => $this->when(
            //                                 $this->file,
            //                                 new ImageFileResource($this->file),
            //                                 null
            //                             ),
            'parent'                => $this->when(
                                            $this->parent,
                                            new static($this->parent),
                                            null
                                        ),
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
