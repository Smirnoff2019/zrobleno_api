<?php

namespace App\Http\Resources\Portfolio;

use App\Http\Resources\ApiResource;
use App\Schemes\Portfolio\PortfolioSchema;
use App\Http\Resources\Image\ImageResource;
use App\Http\Resources\Status\StatusResource;
use App\Http\Resources\Portfolio\User\UserResource;

class PortfolioResource extends ApiResource implements PortfolioSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Portfolio retrieved successfully!';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // $user = $request->user();
        
        return [
            "id"                    => $this->{self::COLUMN_ID},
            "name"                  => $this->{self::COLUMN_NAME},
            "slug"                  => $this->{self::COLUMN_SLUG},
            "total_area"            => $this->{self::COLUMN_TOTAL_AREA},
            "duration"              => $this->{self::COLUMN_DURATION},
            "budget"                => $this->{self::COLUMN_BUDGET},
            'user'                  => $this->when(
                                            $this->user, 
                                            new UserResource($this->user), 
                                            []
                                        ),
            'images'                => $this->when(
                                            $this->images, 
                                            ImageResource::collection($this->images), 
                                            []
                                        ),
            'cover'                 => $this->when(
                                            $this->cover, 
                                            new ImageResource($this->cover), 
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
