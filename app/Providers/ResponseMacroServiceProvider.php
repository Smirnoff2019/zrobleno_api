<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use App\Http\Response\Template\ErrorResponse;
use App\Http\Response\Template\SuccessResponse;
use App\Http\Response\Template\NotFoundResponse;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Response\Template\FailedValidationResponse;
use App\Http\Response\Template\AuthenticationExceptionResponse;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        /**
         * SuccessResponse
         * 
         * @param  mixed|array  $data
         * @param  string       $message
         * @param  int|null     $code
         * @param  array|null   $errors
         */
        Response::macro('success', function ($data = [], string $message = null, int $code = null, array $errors = []) {
            return SuccessResponse::send($data, (string) $message, $errors, $code);
        });

        /**
         * ErrorResponse
         * 
         * @param  array        $errors
         * @param  string|null  $message
         * @param  int|null     $code
         */ 
        Response::macro('error', function (...$args) {
            return ErrorResponse::send(...$args);
        });

        /**
         * NotFoundResponse
         * 
         * @param  string|null  $message
         * @param  array|null   $errors
         * @param  int|null     $code
         */ 
        Response::macro('notFound', function (...$args) {
            return NotFoundResponse::send(...$args);
        });

        /**
         * FailedValidationResponse
         * 
         * @param  \Illuminate\Contracts\Validation\Validator  $validator
         * @param  string|null      $message
         * @param  int|null         $code
         */
        Response::macro('validation', function (...$args) {
            return FailedValidationResponse::send(...$args);
        });

        /**
         * AuthenticationExceptionResponse
         * 
         * @param  string|null     $message
         * @param  array|null      $errors
         * @param  int[:401]|null  $code
         */
        Response::macro('authException', function (...$args) {
            return AuthenticationExceptionResponse::send(...$args);
        });

    }
}
