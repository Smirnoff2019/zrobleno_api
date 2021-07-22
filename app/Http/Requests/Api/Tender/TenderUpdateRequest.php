<?php

namespace App\Http\Requests\Api\Tender;

use Illuminate\Validation\Rule;
use App\Http\Requests\ApiRequest;
use App\Schemes\Status\StatusSchema;
use App\Schemes\Tender\TenderSchema;

class TenderUpdateRequest extends ApiRequest implements TenderSchema
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            self::COLUMN_NAME => [
                'sometimes',
                'required',
                'filled',
                'string',
                'min:1',
                'max:32',
            ],
            self::COLUMN_MAX_PARTICIPANTS => [
                'sometimes',
                'required',
                'filled',
                'integer',
                'min:4',
                'max:20',
            ],
            self::COLUMN_PRICE => [
                'sometimes',
                'filled',
                'integer',
                'min:1',
                'max:999999999',
            ],
            "status_id" => [
                'sometimes',
                'required',
                'integer',
                Rule::exists(StatusSchema::TABLE, StatusSchema::COLUMN_ID)
            ],
        ];
    }
}
