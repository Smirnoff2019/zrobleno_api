<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\NotificationMedia\NotificationMedia;

$factory->define(NotificationMedia::class, function (Faker $faker) {
    return [
        NotificationMedia::COLUMN_NAME => Str::slug($faker->name),
    ];
});

$factory->state(NotificationMedia::class, "image", function (Faker $faker) {
    return [
        NotificationMedia::COLUMN_NAME => 'image',
    ];
});

$factory->state(NotificationMedia::class, "button", function (Faker $faker) {
    return [
        NotificationMedia::COLUMN_NAME => 'button',
    ];
});
