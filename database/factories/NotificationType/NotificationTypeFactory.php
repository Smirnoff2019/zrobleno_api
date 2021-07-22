<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\NotificationType\NotificationType;

$factory->define(NotificationType::class, function (Faker $faker) {
    return [
        NotificationType::COLUMN_NAME => $name = $faker->name,
        NotificationType::COLUMN_SLUG => Str::slug($name)
    ];
});

$factory->state(NotificationType::class, "telegram", function (Faker $faker) {
    return [
        NotificationType::COLUMN_NAME => 'Telegram',
        NotificationType::COLUMN_SLUG => 'telegram',
    ];
});

$factory->state(NotificationType::class, "mail", function (Faker $faker) {
    return [
        NotificationType::COLUMN_NAME => 'Mail',
        NotificationType::COLUMN_SLUG => 'mail',
    ];
});

$factory->state(NotificationType::class, "database", function (Faker $faker) {
    return [
        NotificationType::COLUMN_NAME => 'Database',
        NotificationType::COLUMN_SLUG => 'database',
    ];
});
