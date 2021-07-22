<?php

namespace App\Http\Requests\Api\Supplier;

use Illuminate\Validation\Rule;
use App\Http\Requests\ApiRequest;
use App\Schemes\Image\ImageSchema;
use App\Schemes\Status\StatusSchema;
use App\Schemes\Supplier\SupplierSchema;
use App\Schemes\SupplierCategory\SupplierCategorySchema;

class SupplierUpdateRequest extends ApiRequest implements SupplierSchema
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => [
                'sometimes',
                'required',
                'string',
                'min:1',
                'max:90',
            ],
            "description" => [
                'sometimes',
                'required',
                'string',
                'min:1',
                'max:380',
            ],
            "catalog_url" => [
                'sometimes',
                'required',
                'string',
                'url',
                'min:1',
                'max:180',
            ],

                "customers_discount.value" => [
                    'sometimes',
                    'required',
                    'integer',
                    'min:1',
                    'max:100',
                ],
                "customers_discount.expirated_at" => [
                    'sometimes',
                    'required',
                    'date',
                ],
                "customers_discount.status_id" => [
                    'sometimes',
                    'required',
                    'integer',
                    Rule::exists(StatusSchema::TABLE, StatusSchema::COLUMN_ID)
                ],

                "contractors_discount.value" => [
                    'sometimes',
                    'required',
                    'integer',
                    'min:1',
                    'max:100',
                ],
                "contractors_discount.expirated_at" => [
                    'sometimes',
                    'required',
                    'date',
                ],
                "contractors_discount.status_id" => [
                    'sometimes',
                    'required',
                    'integer',
                    Rule::exists(StatusSchema::TABLE, StatusSchema::COLUMN_ID)
                ],

            "categories.*" => [
                'sometimes',
                'required',
                'integer',
                Rule::exists(SupplierCategorySchema::TABLE, SupplierCategorySchema::COLUMN_ID)
            ],
            "image_id" => [
                'sometimes',
                'nullable',
                'required',
                'integer',
                Rule::exists(ImageSchema::TABLE, ImageSchema::COLUMN_ID)
            ],
            "status_id" => [
                'sometimes',
                'nullable',
                'required',
                'integer',
                Rule::exists(StatusSchema::TABLE, StatusSchema::COLUMN_ID)
            ],
        ];
    }

}
