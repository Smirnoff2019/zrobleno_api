<?php

namespace App\Http\Requests\Api\TenderApplication;

use Illuminate\Validation\Rule;
use App\Http\Requests\ApiRequest;
use App\Schemes\Status\StatusSchema;
use App\Schemes\Tender\TenderSchema;
use App\Schemes\TenderApplication\TenderApplicationSchema;

class TenderApplicationRequest extends ApiRequest implements TenderApplicationSchema
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
                'sometimes',
                'integer',
                Rule::exists(TenderSchema::TABLE, TenderSchema::COLUMN_ID)
            ],
            self::COLUMN_STATUS_ID => [
                'sometimes',
                'integer',
                Rule::exists(StatusSchema::TABLE, StatusSchema::COLUMN_ID)
            ],
        ];
    }

}
