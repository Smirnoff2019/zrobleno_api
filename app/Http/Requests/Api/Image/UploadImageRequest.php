<?php

namespace App\Http\Requests\Api\Image;

use Illuminate\Validation\Rule;
use App\Http\Requests\ApiRequest;
use App\Schemes\Image\ImageSchema;
use App\Schemes\Status\StatusSchema;

class UploadImageRequest extends ApiRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif,svg,webp',
                'max:30720'
            ],
            'title' => [
                'sometimes',
                'required',
                'string',
                'max:60'
            ],
            'description' => [
                'sometimes',
                'required',
                'string',
                'max:255'
            ],
            'sort' => [
                'sometimes',
                'required',
                'string',
                'max:30'
            ],
            'parent_id' => [
                'sometimes',
                'required',
                'integer',
                Rule::exists(ImageSchema::TABLE, ImageSchema::COLUMN_ID)
            ],
            'status_id' => [
                'sometimes',
                'required',
                'integer',
                Rule::exists(StatusSchema::TABLE, StatusSchema::COLUMN_ID)
            ],
        ];
    }

}
