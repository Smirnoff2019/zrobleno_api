<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends UserRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'phone'     => 'sometimes|string|unique:App\Models\User\User,phone|max:18|min:10',
            'email'     => 'sometimes|string|email|unique:App\Models\User\User,email|max:191',
            'password'  => 'sometimes|string|filled|unique:App\Models\User\User,password|not_regex:/[<>{}`^:;$]+/i',
            'role_id'   => 'sometimes|integer|nullable',
            'image_id'  => 'sometimes|integer|nullable',
            'status_id' => 'sometimes|integer|nullable'
        ];
    }
}
