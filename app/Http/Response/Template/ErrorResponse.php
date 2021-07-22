<?php

namespace App\Http\Response\Template;

use App\Http\Response\ResponseTemplate;
use App\Http\Response\Transporter\ErrorResponseTransporter;

/**
 * ErrorResponse
 * 
 * @param array $errors
 * @param string|null $message
 * @param int|null $code
 */
class ErrorResponse extends ResponseTemplate
{

    /**
     * Data, resources or results of processing the request to be sent in the response
     *
     * @var array
     */
    protected $data = [];

    /**
     * Status response code
     *
     * @var int
     */
    protected $statusCode = 422;

    /**
     * Text message sent in response
     *
     * @var string
     */
    protected $message = 'Something went wrong!';

    /**
     * Array of errors sent in response
     *
     * @var array
     */
    protected $errors = [];

    /**
     * Set response transporter class
     *
     * @return string
     */
    public static function via()
    {
        return ErrorResponseTransporter::class;
    }

    /**
     * Processes input data
     * 
     * @param array $errors
     * @param string|null $message
     * @param int|null $code
     * 
     * @return self
     */
    protected function handle(array $errors = [], string $message = null, int $code = null)
    {
        return $this
            ->message($message !== null ? $message : $this->message)
            ->errors($errors ?? [])
            ->status($code ?? $this->statusCode);
    }
}
