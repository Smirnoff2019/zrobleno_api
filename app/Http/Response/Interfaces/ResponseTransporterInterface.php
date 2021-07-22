<?php

namespace App\Http\Response\Interfaces;

use App\Http\Response\Interfaces\ResponseTemplateInterface;

interface ResponseTransporterInterface
{

    /**
     * Send response
     *
     * @param  \App\Http\Response\ResponseTemplate $template
     * @return \Illuminate\Http\JsonResponse
     */
    public static function send(ResponseTemplateInterface $template);

    /**
     * Handle dynamic static method calls into the class.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters);

}
