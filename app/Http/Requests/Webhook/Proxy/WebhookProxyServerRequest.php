<?php

namespace App\Http\Requests\Webhook\Proxy;

use App\Http\Requests\ApiRequest;
use App\Schemes\WebhookProxy\WebhookProxySchema;

class WebhookProxyServerRequest extends ApiRequest implements WebhookProxySchema
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

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
                "unique:" . self::TABLE . "," . self::COLUMN_NAME,
                'min:1',
                'max:32',
            ],
            self::COLUMN_DOMAIN => [
                'required',
                'filled',
                'string',
                "unique:" . self::TABLE . "," . self::COLUMN_DOMAIN,
                'min:1',
                'max:32',
            ],
            self::COLUMN_GROUP => [
                'sometimes',
                'filled',
                'string',
                'min:1',
                'max:32',
            ],
        ];
    }
}
