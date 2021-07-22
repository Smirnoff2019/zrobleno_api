<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        Auth::logout();
        
        return redirect()
            ->route('admin.login');
    }
}
