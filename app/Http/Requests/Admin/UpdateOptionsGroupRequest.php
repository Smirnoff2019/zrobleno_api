<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use App\Http\Requests\ApiRequest;
use App\Schemes\OptionsGroup\OptionsGroupSchema;
use Illuminate\Foundation\Http\FormRequest;
use App\Schemes\Status\StatusSchema;
use Illuminate\Http\Request;

class UpdateOptionsGroupRequest extends FormRequest implements OptionsGroupSchema
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            self::COLUMN_NAME => [
                'required',
                'filled',
                'string',
                'min:1',
                'max:32',
            ],
            self::COLUMN_SLUG => [
                'required',
                'string',
                'min:1',
                'max:32',
                Rule::unique(self::TABLE, self::COLUMN_SLUG)->ignore($request->id),
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
