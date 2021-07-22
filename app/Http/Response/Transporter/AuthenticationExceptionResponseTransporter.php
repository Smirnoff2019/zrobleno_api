<?php

namespace App\Http\Response\Transporter;

use App\Http\Response\ResponseTransporter;
use Illuminate\Auth\AuthenticationException;
use App\Http\Response\Template\ErrorResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Response\Interfaces\ResponseTemplateInterface;

class AuthenticationExceptionResponseTransporter extends ResponseTransporter
{

    /**
     * Send error response
     *
     * @param  \App\Http\Response\Interfaces\ResponseTemplateInterface $template
     * @return void
     * 
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    public static function send(ResponseTemplateInterface $template)
    {
        throw new HttpResponseException(response()->json(
            static::responseData($template),
            $template->getStatusCode() ?? 401
        ));
    }

    /**
     * Get response data
     *
     * @param  \App\Http\Response\Interfaces\ResponseTemplateInterface $template
     * @return array
     */
    public static function responseData(ResponseTemplateInterface $template)
    {
        return [
            'data'      => $template->getData(),
            'status'    => $template->getStatusCode(),
            'message'   => $template->getMessage(),
            'errors'    => $template->getErrors(),
        ] + $template->getAdditional();
    }

}
