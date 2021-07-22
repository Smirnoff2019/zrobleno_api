<?php

namespace App\Http\Requests\Api\Room;

use Illuminate\Validation\Rule;
use App\Schemes\Room\RoomSchema;
use App\Http\Requests\ApiRequest;
use App\Schemes\Status\StatusSchema;

class RoomRequest extends ApiRequest implements RoomSchema
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
            self::COLUMN_SLUG => [
                'required',
                'filled',
                'string',
                Rule::unique(self::TABLE, self::COLUMN_SLUG),
                'min:1',
                'max:32',
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
