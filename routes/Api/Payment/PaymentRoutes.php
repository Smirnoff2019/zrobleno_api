<?php

use Illuminate\Support\Facades\Route;

/**
 * --------------------------------------------------------------------------
 * Payment API Routes
 * --------------------------------------------------------------------------
 */

/**
 * Payment api resource routes
 *
 * +--------------+-------------------+----------------+-------------------+
 * | Method       | URI               | Action         | Route Name        |
 * +--------------+-------------------+----------------+-------------------+
 * | GET          | /payment          | index          | payment.index     |
 * | POST         | /payment          | store          | payment.store     |
 * | GET          | /payment/{id}     | show           | payment.show      |
 * | PUT          | /payment/{id}     | update         | payment.update    |
 * | DELETE       | /payment/{id}     | destroy        | payment.destroy   |
 * +--------------+-------------------+----------------+-------------------+
 *
 * @controller \App\Http\Controllers\API\Payment\PaymentController
 */

Route::get('costs', 'Payment\PaymentController@costs');

Route::get('/payment/statistic', 'Payment\PaymentController@statistic');

Route::post('payment/participant', 'Payment\PaymentController@buyParticipant');

Route::apiResource('payment', 'Payment\PaymentController');
