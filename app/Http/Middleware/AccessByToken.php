<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Http\Response\Template\AuthenticationExceptionResponse;

class AccessByToken extends Middleware
{
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $roleName
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, $roleName = null)
    {
        

        if($request->user()->isRole($roleClassNamespace)) {
            return $next($request);
        }

        return response()->authException(
            "The user is not a $roleName!",
            [
                'role' => "The role of the user is not the $roleName !"
            ]
        );
    }

}
