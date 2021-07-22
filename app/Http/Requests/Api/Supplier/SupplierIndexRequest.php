<?php

namespace App\Http\Requests\Api\Supplier;

use Illuminate\Validation\Rule;
use App\Http\Requests\ApiRequest;
use App\Schemes\Supplier\SupplierSchema;

class SupplierIndexRequest extends ApiRequest implements SupplierSchema
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "perPage" => [
                'sometimes',
                'required',
                'integer',
                'min:1',
                'max:100',
            ],
            "name" => [
                'sometimes',
                'required',
                'string',
                'min:1',
                'max:90',
            ],
            "categories" => [
                'sometimes',
                'required',
                'string',
                'min:1',
                'max:90',
            ],
            "orderBy" => [
                'sometimes',
                'required',
                'string',
                'min:1',
                'max:50',
                Rule::in([
                    'id', 
                    'name', 
                    'updated_at', 
                    'created_at', 
                    'customers_discount.value',
                    'contractors_discount.value',
                ])
            ],
            "direction" => [
                'sometimes',
                'required',
                'string',
                'min:1',
                'max:5',
                Rule::in([
                    'asc', 
                    'desc', 
                ])
            ],
        ];
    }
}
