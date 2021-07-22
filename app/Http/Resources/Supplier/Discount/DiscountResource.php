<?php

namespace App\Http\Resources\Supplier\Discount;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Role\RoleResource;
use App\Http\Resources\Image\ImageResource;
use App\Http\Resources\Status\StatusResource;
use App\Schemes\SupplierDiscount\SupplierDiscountSchema;
use App\Http\Resources\SupplierCategory\SupplierCategoryResourceCollection;

class DiscountResource extends ApiResource implements SupplierDiscountSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Supplier discount retrieved successfully!';

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
            "value"                 => $this->{self::COLUMN_VALUE},
            "expirated_at"          => $this->{self::COLUMN_EXPIRATED_AT} ?? null,
            'role'                  => $this->when(
                                            $this->role, 
                                            new RoleResource($this->role), 
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
