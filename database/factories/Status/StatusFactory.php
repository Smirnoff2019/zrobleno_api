<?php

/** @var Factory $factory */

use App\Models\Status\ComplaintStatus;
use App\Models\Status\Status;
use Faker\Generator as Faker;
use App\Models\Status\CommonStatus;
use App\Models\Status\TenderStatus;
use App\Models\Status\PaymentStatus;
use App\Models\Status\TenderDealStatus;
use App\Models\Status\TenderApplicationStatus;
use App\Models\Status\TenderRestartStatus;
use Illuminate\Database\Eloquent\Factory;


$factory->define(Status::class, function (Faker $faker) {
    return [
        Status::COLUMN_SLUG           => $faker->slug,
        Status::COLUMN_NAME           => $faker->title,
        Status::COLUMN_DESCRIPTION    => $faker->paragraph,
    ];
});

$factory->define(CommonStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_SLUG           => $faker->slug,
        Status::COLUMN_NAME           => $faker->title,
        Status::COLUMN_DESCRIPTION    => $faker->paragraph,
    ];
});

$factory->define(PaymentStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_SLUG           => $faker->slug,
        Status::COLUMN_NAME           => $faker->title,
        Status::COLUMN_DESCRIPTION    => $faker->paragraph,
    ];
});

$factory->define(TenderStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_SLUG           => $faker->slug,
        Status::COLUMN_NAME           => $faker->title,
        Status::COLUMN_DESCRIPTION    => $faker->paragraph,
    ];
});

$factory->define(TenderApplicationStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_SLUG           => $faker->slug,
        Status::COLUMN_NAME           => $faker->title,
        Status::COLUMN_DESCRIPTION    => $faker->paragraph,
    ];
});

$factory->define(TenderDealStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_SLUG           => $faker->slug,
        Status::COLUMN_NAME           => $faker->title,
        Status::COLUMN_DESCRIPTION    => $faker->paragraph,
    ];
});

$factory->define(TenderRestartStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_SLUG           => $faker->slug,
        Status::COLUMN_NAME           => $faker->title,
        Status::COLUMN_DESCRIPTION    => $faker->paragraph,
    ];
});

$factory->define(ComplaintStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_SLUG           => $faker->slug,
        Status::COLUMN_NAME           => $faker->title,
        Status::COLUMN_DESCRIPTION    => $faker->paragraph,
    ];
});
