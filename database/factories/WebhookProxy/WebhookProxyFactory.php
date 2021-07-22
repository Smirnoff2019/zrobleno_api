<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use App\Models\WebhookProxy\WebhookProxy;
use Illuminate\Database\Eloquent\Factory;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(WebhookProxy::class, function (Faker $faker) {
    return [
        WebhookProxy::COLUMN_NAME   => 'bot_localhost_'.now(),
        WebhookProxy::COLUMN_GROUP  => 'default',
        WebhookProxy::COLUMN_URI    => '/api/v1/webhook/telegram',
    ];
});


$factory->state(WebhookProxy::class, "group:telegram", [
    WebhookProxy::COLUMN_GROUP => 'telegram',
]);

$factory->state(WebhookProxy::class, "group:default", [
    WebhookProxy::COLUMN_GROUP => 'default',
]);