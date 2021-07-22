<?php

namespace App\Http\Requests\Api\DiscountCard;

use Illuminate\Validation\Rule;
use App\Schemes\User\UserSchema;
use App\Http\Requests\ApiRequest;
use App\Schemes\DiscountCard\DiscountCardSchema;
use App\Schemes\Status\StatusSchema;
use App\Schemes\Tender\TenderSchema;

class DiscountCardRequest extends ApiRequest implements DiscountCardSchema
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            self::COLUMN_TENDER_ID => [
                'required',
                'filled',
                'integer',
                Rule::exists(TenderSchema::TABLE, TenderSchema::COLUMN_ID)
            ],
            self::COLUMN_USER_ID => [
                'required',
                'filled',
                'integer',
                Rule::exists(UserSchema::TABLE, UserSchema::COLUMN_ID)
            ],
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
                'date',
            ],
        ];
    }

}
