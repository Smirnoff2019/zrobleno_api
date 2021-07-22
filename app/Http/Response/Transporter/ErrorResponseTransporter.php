<?php

namespace App\Http\Response\Transporter;

use App\Http\Response\ResponseTransporter;
use App\Http\Response\Interfaces\ResponseTemplateInterface;

class ErrorResponseTransporter extends ResponseTransporter
{

    /**
     * Send error response
     *
     * @param  \App\Http\Response\Interfaces\ResponseTemplateInterface $template
     * @return \Illuminate\Http\JsonResponse
     */
    public static function send(ResponseTemplateInterface $template)
    {
        return response()->json(
            static::responseData($template),
            $template->getStatusCode()
        );
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
