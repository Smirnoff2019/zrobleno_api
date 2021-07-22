<?php

namespace App\Http\Requests\Api\User;

use App\Models\User\User;
use App\Schemes\User\UserSchema;
use App\Http\Requests\ApiRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserLoginRequest extends ApiRequest implements UserSchema
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $classUser = User::class;

        return [
            self::COLUMN_PHONE      => [
                'sometimes',
                "exists:$classUser,phone",
                'string',
                'max:18',
                'min:10'
            ],
            self::COLUMN_EMAIL      => [
                'sometimes',
                'string',
                'email',
                "exists:$classUser,email",
                'max:191',
                'min:5'
            ],
            self::COLUMN_PASSWORD    => [
                'required',
                'string',
                'filled',
                'alpha_dash',
                'max:32',
                'min:6'
            ],
        ];
    }

}
