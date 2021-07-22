<?php

use Illuminate\Support\Facades\Route;

/**
 * --------------------------------------------------------------------------
 * Notification API Routes
 * --------------------------------------------------------------------------
 */

/**
 * Notification api resource routes
 *
 * +--------------+----------------------------+----------------+----------------------------+
 * | Method       | URI                        | Action         | Route Name                 |
 * +--------------+----------------------------+----------------+----------------------------+
 * | GET          | /notification              | index          | notification.index         |
 * | POST         | /notification              | store          | notification.store         |
 * | GET          | /notification/{id}         | show           | notification.show          |
 * | PUT          | /notification/{id}         | update         | notification.update        |
 * | DELETE       | /notification/{id}         | destroy        | notification.destroy       |
 * +--------------+----------------------------+----------------+----------------------------+
 *
 * @controller \App\Http\Controllers\API\Notification\NotificationController

 */

Route::get('notification/tender', 'Notification\NotificationController@showTendersNotification');
Route::apiResource('notification', 'Notification\NotificationController');

Route::get('notifications/tender/{tender_id}', 'Notification\NotificationController@showTenderNotification');
