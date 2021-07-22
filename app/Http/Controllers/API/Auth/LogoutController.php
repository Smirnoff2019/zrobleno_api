<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogoutController extends ApiController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        $request->user()->token()->revoke();

        return $this->success($request->toArray(), 'You are successfully logged out!');
    }
}
