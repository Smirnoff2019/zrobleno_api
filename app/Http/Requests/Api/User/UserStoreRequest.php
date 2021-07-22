<?php

namespace App\Http\Requests\Api\User;

use App\Models\Role\Role;
use App\Models\User\User;
use App\Models\Image\Image;
use App\Models\Status\Status;
use App\Models\Account\Account;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends UserRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $classUser = User::class;
        $classRole = Role::class;
        $classImage = Image::class;
        $classStatus = Status::class;
        $classAccount = Account::class;

        return [
            self::COLUMN_FIRST_NAME  => [
                'sometimes',
                'string',
                'max:32',
                'min:2',
            ],
            self::COLUMN_LAST_NAME  => [
                'sometimes',
                'string',
                'max:32',
                'min:2',
            ],
            self::COLUMN_PHONE       => [
                'required',
                'string',
                'max:18',
                'min:10',
                "unique:$classUser,phone",
            ],
            self::COLUMN_EMAIL       => [
                'required',
                'string',
                'email',
                'max:191',
                'min:5',
                "unique:$classUser,email",
            ],
            self::COLUMN_PASSWORD    => [
                'required',
                'filled',
                'string',
                'alpha_dash',
                'max:32',
                'min:8',
                'confirmed',
            ],
            self::COLUMN_IMAGE_ID    => [
                'sometimes',
                'nullable',
                'integer',
                'max:11',
                'min:1',
                "exists:$classImage,id"
            ],
            self::COLUMN_ROLE_ID     => [
                'sometimes',
                'nullable',
                'integer',
                'max:11',
                'min:1',
                "exists:$classRole,id"
            ],
            self::COLUMN_STATUS_ID   => [
                'sometimes',
                'nullable',
                'integer',
                'max:11',
                'min:1',
                "exists:$classStatus,id"
            ],
            self::COLUMN_ACCOUNT_ID  => [
                'sometimes',
                'nullable',
                'integer',
                'max:11',
                'min:1',
                "exists:$classAccount,id"
            ],
        ];
    }

}
