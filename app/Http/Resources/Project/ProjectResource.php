<?php

namespace App\Http\Resources\Project;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Status\StatusResource;
use App\Schemes\Project\ProjectSchema;

class ProjectResource extends ApiResource implements ProjectSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Project retrieved successfully!';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                    => $this->id,
            'total_area'            => $this->total_area,
            'total_price'           => $this->total_price,
            'city'                  => $this->city,
            'address'               => $this->address,
            'region'                => $this->region,
            'ceiling_height'        => $this->ceilingHeight,
            'property_condition'    => $this->propertyCondition,
            'walls_condition'       => $this->wallsCondition,
            'components'            => $this->components,
            'status'                => new StatusResource($this->status),
            self::COLUMN_UPDATED_AT => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT => $this->{self::COLUMN_CREATED_AT},
        ];
    }

}
