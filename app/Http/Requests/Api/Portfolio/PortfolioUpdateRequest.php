<?php

namespace App\Http\Requests\Api\Portfolio;

use Illuminate\Validation\Rule;
use App\Http\Requests\ApiRequest;
use App\Schemes\Image\ImageSchema;
use App\Schemes\Portfolio\PortfolioSchema;
use App\Schemes\Status\StatusSchema;

class PortfolioUpdateRequest extends ApiRequest implements PortfolioSchema
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
                'max:180',
            ],
            "slug" => [
                'sometimes',
                'required',
                'string',
                'min:1',
                'max:180',
            ],
            "total_area" => [
                'sometimes',
                'required',
                'integer',
                'min:1',
                'max:9000',
            ],
            "duration" => [
                'sometimes',
                'required',
                'string',
            ],
            "budget" => [
                'sometimes',
                'required',
                'integer',
                'min:1',
                'max:99999999',
            ],
            "images.*" => [
                'sometimes',
                'required',
                'integer',
                Rule::exists(ImageSchema::TABLE, ImageSchema::COLUMN_ID)
            ],
            "cover" => [
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
