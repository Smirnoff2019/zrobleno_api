<?php

namespace App\Http\Resources\Supplier;

use App\Http\Resources\ApiResource;
use App\Schemes\Supplier\SupplierSchema;
use App\Http\Resources\Image\ImageResource;
use App\Http\Resources\Status\StatusResource;
use App\Http\Resources\Supplier\Discount\DiscountResource;
use App\Http\Resources\SupplierCategory\SupplierCategoryResourceCollection;

class SupplierResource extends ApiResource implements SupplierSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Supplier retrieved successfully!';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = $request->user();
        
        return [
            "id"                    => $this->{self::COLUMN_ID},
            "name"                  => $this->{self::COLUMN_NAME},
            "description"           => $this->{self::COLUMN_DESCRIPTION},
            "catalog_url"           => $this->{self::COLUMN_CATALOG_URL},
            'discount'              => $this->when(
                                            $user && $this->discount,
                                            new DiscountResource($this->discount),
                                            null
                                        ),
            'discounts'             => $this->when(
                                            !$user || !$this->discount,
                                            DiscountResource::collection($this->discounts),
                                        ),
            'categories'            => $this->when(
                                            $this->supplierCategories, 
                                            new SupplierCategoryResourceCollection($this->supplierCategories), 
                                            null
                                        ),
            'image'                 => $this->when(
                                            $this->image, 
                                            new ImageResource($this->image), 
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
