<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\User\UserLoginRequest;
use Illuminate\Contracts\Routing\ResponseFactory;

class TellegramAuthController extends ApiController
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return ResponseFactory|Response
     */
    public function getToken(Request $request)
    {
        $botAuth = $request->user()->findUserBotAuthToken();

        return $this->success([
            "token" => $token = $botAuth->token,
            "link" => "https://t.me/ZroblenoTelegramBot?start=$token"
        ]);
    }

}
