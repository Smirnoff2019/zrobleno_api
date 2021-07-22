<?php

namespace App\Http\Requests\Api\Auth\PasswordReset;

use App\Models\User\User;
use App\Schemes\User\UserSchema;
use App\Http\Requests\ApiRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ResetPasswordRequest extends ApiRequest implements UserSchema
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
        return [
            self::COLUMN_EMAIL => [
                'required',
                'string',
                'email',
                "exists:" . self::TABLE . "," . self::COLUMN_EMAIL,
                'max:191',
                'min:5'
            ],
            self::COLUMN_PASSWORD => [
                'required',
                'string',
                'filled',
                'alpha_dash',
                'max:32',
                'min:6',
                'confirmed'
            ],
            'token' => [
                'required',
                'string',
            ],
        ];
    }

}
