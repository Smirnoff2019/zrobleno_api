<?php

namespace App\Http\Controllers\API\Auth;

use App\Events\GeneralEvent;
use App\Events\PasswordResetEvent;
use App\Events\PasswordResetSuccessfullyEvent;
use Carbon\Carbon;
use App\Models\User\User;
use App\Http\Controllers\ApiController;
use App\Models\PasswordReset\PasswordReset;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccessfully;
use App\Http\Response\Template\ErrorResponse;
use App\Http\Response\Template\SuccessResponse;
use App\Http\Response\Template\NotFoundResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Api\Auth\PasswordReset\CreateTokenRequest;
use App\Http\Requests\Api\Auth\PasswordReset\ResetPasswordRequest;
use App\Http\Resources\User\UserResource;

class PasswordResetController extends ApiController
{

    /**
     * Create token password reset
     *
     * @param  \App\Http\Requests\Api\Auth\PasswordReset\CreateTokenRequest $request
     * @return \Illuminate\Http\JsonResponse 
     */
    public function create(CreateTokenRequest $request)
    {
        try {
            $user = User::whereEmail($request->email)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return NotFoundResponse::byException($e)->reply();
        }

        $passwordReset = PasswordReset::forUser($user);

        event(new PasswordResetEvent($passwordReset, $user));

        return $this->successMessage('We have e-mailed your password reset link!');
    }

    /**
     * Find token password reset
     *
     * @param  string $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function find($token)
    {
        try {
            $passwordReset = PasswordReset::whereToken($token)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return $this->notFound(
                "This password reset token was not found.",
                ['token' => 'This password reset token is invalid.']
            );
        }
            

        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();

            return $this->notFound(
                'This password reset token is expired.',
                ['token' => 'This password reset token is expired.']
            );
        }

        return $this->success($passwordReset->toArray());
    }

    /**
     * Reset password
     *
     * @param  \App\Http\Requests\Api\Auth\PasswordReset\ResetPasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reset(ResetPasswordRequest $request)
    {
        try {
            $passwordReset = PasswordReset::where([
                ['token', $request->token],
                ['email', $request->email]
            ])->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return $this->notFound(
                "This password reset token was not found.",
                ['token' => 'This password reset token is invalid.']
            );
        }
        
        try {
            $user = User::whereEmail($passwordReset->email)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return $this->notFound(
                "We can`t find a user with that e-mail address!",
                ['email' => 'This email is invalid.']
            );
        }
        
        $user->password = bcrypt($request->password);
        $user->save();
        $passwordReset->delete();

        event(new PasswordResetSuccessfullyEvent($user));

        return $this->success(
            new UserResource($user),
            'User password are changed successful!'
        );
    }
    
}
