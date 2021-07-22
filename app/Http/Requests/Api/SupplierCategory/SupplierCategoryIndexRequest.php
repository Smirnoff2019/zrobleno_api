<?php

namespace App\Http\Requests\Api\SupplierCategory;

use Illuminate\Validation\Rule;
use App\Http\Requests\ApiRequest;
use App\Schemes\SupplierCategory\SupplierCategorySchema;

class SupplierCategoryIndexRequest extends ApiRequest implements SupplierCategorySchema
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
            "slug" => [
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
                'max:15',
                Rule::in([
                    'id', 
                    'name', 
                    'slug', 
                    'updated_at', 
                    'created_at'
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
