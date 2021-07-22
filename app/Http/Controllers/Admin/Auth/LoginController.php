<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\User\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\Auth\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends ApiController
{

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest')->except('logout');
	}

    /**
     * Authorize a user by credentials from an incoming request.
     *
     * @param  LoginRequest $request
     * @return JsonResponse
     */    
    public function authenticate(LoginRequest $request)
    {
        if (Auth::attempt($this->getCredentials($request), (bool) $request->get('remember_me') )) {
            return redirect()->intended(route('admin.home'));
        }

        return redirect()
            ->route('admin.login')
            ->withInput()
            ->with('authenticate_error', 'Unauthorised! You cannot sign with those credentials!');
    }

    /**
     * Authorize a user by credentials from an incoming request.
     *
     * @param  LoginRequest $request
     * @return JsonResponse
     */    
    public function login(Request $request)
    {
        return view('admin.login');
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

}
