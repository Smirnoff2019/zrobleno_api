<?php

namespace App\Http\Response\Template;

use Illuminate\Http\JsonResponse;
use App\Http\Response\ResponseTemplate;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\Tender\TenderResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Response\Transporter\SuccessResponseTransporter;

/**
 * SuccessResponse
 * 
 * @param mixed|array $data
 * @param string $message
 * @param array $errors
 * @param int $code
 */
class SuccessResponse extends ResponseTemplate
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
    protected $statusCode = 200;

    /**
     * Text message sent in response
     *
     * @var string
     */
    protected $message = 'Data received successfully!';

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
        return SuccessResponseTransporter::class;
    }

    /**
     * Processes input data
     * 
     * @param mixed|array $data
     * @param string $message
     * @param array $errors
     * @param int $code
     * 
     * @return self
     */
    protected function handle($data = [], string $message = null, array $errors = [], int $code = null) 
    {
        if($data instanceof JsonResource) {
            $data = $data->toArray(request());
        }
        if($data instanceof ResourceCollection) {
            $data = $data->toArray(request());
        }
        if($data instanceof JsonResponse) {
            $data = $data->toArray();
        }
        
        return $this
            ->data($data ?? [])
            ->message($message !== null ? $message : $this->message)
            ->errors($errors)
            ->status($code ?? $this->statusCode);
    }

   
}
