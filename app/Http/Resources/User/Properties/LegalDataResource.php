<?php

namespace App\Http\Resources\User\Properties;

use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use App\Schemes\UserLegalData\UserLegalDataSchema;

class LegalDataResource extends ApiResource implements UserLegalDataSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'User legal data retrieved successfully!';

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            self::COLUMN_BILL           => $this->{self::COLUMN_BILL},
            self::COLUMN_MFO            => $this->{self::COLUMN_MFO},
            self::COLUMN_EDRPOU_CODE    => $this->{self::COLUMN_EDRPOU_CODE},
            self::COLUMN_SERIAL_NUMBER  => $this->{self::COLUMN_SERIAL_NUMBER},
            self::COLUMN_LEGAL_STATUS   => $this->{self::COLUMN_LEGAL_STATUS},
        ];
    }

}
