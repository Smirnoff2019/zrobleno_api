<?php

namespace App\Http\Response\Interfaces;

interface ResponseTemplateInterface
{

    /**
     * Set response transporter class
     *
     * @return string
     */
    public static function via();

    /**
     * Set data atribute
     *
     * @param array $data
     * @return self
     */
    public function data(array $data);

    /**
     * Set status code atribute
     *
     * @param int $code
     * @return self
     */
    public function status(int $code);

    /**
     * Set message atribute
     *
     * @param string|array $message
     * @return self
     */
    public function message($message);

    /**
     * Set message atribute
     *
     * @param array $errors
     * @return self
     */
    public function errors(array $errors);

    /**
     * Add additional meta data to the resource response.
     *
     * @param  array  $data
     * @return $this
     */
    public function additional(array $data);

    /**
     * Returns the data, resources or query results will be sent in the response
     *
     * @return self
     */
    public function getData();

    /**
     * Returns the query results status code will be sent in the response
     *
     * @return self
     */
    public function getStatusCode();

    /**
     * Returns a message, will be sent in response
     *
     * @return self
     */
    public function getMessage();

    /**
     * Returns a errors, will be sent in response
     *
     * @return self
     */
    public function getErrors();

    /**
     * Get additional meta data to the resource response.
     *
     * @param  array  $data
     * @return $this
     */
    public function getAdditional();

    /**
     * Create a new class instance.
     *
     * @param mixed $args
     * @return self
     */
    public static function make(...$args);

    /**
     * Send response
     *
     * @param mixed $args
     * @return self
     */
    public static function send(...$args);

}
