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
 * +--------------+------------------------------------+----------------+------------------------------------+
 * | Method       | URI                                | Action         | Route Name                         |
 * +--------------+------------------------------------+----------------+------------------------------------+
 * | GET          | /notificationTemplate              | index          | notificationTemplate.index         |
 * | POST         | /notificationTemplate              | store          | notificationTemplate.store         |
 * | GET          | /notificationTemplate/{id}         | show           | notificationTemplate.show          |
 * | PUT          | /notificationTemplate/{id}         | update         | notificationTemplate.update        |
 * | DELETE       | /notificationTemplate/{id}         | destroy        | notificationTemplate.destroy       |
 * +--------------+------------------------------------+----------------+------------------------------------+
 *
 * @controller \App\Http\Controllers\API\Notification\NotificationTemplateController

 */

Route::apiResource('notificationTemplate', 'NotificationTemplate\NotificationTemplateController');
