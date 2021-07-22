<?php

namespace App\Http\Requests\Api\Tender;

use Illuminate\Validation\Rule;
use App\Schemes\User\UserSchema;
use App\Http\Requests\ApiRequest;
use App\Schemes\Tender\TenderSchema;
use App\Schemes\Project\ProjectSchema;

class TenderRequest extends ApiRequest implements TenderSchema
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
                'min:1',
                'max:32',
            ],
            self::COLUMN_MAX_PARTICIPANTS => [
                'required',
                'filled',
                'integer',
                'min:4',
                'max:20',
            ],
            self::COLUMN_PRICE => [
                'required',
                'filled',
                'integer',
                'min:1',
                'max:999999999',
            ],
            self::COLUMN_PROJECT_ID => [
                'required',
                'filled',
                'integer',
                Rule::exists(ProjectSchema::TABLE, ProjectSchema::COLUMN_ID)
            ],
            self::COLUMN_USER_ID => [
                'sometimes',
                'integer',
                Rule::exists(UserSchema::TABLE, UserSchema::COLUMN_ID)
            ],
        ];
    }

}
