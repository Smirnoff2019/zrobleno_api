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
 * +--------------+---------------------------------+----------------+---------------------------------+
 * | Method       | URI                             | Action         | Route Name                      |
 * +--------------+---------------------------------+----------------+---------------------------------+
 * | GET          | /notificationGroup              | index          | notificationGroup.index         |
 * | POST         | /notificationGroup              | store          | notificationGroup.store         |
 * | GET          | /notificationGroup/{id}         | show           | notificationGroup.show          |
 * | PUT          | /notificationGroup/{id}         | update         | notificationGroup.update        |
 * | DELETE       | /notificationGroup/{id}         | destroy        | notificationGroup.destroy       |
 * +--------------+---------------------------------+----------------+---------------------------------+
 *
 * @controller \App\Http\Controllers\API\Notification\NotificationGroupController

 */

Route::apiResource('notificationGroup', 'Notification\NotificationGroupController');
