<?php

namespace App\Http\Requests\Api\Image;

use Illuminate\Validation\Rule;
use App\Schemes\File\FileSchema;
use App\Http\Requests\ApiRequest;
use App\Schemes\Image\ImageSchema;
use App\Schemes\Status\StatusSchema;

class UpdateImageRequest extends ApiRequest
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
            'file_id' => [
                'sometimes',
                'required',
                'integer',
                Rule::exists(FileSchema::TABLE, FileSchema::COLUMN_ID)
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
