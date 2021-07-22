<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Http\Response\Template\AuthenticationExceptionResponse;

class Authenticate extends Middleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        try {
            return parent::handle($request, $next, ...$guards);
        } catch (AuthenticationException $e) {
            if (!$request->expectsJson()) {
                return $this->redirectTo($request);
            } else {
                return AuthenticationExceptionResponse::send(
                    $e->getMessage(),
                    ['message' => $e->getMessage()]
                );
            }
        }
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        app('redirect')->setIntendedUrl($request->fullUrl());

        return redirect()->route('admin.login')->withInput();
    }

}
