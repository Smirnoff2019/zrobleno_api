<?php

namespace App\Http\Resources\ProjectPropertyCondition;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Status\StatusResource;
use App\Schemes\ProjectPropertyCondition\ProjectPropertyConditionSchema;

class ProjectPropertyConditionResource extends ApiResource implements ProjectPropertyConditionSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Project poperty condition retrieved successfully!';
       
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            self::COLUMN_ID         => $this->{self::COLUMN_ID},
            self::COLUMN_NAME       => $this->{self::COLUMN_NAME},
            self::COLUMN_SLUG       => $this->{self::COLUMN_SLUG},
            'status'                => new StatusResource($this->status),
            self::COLUMN_UPDATED_AT => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT => $this->{self::COLUMN_CREATED_AT},
        ];
    }
    
}
