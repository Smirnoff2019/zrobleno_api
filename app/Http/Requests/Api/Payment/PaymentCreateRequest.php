<?php

namespace App\Http\Requests\Api\Payment;

use App\Http\Requests\ApiRequest;
use App\Schemes\Payment\PaymentSchema;
use App\Schemes\Status\StatusSchema;

class PaymentCreateRequest extends ApiRequest implements PaymentSchema
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
//    public function authorize(): bool
//    {
//        return true;
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            self::COLUMN_TYPE          => [
                'required',
                'string'
            ],
            self::COLUMN_VALUE         => [
                'required',
                'integer'
            ],
            'status'         => [
                'required',
            ],
            self::COLUMN_ORDER_REFERENCE => [
                'required'
            ]
        ];
    }

}
