<?php

namespace App\Http\Controllers\Api\Auth;

use Carbon\Carbon;
use App\Models\User\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\Auth\LoginRequest;

class LoginController extends ApiController
{

    /**
     * Authorize a user by credentials from an incoming request.
     *
     * @param  LoginRequest $request
     * @return JsonResponse
     */    
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($this->getCredentials($request))) {
            return $this->notFound('Unauthorised! You cannot sign with those credentials!');
        }

        $token = $this->createToken($request, Auth::user());

        return $this->success(
            [
                'token_type' => 'Bearer',
                'token' => $token->accessToken,
                'expired_at' => Carbon::parse($token->token->expires_at)->toDateTimeString()
            ],
            'The user is successfully authorized!',
            201
        );
    }

    /**
     * Get user credentials from request for authorization
     *
     * @param  LoginRequest $request
     * @return array
     */
    protected function getCredentials($request) 
    {
        return $request->only(
            User::COLUMN_EMAIL,
            User::COLUMN_PHONE,
            User::COLUMN_PASSWORD,
        );
    }

    /**
     * Create authorization Api Bearer Token  
     *
     * @param  LoginRequest $request
     * @return \Illuminate\Contracts\Auth\Authenticatable|null user()
     */
    protected function createToken($request, $user) 
    {
        $token = $user->createToken(config('app.name'));
        $token->token->expires_at = $request->remember_me 
            ? Carbon::now()->addMonth() 
            : Carbon::now()->addDay();

        $token->token->save();

        return $token;
    }

}
