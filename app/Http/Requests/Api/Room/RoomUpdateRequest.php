<?php

namespace App\Http\Requests\Api\Room;

use Illuminate\Validation\Rule;
use App\Schemes\Room\RoomSchema;
use App\Http\Requests\ApiRequest;
use App\Schemes\Image\ImageSchema;
use App\Schemes\Status\StatusSchema;

class RoomUpdateRequest extends ApiRequest implements RoomSchema
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
                'filled',
                'string',
                'min:1',
                'max:32',
            ],
            self::COLUMN_SLUG => [
                'sometimes',
                'filled',
                'string',
                Rule::unique(self::TABLE, self::COLUMN_SLUG)
                    ->ignore(
                        $this->{self::COLUMN_SLUG},
                        self::COLUMN_SLUG
                    ),
                'min:1',
                'max:32',
            ],
            self::COLUMN_SORT => [
                'sometimes',
                'nullable',
                'integer',
            ],
            self::COLUMN_MAX_COUNT => [
                'sometimes',
                'nullable',
                'integer',
            ],
            self::COLUMN_DEFAULT_COUNT => [
                'sometimes',
                'nullable',
                'integer',
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
