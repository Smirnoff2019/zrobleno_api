<?php

namespace App\Http\Requests\Api\Auth;

use App\Models\User\User;
use App\Schemes\User\UserSchema;
use App\Http\Requests\ApiRequest;
use App\Http\Response\Template\FailedValidationResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends ApiRequest implements UserSchema
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
            self::COLUMN_PHONE      => [
                'sometimes',
                "exists:" . self::TABLE . "," . self::COLUMN_PHONE,
                'string',
                'max:18',
                'min:10'
            ],
            self::COLUMN_EMAIL      => [
                'sometimes',
                'string',
                'email',
                "exists:" . self::TABLE . "," . self::COLUMN_EMAIL,
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
    
    /**
     * Handle a failed validation attempt.
     * 
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     * 
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        if (!request()->expectsJson()) {
            return back()->withErrors($validator);
        }

        return FailedValidationResponse::send($validator, $this->failedValidationMessage);
    }

}
