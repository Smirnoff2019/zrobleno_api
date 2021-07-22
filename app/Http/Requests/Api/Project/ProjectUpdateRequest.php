<?php

namespace App\Http\Requests\Api\Project;

use App\Models\User\User;
use App\Models\Status\Status;
use Illuminate\Validation\Rule;
use App\Http\Requests\ApiRequest;
use App\Schemes\Project\ProjectSchema;
use App\Models\ProjectPropertyCondition\ProjectPropertyCondition;

class ProjectUpdateRequest extends ApiRequest implements ProjectSchema
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            self::COLUMN_CEILING_HEIGHT => [
                'required',
                'filled',
                'integer',
                Rule::in([1, 2]),
            ],
            self::COLUMN_CITY => [
                'sometimes',
                'required',
                'filled',
                'string',
                'max:90',
            ],
            self::COLUMN_ADDRESS => [
                'sometimes',
                'required',
                'filled',
                'string',
                'max:90',
            ],
            "property_condition_id" => [
                'required',
                'filled',
                'integer',
                'max:9999',
                Rule::exists(ProjectPropertyCondition::TABLE, ProjectPropertyCondition::COLUMN_ID)
            ],
            self::COLUMN_STATUS_ID => [
                'sometimes',
                'required',
                'nullable',
                'integer',
                Rule::exists(Status::TABLE, Status::COLUMN_ID)
            ],
        ];
    }
}
