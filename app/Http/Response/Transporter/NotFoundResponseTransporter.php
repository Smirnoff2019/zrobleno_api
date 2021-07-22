<?php

namespace App\Http\Response\Transporter;

use App\Http\Response\ResponseTransporter;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Response\Interfaces\ResponseTemplateInterface;

class NotFoundResponseTransporter extends ResponseTransporter
{

}
