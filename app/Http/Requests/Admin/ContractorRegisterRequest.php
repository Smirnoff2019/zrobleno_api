<?php

namespace App\Http\Requests\Admin;

use App\Schemes\User\UserSchema;
use App\Schemes\UserLegalData\UserLegalDataSchema;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContractorRegisterRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'last_name' => [
                'required',
                'filled',
                'string',
                'max:30',
            ],
            'first_name' => [
                'required',
                'filled',
                'string',
                'max:30',
            ],
            'middle_name' => [
                'required',
                'filled',
                'string',
                'max:30',
            ],
            'phone' => [
                'required',
                'filled',
                'string',
                'max:30',
                Rule::unique(UserSchema::TABLE, UserSchema::COLUMN_PHONE),
            ],
            'email' => [
                'required',
                'filled',
                'string',
                'email',
                Rule::unique(UserSchema::TABLE, UserSchema::COLUMN_EMAIL),
            ],
            'password' => [
                'required',
                'filled',
                'string',
                'confirmed',
                'min:6',
            ],
            'password_confirmation' => [
                'required',
                'filled',
                'string',
                //'same:password'
            ],
            'bill' => [
                'required',
                'filled',
                'string',
                'min:28',
                Rule::unique(UserLegalDataSchema::TABLE, UserLegalDataSchema::COLUMN_BILL),
            ],
            'MFO' => [
                'required',
                'filled',
                'string',
                'min:6',
                Rule::unique(UserLegalDataSchema::TABLE, UserLegalDataSchema::COLUMN_MFO),
            ],
            'EDRPOU_code' => [
                'required',
                'filled',
                'string',
                'min:8',
                Rule::unique(UserLegalDataSchema::TABLE, UserLegalDataSchema::COLUMN_EDRPOU_CODE),
            ],
            'serial_number' => [
                'required',
                'filled',
                'string',
                'min:8',
                Rule::unique(UserLegalDataSchema::TABLE, UserLegalDataSchema::COLUMN_SERIAL_NUMBER),
            ],
            'legal_status' => [
                'required',
                'filled',
                'string'
            ],
        ];
        
        // /**
        //  * @param Validator $validator
        //  * @throws HttpResponseException
        //  */
        // protected function failedValidation(Validator $validator)
        // {
        //     throw new HttpResponseException(response()->json($validator->errors(), 422));
        // }
    }

}
