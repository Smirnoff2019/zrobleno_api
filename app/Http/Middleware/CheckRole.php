<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Http\Response\Template\AuthenticationExceptionResponse;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class CheckRole extends Middleware
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
        $roleClassNamespace = (string) Str::of($roleName)
            ->ltrim(':')
            ->studly()
            ->start('\App\Models\Role\\')
            ->finish('Role');

        if(Auth::check() && $request->user()->isRole($roleClassNamespace)) {
            return $next($request);
        }

        if(Auth::check()) {
            Auth::logout();
        }
        
        if (!$request->expectsJson()) {
            
            return redirect()
                ->route('admin.login')
                ->withInput()
                ->with('authenticate_error', 'Unauthorised! User is not an administrator!');
        } 

        return response()->authException(
            "The user is not a $roleName!",
            [
                'role' => "The role of the user is not the $roleName !"
            ]
        );
    }

}
