<?php

namespace App\Http\Controllers\Webhook\Proxy;

use Illuminate\Http\Request;
use App\Jobs\SendToProxyWebhook;
use App\Models\WebhookProxy\WebhookProxy;
use App\Http\Controllers\WebhookController;
use App\Http\Requests\Webhook\Proxy\WebhookProxyServerRequest;
use App\Models\WebhookProxyRequest\WebhookProxyRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class WebhookProxyController extends WebhookController
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    /**
     * Handle the incoming Telegram Webhook request.
     * 
     * @method POST
     * @param  \Illuminate\Http\Request  $request
     * @param  string $name
     * @return \Illuminate\Http\Response
     */
    public function addProxy(WebhookProxyServerRequest $request)
    {   
        return $this->success(
            factory(WebhookProxy::class)->create([
                WebhookProxy::COLUMN_DOMAIN     => $request->domain ?? 'serious-bullfrog-92.loca.lt',
                WebhookProxy::COLUMN_NAME       => $request->name ?? '',
                WebhookProxy::COLUMN_GROUP      => $request->group ?? 'telegram'
            ])->toArray(),
            'Proxy server added successfully!'
        );
    }

    /**
     * Handle the incoming Telegram Webhook request.
     * 
     * @method POST
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function telegram(Request $request)
    {
        $data = $request->all();

        $res = WebhookProxy::active()
            ->telegramGroup()
            ->get()
            ->each(function ($proxy) use ($data) {
                $proxy->requests()->create([
                    WebhookProxyRequest::COLUMN_DATA => json_encode((array) $data),
                ]);

                return SendToProxyWebhook::dispatch($proxy, $data);
            });

        return response()->json([
            'status' => true,
            'result' => $res
        ]);
    }
    
}
