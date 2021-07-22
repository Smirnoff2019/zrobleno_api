<?php

namespace App\Http\Response;

use App\Http\Response\ResponseTransporter;
use App\Http\Response\Interfaces\ResponseTemplateInterface;

abstract class ResponseTemplate implements ResponseTemplateInterface
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
    protected $message = '';

    /**
     * Array of errors sent in response
     *
     * @var array
     */
    protected $errors = [];

    /**
     * The additional meta data that should be added to the resource response.
     *
     * Added during response construction by the developer.
     *
     * @var array
     */
    protected $additional = [];

    /**
     * Create a new class instance.
     *
     * @return array[mixed]|mixed $args
     * @return void
     */
    public function __construct(...$args)
    {
        $this->handle(...$args);
    }

    /**
     * Set response transporter class
     *
     * @return string
     */
    public static function via() {
        return ResponseTransporter::class;
    }


    /**
     * Processes input data
     * 
     * @param mixed $arguments
     * @return self
     */
    abstract protected function handle();

    /**
     * Set data atribute
     *
     * @param array $data
     * @return self
     */
    public function data(array $data) {
        $this->data = $data;

        return $this;
    }

    /**
     * Set status code atribute
     *
     * @param int $code
     * @return self
     */
    public function status(int $code) {
        $this->statusCode = $code;

        return $this;
    }

    /**
     * Set message atribute
     *
     * @param string|array $message
     * @return self
     */
    public function message($message) {
        $this->message = $message;
        
        return $this;
    }

    /**
     * Set message atribute
     *
     * @param array $errors
     * @return self
     */
    public function errors($errors) {
        $this->errors = $errors;
        
        return $this;
    }

    /**
     * Add additional meta data to the resource response.
     *
     * @param  array  $data
     * @return $this
     */
    public function additional(array $data)
    {
        $this->additional = $data;

        return $this;
    }

    /**
     * Returns the data, resources or query results will be sent in the response
     *
     * @return mixed
     */
    public function getData() {
        return $this->data ?? [];
    }

    /**
     * Returns the query results status code will be sent in the response
     *
     * @return int
     */
    public function getStatusCode() {
        return $this->statusCode;
    }

    /**
     * Returns a message, will be sent in response
     *
     * @return string
     */
    public function getMessage() {
        return $this->message;
    }

    /**
     * Returns a errors, will be sent in response
     *
     * @return \Illuminate\Support\MessageBag|array|null
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * Get additional meta data to the resource response.
     *
     * @return array
     */
    public function getAdditional()
    {
        return $this->additional;
    }

    /**
     * Make response
     *
     * @param mixed $args
     * @return static
     */
    public static function make(...$args)
    {
        return new static(...$args);
    }

    /**
     * Send response
     *
     * @param mixed $args
     * @return \Illuminate\Http\JsonResponse
     */
    public static function send(...$args)
    {   
        $transporter = static::via();
        $template = static::make(...$args);

        return $transporter::send($template);
    }

    /**
     * Send response
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function reply()
    {
        $transporter = static::via();
        return $transporter::send($this);
    }

    /**
     * Get response transporter class instance
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function transporter()
    {
        $transporter = static::via();
        return new $transporter($this);
    }
    
}
