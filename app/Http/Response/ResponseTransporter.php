<?php

namespace App\Http\Response;

use App\Http\Response\ResponseTemplate;
use App\Http\Response\Interfaces\ResponseTemplateInterface;
use App\Http\Response\Interfaces\ResponseTransporterInterface;

abstract class ResponseTransporter implements ResponseTransporterInterface
{

    /**
     * Response template
     *
     * @var \App\Http\Response\ResponseTemplate
     */
    protected $template;

    /**
     * Create a new class instance.
     *
     * @param  \App\Http\Response\ResponseTemplate $template
     * @return void
     */
    public function __construct(ResponseTemplate $template = null)
    {
        $this->template = $template;
    }

    /**
     * Create a new class instance.
     *
     * @param  \App\Http\Response\ResponseTemplate $template
     * @return void
     */
    public function getResponseData()
    {
        return static::responseData($this->template);
    }

    /**
     * Send response
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
     * @param  \App\Http\Response\Interfaces\ResponseTemplateInterfacex $template
     * @return \Illuminate\Http\JsonResponse
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

    /**
     * Make response to send him
     *
     * @param  mixed|array $args
     * @return \Illuminate\Http\JsonResponse
     */
    public static function make(...$args)
    {
        return static::send(...$args);
    }

    /**
     * Handle dynamic static method calls into the class.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        return (new static)->{$method}(...$parameters);
    }

}
