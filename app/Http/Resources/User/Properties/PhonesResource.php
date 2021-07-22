<?php

namespace App\Http\Resources\User\Properties;

use App\Schemes\UserPhone\UserPhoneSchema;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResourceCollection;

class PhonesResource extends ApiResourceCollection implements UserPhoneSchema
{
    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'User phones retrieved successfully!';

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->pluck(self::COLUMN_PHONE);
    }
}
