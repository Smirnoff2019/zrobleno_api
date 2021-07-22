<?php

namespace App\Http\Requests\Api\ProjectPropertyCondition;

use Illuminate\Validation\Rule;
use App\Http\Requests\ApiRequest;
use App\Schemes\Status\StatusSchema;
use Illuminate\Support\Facades\Validator;
use App\Schemes\ProjectPropertyCondition\ProjectPropertyConditionSchema;

class UpdateProjectPropertyConditionRequest extends ApiRequest implements ProjectPropertyConditionSchema
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
                'required',
                'filled',
                'string',
                'min:3',
                'max:180',
            ],
            self::COLUMN_SLUG => [
                'required',
                'filled',
                'string',
                Rule::unique(self::TABLE, self::COLUMN_SLUG)
                    ->ignore(
                        $this->{self::COLUMN_SLUG},
                        self::COLUMN_SLUG
                    ),
                'min:3',
                'max:80',
            ],
            self::COLUMN_STATUS_ID => [
                'sometimes',
                'nullable',
                'integer',
                Rule::exists(StatusSchema::TABLE, StatusSchema::COLUMN_ID)
            ],
        ];
    }

}
