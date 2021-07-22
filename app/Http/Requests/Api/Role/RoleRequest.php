<?php

namespace App\Http\Requests\Api\Role;

use Illuminate\Validation\Rule;
use App\Schemes\Role\RoleSchema;
use App\Http\Requests\ApiRequest;
use App\Schemes\Image\ImageSchema;
use App\Schemes\Status\StatusSchema;

class RoleRequest extends ApiRequest implements RoleSchema
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
                'max:191',
            ],
            self::COLUMN_DESCRIPTION => [
                'sometimes',
                'required',
                'string',
                'min:1',
                'max:380',
            ],
            self::COLUMN_IMAGE_ID => [
                'sometimes',
                'nullable',
                'integer',
                Rule::exists(ImageSchema::TABLE, ImageSchema::COLUMN_ID)
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
