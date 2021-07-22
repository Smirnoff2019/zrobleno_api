<?php

namespace App\Http\Requests\Api\Post;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'slug'         => 'required|string|max:50',
            'title'        => 'required|string|max:191',
            'description'  => 'required|string',
            'content'      => 'required|string',
            'user_id'      => 'sometimes|integer|nullable',
            'parent_id'    => 'sometimes|integer|nullable',
            'status_id'    => 'sometimes|integer|nullable',
            'image_id'     => 'sometimes|integer|nullable',
            'post_type_id' => 'sometimes|integer|nullable'
        ];
    }

    /**
     * @param Validator $validator
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
