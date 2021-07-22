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
 * +--------------+--------------------------------+----------------+--------------------------------+
 * | Method       | URI                            | Action         | Route Name                     |
 * +--------------+--------------------------------+----------------+--------------------------------+
 * | GET          | /notificationType              | index          | notificationType.index         |
 * | POST         | /notificationType              | store          | notificationType.store         |
 * | GET          | /notificationType/{id}         | show           | notificationType.show          |
 * | PUT          | /notificationType/{id}         | update         | notificationType.update        |
 * | DELETE       | /notificationType/{id}         | destroy        | notificationType.destroy       |
 * +--------------+--------------------------------+----------------+--------------------------------+
 *
 * @controller \App\Http\Controllers\API\Notification\NotificationTemplateController
 */

Route::apiResource('notificationType', 'Notification\NotificationTypeController');
