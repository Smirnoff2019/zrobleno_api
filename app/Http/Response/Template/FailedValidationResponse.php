<?php

namespace App\Http\Response\Template;

use App\Http\Response\ResponseTemplate;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Response\Transporter\FailedValidationResponseTransporter;

/**
 * FailedValidationResponse
 * 
 * @param \Illuminate\Contracts\Validation\Validator $validator
 * @param string|null $message
 * @param int|null $code
 */
class FailedValidationResponse extends ResponseTemplate
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
    protected $message = 'The request data is invalid!';

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
        return FailedValidationResponseTransporter::class;
    }

    /**
     * Processes input data
     * 
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @param string|null $message
     * @param int|null $code
     * 
     * @return self
     */
    protected function handle(Validator $validator = null, string $message = null, int $code = null)
    {
        
        return $this
            ->message($message !== null ? $message : $this->message)
            ->errors($validator->errors() ?? [])
            ->status($code ?? $this->statusCode);
    }

}
