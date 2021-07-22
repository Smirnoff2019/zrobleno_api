<?php

namespace App\Http\Resources\Complaint\ComplaintRecipient;

use App\Http\Resources\ApiResourceCollection;
use App\Schemes\ComplaintRecipient\ComplaintRecipientSchema;

class ComplaintRecipientResourceCollection extends ApiResourceCollection implements ComplaintRecipientSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Complaint recipients retrieved successfully!';

}
