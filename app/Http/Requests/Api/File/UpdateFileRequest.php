<?php

namespace App\Http\Requests\Api\File;

use Illuminate\Validation\Rule;
use App\Http\Requests\ApiRequest;
use App\Schemes\Status\StatusSchema;

class UpdateFileRequest extends ApiRequest
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
            'status_id' => [
                'sometimes',
                'required',
                'integer',
                Rule::exists(StatusSchema::TABLE, StatusSchema::COLUMN_ID)
            ],
        ];
    }

}
