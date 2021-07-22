<?php

namespace App\Http\Controllers\API\User\User;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\ApiController;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MeGet extends ApiController
{

    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        try {
            return $this->resource($request->user());
        } catch (ModelNotFoundException $e) {
            return $this->notFound("You are not logged in!");
        }
    }

}
