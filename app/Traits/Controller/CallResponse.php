<?php

namespace App\Traits\Controller;

trait CallResponse
{

    /**
     * Response instance from the application
     *
     * @var \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    protected $response;

    /**
     * Return a new response from the application.
     *
     * @param  \Illuminate\View\View|string|array|null  $content
     * @param  int  $status
     * @param  array  $headers
     * 
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    protected function response(...$args)
    {
        return $this->response = response(...$args);
    }

    /**
     * SuccessResponse
     * 
     * @param  mixed|array  $data
     * @param  string       $message
     * @param  int|null     $code
     * @param  array|null   $errors
     * 
     * @return \App\Http\Response\Template\SuccessResponse
     */
    protected function success(...$args)
    {
        return $this->response()->success(...$args);
    }

    /**
     * SuccessResponse with empty data
     * 
     * @param  string       $message
     * @param  int|null     $code
     * 
     * @return \App\Http\Response\Template\SuccessResponse
     */
    protected function successMessage(string $message, int $code = null)
    {
        return $this->response()->success([], $message, $code, []);
    }

    /**
     * ErrorResponse
     * 
     * @param  array        $errors
     * @param  string|null  $message
     * @param  int|null     $code
     * 
     * @return \App\Http\Response\Template\ErrorResponse
     */
    protected function error(...$args)
    {
        return $this->response()->error(...$args);
    }
    /**
     * ErrorResponse with empty data
     * 
     * @param  string|null  $message
     * @param  int|null     $code
     * 
     * @return \App\Http\Response\Template\ErrorResponse
     */
    protected function errorMessage(string $message, int $code = null)
    {
        return $this->response()->error([], $message, $code);
    }

    /**
     * NotFoundResponse
     * 
     * @param  string|null  $message
     * @param  array|null   $errors
     * @param  int|null     $code
     * 
     * @return \App\Http\Response\Template\NotFoundResponse
     */ 
    protected function notFound(...$args)
    {
        return $this->response()->notFound(...$args);
    }

    /**
     * FailedValidationResponse
     * 
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @param  string|null      $message
     * @param  int|null         $code
     * 
     * @return \App\Http\Response\Template\FailedValidationResponse
     */
    protected function validation(...$args)
    {
        return $this->response()->validation(...$args);
    }

    /**
     * AuthenticationExceptionResponse
     * 
     * @param  string|null     $message
     * @param  array|null      $errors
     * @param  int[:401]|null  $code
     * 
     * @return \App\Http\Response\Template\AuthenticationExceptionResponse
     */
    protected function authException(...$args)
    {
        return $this->response()->authException(...$args);
    }

}
