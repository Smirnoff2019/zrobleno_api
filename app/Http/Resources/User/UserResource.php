<?php

namespace App\Http\Resources\User;

use App\Schemes\User\UserSchema;
use App\Http\Resources\ApiResource;
use App\Http\Resources\Avatar\AvatarResource;
use App\Http\Resources\Role\RoleResource;
use App\Http\Resources\Status\StatusResource;
use App\Http\Resources\User\Image\UserImageResource;
use App\Http\Resources\User\Properties\PhonesResource;
use App\Http\Resources\User\Properties\LegalDataResource;

class UserResource extends ApiResource implements UserSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'User retrieved successfully';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            self::COLUMN_ID              => $this->{self::COLUMN_ID},
            self::COLUMN_FIRST_NAME      => $this->{self::COLUMN_FIRST_NAME},
            self::COLUMN_MIDDLE_NAME     => $this->{self::COLUMN_MIDDLE_NAME},
            self::COLUMN_LAST_NAME       => $this->{self::COLUMN_LAST_NAME},
            self::COLUMN_EMAIL           => $this->{self::COLUMN_EMAIL},
            self::COLUMN_PHONE           => $this->{self::COLUMN_PHONE},
            'phones'                     => $this->when($this->phones, new PhonesResource($this->phones)),
            'image'                      => $this->when($this->image, new UserImageResource($this->image), null),
            'role'                       => new RoleResource($this->role),
            'status'                     => new StatusResource($this->status),
            'avatar'                     => new AvatarResource($this->avatar),
            'account'                    => $this->when($this->account, $this->account, null),
            'accounts'                   => $this->when($this->accounts, $this->accounts, []),
            'chat_bot_app'               => $this->when($this->chatBotApp, $this->chatBotApp, []),
            'legal_data'                 => $this->when($this->legalData, new LegalDataResource($this->legalData), []),
            'last_discount_expirated_at' => $this->discount_expirated_at,
            'is_active_main_account'     => $this->is_active_main_account,
            self::COLUMN_UPDATED_AT      => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT      => $this->{self::COLUMN_CREATED_AT},
        ];
    }

}
