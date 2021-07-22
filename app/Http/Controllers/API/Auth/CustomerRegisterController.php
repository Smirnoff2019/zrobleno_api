<?php

namespace App\Http\Controllers\Api\Auth;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Jobs\User\CreateCustomer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Events\CustomerRegisteredEvent;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\Auth\CustomerRegisterRequest;

class CustomerRegisterController extends ApiController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(CustomerRegisterRequest $request)
    {   
        $password = bcrypt(Str::random(12));
        $request->merge(['password' => $password]);

        $customer = CreateCustomer::dispatchNow($request->only([
            'first_name',
            'middle_name',
            'last_name',
            'email',
            'phone',
            'password',
        ]));

        Auth::login($customer, true);
        
        $token = $this->createToken($request);
        
        event(new CustomerRegisteredEvent($password, $customer));
        
        setcookie('zrobleno_token_type', 'Bearer');
        setcookie('zrobleno_token', $token->accessToken);
        setcookie('zrobleno_expired_at', $token->token->expires_at->toDateTimeString());

        return $this->success(
            [
                'token_type' => 'Bearer',
                'token' => $token->accessToken,
                'expired_at' => $token->token->expires_at->toDateTimeString()
            ],
            'The user is successfully registered!',
            201
        );
    }
    
    /**
     * Create authorization Api Bearer Token  
     *
     * @param  LoginRequest $request
     * @return \Illuminate\Contracts\Auth\Authenticatable|null user()
     */
    protected function createToken($request) 
    {
        $token = Auth::user()->createToken(config('app.name'));
        $token->token->expires_at = $request->remember_me 
            ? Carbon::now()->addMonth() 
            : Carbon::now()->addDay();

        $token->token->save();

        return $token;
    }
}
