<?php

namespace App\Http\Response\Template;

use App\Http\Response\ResponseTemplate;
use Illuminate\Contracts\Validation\Validator;
use App\Http\Response\Transporter\AuthenticationExceptionResponseTransporter;

/**
 * AuthenticationExceptionResponse
 * 
 * @param string|null $message
 * @param array|null $errors
 * @param int[:401]|null $code
 */
class AuthenticationExceptionResponse extends ResponseTemplate
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
    protected $statusCode = 401;

    /**
     * Text message sent in response
     *
     * @var string
     */
    protected $message = 'Unauthenticated!';

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
        return AuthenticationExceptionResponseTransporter::class;
    }

    /**
     * Processes input data
     * 
     * @param string|null $message
     * @param array|null $errors
     * @param int[:401]|null $code
     * 
     * @return self
     */
    protected function handle(string $message = null, array $errors = [], int $code = 401)
    {
        return $this
            ->message($message !== null ? $message : $this->message)
            ->errors($errors ?? [])
            ->status($code ?? $this->statusCode);
    }

}
