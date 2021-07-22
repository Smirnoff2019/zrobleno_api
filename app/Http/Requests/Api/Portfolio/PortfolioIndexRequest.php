<?php

namespace App\Http\Requests\Api\Portfolio;

use Illuminate\Validation\Rule;
use App\Http\Requests\ApiRequest;
use App\Schemes\Portfolio\PortfolioSchema;

class PortfolioIndexRequest extends ApiRequest implements PortfolioSchema
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
                'max:180',
            ],
            "slug" => [
                'sometimes',
                'required',
                'string',
                'min:1',
                'max:180',
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
                    'slug', 
                    'total_area', 
                    'duration', 
                    'budget', 
                    'updated_at', 
                    'created_at', 
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
