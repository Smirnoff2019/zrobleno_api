<?php

namespace App\Http\Requests\Api\Auth;

use App\Models\User\User;
use App\Schemes\User\UserSchema;
use App\Http\Requests\ApiRequest;
use App\Http\Response\Template\FailedValidationResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CustomerRegisterRequest extends ApiRequest implements UserSchema
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
            'first_name' => [
                'required',
                'filled',
                'string',
                'max:30',
            ],
            'middle_name' => [
                'sometimes',
                'nullable',
                'string',
                'max:30',
            ],
            'last_name' => [
                'sometimes',
                'nullable',
                'string',
                'max:30',
            ],
            'phone' => [
                'required',
                'filled',
                'string',
                'max:30',
                Rule::unique(self::TABLE, self::COLUMN_PHONE),
            ],
            'email' => [
                'required',
                'filled',
                'string',
                'email',
                Rule::unique(self::TABLE, self::COLUMN_EMAIL),
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
