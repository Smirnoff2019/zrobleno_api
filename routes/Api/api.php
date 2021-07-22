<?php

use Illuminate\Support\Facades\Route;
use App\Models\ProjectRoom\ProjectRoom;
use App\Http\Requests\Api\Project\ProjectRequest;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([], function () {
    Route::post('/login', 'Auth\LoginController@login')->name('login');
    Route::post('/customer/sing_up', 'Auth\CustomerRegisterController')->name('sing_up');
});

Route::middleware(['middleware' => 'auth:api'])->group(function () {
    Route::post('/logout', 'Auth\LogoutController')->name('logout');
    Route::get('/me', 'User\UserController@getMe')->name('get.me');
});

Route::group([
    'namespace' => 'Auth',
    'middleware' => 'api',
    'prefix' => 'password'
], function () {
    Route::post('create', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');
});

Route::group(['namespace' => 'Payment'], function () {
    Route::post('encrypt', 'EncryptController');
});

Route::middleware([
    'middleware' => 'auth:api'
])->group(function() {

    Route::get('/telegram/token', 'Auth\TellegramAuthController@getToken')->name('auth.telegram.getToken');

});

Route::get('/calculator', '\App\Http\Controllers\API\Calculator\CalculatorApiController@index');
