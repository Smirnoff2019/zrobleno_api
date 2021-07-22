<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Webhook Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Webhook routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "webhook" middleware group. Enjoy building your Webhook!
|
*/

Route::group([
    'prefix'    => 'proxy',
    'namespace' => 'Proxy',
], function () {

    Route::post('telegram', 'WebhookProxyController@telegram');

    Route::post('server/add', 'WebhookProxyController@addProxy');
});

