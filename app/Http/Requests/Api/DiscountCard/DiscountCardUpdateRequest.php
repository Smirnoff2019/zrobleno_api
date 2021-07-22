<?php

namespace App\Http\Requests\Api\DiscountCard;

use Illuminate\Validation\Rule;
use App\Http\Requests\ApiRequest;
use App\Schemes\Status\StatusSchema;
use App\Schemes\DiscountCard\DiscountCardSchema;

class DiscountCardUpdateRequest extends ApiRequest implements DiscountCardSchema
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            self::COLUMN_STATUS_ID => [
                'sometimes',
                'required',
                'filled',
                'integer',
                Rule::exists(StatusSchema::TABLE, StatusSchema::COLUMN_ID)
            ],
            self::COLUMN_EXPIRATED_AT => [
                'sometimes',
                'required',
                'filled',
                'integer',
                Rule::exists(StatusSchema::TABLE, StatusSchema::COLUMN_ID)
            ],
        ];
    }
    
}
