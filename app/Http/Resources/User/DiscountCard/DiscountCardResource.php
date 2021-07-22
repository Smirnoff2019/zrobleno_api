<?php

namespace App\Http\Resources\User\DiscountCard;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Status\StatusResource;
use App\Http\Resources\User\Tender\TenderResource;
use App\Schemes\DiscountCard\DiscountCardSchema;

class DiscountCardResource extends ApiResource implements DiscountCardSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'User discount card retrieved successfully';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->loadMissing([
                'tender',
                'status'
            ]);

        return [
            self::COLUMN_ID              => $this->{self::COLUMN_ID},
            self::COLUMN_CARD_NUMBER     => $this->{self::COLUMN_CARD_NUMBER},
            self::COLUMN_TENDER_ID       => $this->{self::COLUMN_TENDER_ID},
            // 'tender'                     => $this->when(
            //                                     $this->tender, 
            //                                     new TenderResource($this->tender), 
            //                                     null
            //                                 ),
            'status'                     => $this->when(
                                                $this->status,
                                                new StatusResource($this->status),
                                                null
                                            ),
            self::COLUMN_EXPIRATED_AT    => $this->{self::COLUMN_EXPIRATED_AT},
            self::COLUMN_UPDATED_AT      => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT      => $this->{self::COLUMN_CREATED_AT},
        ];
    }

}
