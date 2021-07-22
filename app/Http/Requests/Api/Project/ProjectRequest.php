<?php

namespace App\Http\Requests\Api\Project;

use App\Models\User\User;
use App\Models\Status\Status;
use Illuminate\Validation\Rule;
use App\Http\Requests\ApiRequest;
use App\Models\CalculatorOption\CeilingHeightCoefficient;
use App\Models\CalculatorOption\CoefficientPerRegion;
use App\Models\CalculatorOption\PropertyConditionCoefficient;
use App\Models\CalculatorOption\PropertyWallsConditionCoefficient;
use App\Schemes\Project\ProjectSchema;
use App\Models\ProjectPropertyCondition\ProjectPropertyCondition;

class ProjectRequest extends ApiRequest implements ProjectSchema
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "walls_condition" => [
                'required',
                'filled',
                'integer',
                Rule::exists(PropertyWallsConditionCoefficient::TABLE, PropertyWallsConditionCoefficient::COLUMN_ID)
            ],
            "region" => [
                'required',
                'filled',
                'integer',
                Rule::exists(CoefficientPerRegion::TABLE, CoefficientPerRegion::COLUMN_ID)
            ],
            "city" => [
                'required',
                'filled',
                'string',
                'max:90',
            ],
            "city" => [
                'required',
                'filled',
                'string',
                'max:90',
            ],
            "property_condition" => [
                'required',
                'filled',
                'integer',
                Rule::exists(PropertyConditionCoefficient::TABLE, PropertyConditionCoefficient::COLUMN_ID)
            ],
            "ceiling_height" => [
                'required',
                'filled',
                'integer',
                Rule::exists(CeilingHeightCoefficient::TABLE, CeilingHeightCoefficient::COLUMN_ID)
            ],
            "total_area" => [
                'required',
                'filled',
                'integer',
                'max:999',
            ],
            "total_price" => [
                'required',
                'filled',
                'integer',
            ],
            "rooms" => [
                'required',
                'filled',
            ],

            self::COLUMN_ADDRESS => [
                'sometimes',
                // 'filled',
                'string',
                'max:180',
            ],
            self::COLUMN_USER_ID => [
                'required',
                'filled',
                'integer',
                Rule::exists(User::TABLE, User::COLUMN_ID)
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
