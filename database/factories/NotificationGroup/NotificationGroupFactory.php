<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\NotificationGroup\NotificationGroup;

$factory->define(NotificationGroup::class, function (Faker $faker) {
    return [
        NotificationGroup::COLUMN_NAME        => $name = $faker->name,
        NotificationGroup::COLUMN_SLUG        => Str::slug($name),
        NotificationGroup::COLUMN_DESCRIPTION => $faker->paragraph,
    ];
});

$factory->state(NotificationGroup::class, "payments", function (Faker $faker) {
    return [
        NotificationGroup::COLUMN_NAME => 'Payments',
        NotificationGroup::COLUMN_SLUG => 'payments',
    ];
});

$factory->state(NotificationGroup::class, "tenders", function (Faker $faker) {
    return [
        NotificationGroup::COLUMN_NAME => 'Tenders',
        NotificationGroup::COLUMN_SLUG => 'tenders',
    ];
});

$factory->state(NotificationGroup::class, "auth", function (Faker $faker) {
    return [
        NotificationGroup::COLUMN_NAME => 'Authorization',
        NotificationGroup::COLUMN_SLUG => 'auth',
    ];
});
