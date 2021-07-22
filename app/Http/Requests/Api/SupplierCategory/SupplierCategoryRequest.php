<?php

namespace App\Http\Requests\Api\SupplierCategory;

use Illuminate\Validation\Rule;
use App\Http\Requests\ApiRequest;
use App\Schemes\Status\StatusSchema;
use App\Schemes\SupplierCategory\SupplierCategorySchema;

class SupplierCategoryRequest extends ApiRequest implements SupplierCategorySchema
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
                'string',
                'min:1',
                'max:90',
            ],
            self::COLUMN_SLUG => [
                'required',
                'string',
                'min:1',
                'max:90',
                Rule::unique(self::TABLE, self::COLUMN_SLUG),
            ],
            self::COLUMN_STATUS_ID => [
                'sometimes',
                'nullable',
                'required',
                'integer',
                Rule::exists(StatusSchema::TABLE, StatusSchema::COLUMN_ID)
            ],
        ];
    }

}
