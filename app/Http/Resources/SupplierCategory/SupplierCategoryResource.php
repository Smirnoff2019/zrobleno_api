<?php

namespace App\Http\Resources\SupplierCategory;

use App\Http\Resources\ApiResource;
use App\Schemes\Supplier\SupplierSchema;
use App\Http\Resources\Image\ImageResource;
use App\Http\Resources\Status\StatusResource;
use App\Schemes\SupplierCategory\SupplierCategorySchema;

class SupplierCategoryResource extends ApiResource implements SupplierCategorySchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Supplier categories retrieved successfully!';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"                    => $this->{self::COLUMN_ID},
            "name"                  => $this->{self::COLUMN_NAME},
            "slug"                  => $this->{self::COLUMN_SLUG},
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
