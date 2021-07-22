<?php

namespace App\Http\Requests\Api\NotificationTemplate;

use App\Http\Requests\ApiRequest;
use App\Schemes\NotificationGroup\NotificationGroupSchema;
use App\Schemes\NotificationType\NotificationTypeSchema;
use App\Schemes\NotificationTemplate\NotificationTemplateSchema;

class CreateRequest extends ApiRequest implements NotificationTemplateSchema
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
                "unique:". self::TABLE .",". self::COLUMN_SLUG,
                'min:1',
                'max:32',
            ],
            self::COLUMN_CONTENT => [
                'sometimes',
                'nullable',
                'string',
            ],
            self::COLUMN_GROUP_SLUG => [
                'required',
                'nullable',
                'string',
                "exists:" . NotificationGroupSchema::TABLE . "," . NotificationGroupSchema::COLUMN_SLUG,
            ],
            self::COLUMN_TYPE_SLUG => [
                'required',
                'nullable',
                'string',
                "exists:" . NotificationTypeSchema::TABLE . "," . NotificationTypeSchema::COLUMN_SLUG,
            ],
            self::COLUMN_COVER_ID => [
                'sometimes',
                'nullable',
                'integer',
//                "exists:" . StatusSchema::TABLE . "," . StatusSchema::COLUMN_ID,
            ],


        ];
    }

}
