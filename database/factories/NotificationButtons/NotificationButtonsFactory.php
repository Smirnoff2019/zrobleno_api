<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\NotificationButton\NotificationButton;

$factory->define(NotificationButton::class, function (Faker $faker) {
    return [
        NotificationButton::COLUMN_NAME    => $name = $faker->name,
        NotificationButton::COLUMN_URL     => $faker->url,
        NotificationButton::COLUMN_TYPE    => 'url',
        NotificationButton::COLUMN_SERVICE => 'mail',
    ];
});


$factory->state(NotificationButton::class, "type.text", function (Faker $faker) {
    return [
        NotificationButton::COLUMN_TYPE => 'text',
    ];
});

$factory->state(NotificationButton::class, "type.url", function (Faker $faker) {
    return [
        NotificationButton::COLUMN_TYPE => 'url',
        NotificationButton::COLUMN_URL  => $faker->url,
    ];
});

$factory->state(NotificationButton::class, "service.callback", function (Faker $faker) {
    return [
        NotificationButton::COLUMN_TYPE => 'callback',
    ];
});


$factory->state(NotificationButton::class, "service.telegram", function (Faker $faker) {
    return [
        NotificationButton::COLUMN_SERVICE => 'telegram',
    ];
});

$factory->state(NotificationButton::class, "service.mail", function (Faker $faker) {
    return [
        NotificationButton::COLUMN_TYPE => 'mail',
    ];
});

$factory->state(NotificationButton::class, "service.database", function (Faker $faker) {
    return [
        NotificationButton::COLUMN_TYPE => 'database',
    ];
});
