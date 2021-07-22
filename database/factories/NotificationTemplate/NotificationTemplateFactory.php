<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\NotificationTemplate\NotificationTemplate;

$factory->define(NotificationTemplate::class, function (Faker $faker) {
    return [
        NotificationTemplate::COLUMN_NAME => $name = $faker->name,
        NotificationTemplate::COLUMN_SLUG => Str::slug($name),
        NotificationTemplate::COLUMN_CONTENT => $faker->paragraph,
        NotificationTemplate::COLUMN_COVER_ID => null,
        NotificationTemplate::COLUMN_GROUP_SLUG => 'payments',
        NotificationTemplate::COLUMN_STATUS_SLUG => 'common',
        NotificationTemplate::COLUMN_NOTIFICATION_NAME => 'new_tender',
    ];
});


$factory->state(NotificationTemplate::class, "success.refill.payment", function (Faker $faker) {
    return [
        NotificationTemplate::COLUMN_GROUP_SLUG => 'tenders',
        NotificationTemplate::COLUMN_STATUS_SLUG => 'success',
        NotificationTemplate::COLUMN_NOTIFICATION_NAME => 'contractor_join_tender',
    ];
});

$factory->state(NotificationTemplate::class, "success.refill.payment", function (Faker $faker) {
    return [
        NotificationTemplate::COLUMN_GROUP_SLUG => 'tenders',
        NotificationTemplate::COLUMN_STATUS_SLUG => 'success',
        NotificationTemplate::COLUMN_NOTIFICATION_NAME => 'contractor_join_tender',
    ];
});


$factory->state(NotificationTemplate::class, "success.refill.payment", function (Faker $faker) {
    return [
        NotificationTemplate::COLUMN_GROUP_SLUG => 'payments',
        NotificationTemplate::COLUMN_STATUS_SLUG => 'success',
        NotificationTemplate::COLUMN_NOTIFICATION_NAME => 'refill_payment',
    ];
});

$factory->state(NotificationTemplate::class, "error.refill.payment", function (Faker $faker) {
    return [
        NotificationTemplate::COLUMN_GROUP_SLUG => 'payments',
        NotificationTemplate::COLUMN_STATUS_SLUG => 'error',
        NotificationTemplate::COLUMN_NOTIFICATION_NAME => 'refill_payment',
    ];
});

$factory->state(NotificationTemplate::class, "information.refill.payment", function (Faker $faker) {
    return [
        NotificationTemplate::COLUMN_GROUP_SLUG => 'payments',
        NotificationTemplate::COLUMN_STATUS_SLUG => 'information',
        NotificationTemplate::COLUMN_NOTIFICATION_NAME => 'refill_payment',
    ];
});


$factory->state(NotificationTemplate::class, "success.debit.payment", function (Faker $faker) {
    return [
        NotificationTemplate::COLUMN_GROUP_SLUG => 'payments',
        NotificationTemplate::COLUMN_STATUS_SLUG => 'success',
        NotificationTemplate::COLUMN_NOTIFICATION_NAME => 'debit_payment',
    ];
});

$factory->state(NotificationTemplate::class, "error.debit.payment", function (Faker $faker) {
    return [
        NotificationTemplate::COLUMN_GROUP_SLUG => 'payments',
        NotificationTemplate::COLUMN_STATUS_SLUG => 'error',
        NotificationTemplate::COLUMN_NOTIFICATION_NAME => 'debit_payment',
    ];
});

$factory->state(NotificationTemplate::class, "information.debit.payment", function (Faker $faker) {
    return [
        NotificationTemplate::COLUMN_GROUP_SLUG => 'payments',
        NotificationTemplate::COLUMN_STATUS_SLUG => 'information',
        NotificationTemplate::COLUMN_NOTIFICATION_NAME => 'debit_payment',
    ];
});

