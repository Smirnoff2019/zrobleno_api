<?php

namespace App\Http\Requests\Api\File;

use Illuminate\Validation\Rule;
use App\Schemes\User\UserSchema;
use App\Http\Requests\ApiRequest;

class CreateFileRequest extends ApiRequest
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
            'file' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
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
        ];
    }

}
