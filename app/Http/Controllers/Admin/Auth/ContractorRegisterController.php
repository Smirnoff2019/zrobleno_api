<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Events\ContractorRegisteredEvent;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Admin\ContractorRegisterRequest;
use App\Models\AccessToken\AccessToken;
use App\Models\Role\ContractorRole;
use App\Models\Status\Common\ActiveStatus;
use App\Models\User\Contractor\Contractor;
use App\Models\User\User;
use App\Models\UserLegalData\UserLegalData;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContractorRegisterController extends ApiController
{

    /**
     * Show registration submit form
     *
     * @param Request $request
     * @param string  $token
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|JsonResponse|\Illuminate\View\View
     */
    public function show(Request $request, string $token) 
    {
        $token_instance = AccessToken::active()->whereToken($token)->firstOrFail();

        return view('admin.contractor-sing-up', [
            'access_token' => $token_instance->token
        ]);
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param string $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function singUp(Request $request, $token)
    {
        $token_instance = AccessToken::active()->whereToken($token)->firstOrFail();

        DB::transaction(function () use($request, $token, $token_instance) {
            
            $contractor = User::create([
                Contractor::COLUMN_FIRST_NAME  => $request->first_name,
                Contractor::COLUMN_LAST_NAME   => $request->last_name,
                Contractor::COLUMN_MIDDLE_NAME => $request->middle_name,
                Contractor::COLUMN_EMAIL       => $request->email,
                Contractor::COLUMN_PHONE       => $request->phone,
                Contractor::COLUMN_PASSWORD    => bcrypt($request->get('password')),
            ]);

            $contractor->status()->associate(ActiveStatus::first());
            $contractor->role()->associate(ContractorRole::first());
            $contractor->legalData()->create([
                UserLegalData::COLUMN_BILL          => $request->bill,
                UserLegalData::COLUMN_MFO           => $request->MFO,
                UserLegalData::COLUMN_EDRPOU_CODE   => $request->EDRPOU_code,
                UserLegalData::COLUMN_SERIAL_NUMBER => $request->serial_number,
                UserLegalData::COLUMN_LEGAL_STATUS  => $request->legal_status,
            ]);
    
            $contractor->save();

            $auth = Auth::login($contractor, true);
            
            $token_instance->update(['active' => false]);

            $token = $this->createToken($request, $contractor);
            
            setcookie('zrobleno_token_type', 'Bearer', 0, "/", ".zrobleno.com.ua");
            setcookie('zrobleno_token', $token->accessToken, 0, "/", ".zrobleno.com.ua");
            setcookie('zrobleno_expired_at', $token->token->expires_at->toDateTimeString(), 0, "/", ".zrobleno.com.ua");
            
            event(new ContractorRegisteredEvent($contractor));

        });

        return redirect()->route('servises.contractor.home');
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
        $token->token->expires_at = $request->get('remember_me', null) 
            ? Carbon::now()->addMonth() 
            : Carbon::now()->addDay();

        $token->token->save();

        return $token;
    }

}