<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use App\Http\Response\Template\FailedValidationResponse;
use Illuminate\Http\Request;

class ApiRequest extends FormRequest
{

    /**
     * Failed validation message for HttpResponseException
     *
     * @var string
     */
    protected $failedValidationMessage = 'The request data is invalid!';

    /**
     * @return bool
     */
    public function expectsJson(): bool
    {
        return true;
    }

    /**
     * Handle a failed validation attempt.
     * 
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     * 
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        if(request()->expectsJson()) {
            return FailedValidationResponse::send($validator, $this->failedValidationMessage);
        }

        return back()->withErrors($validator)->withInput();
    }

}
