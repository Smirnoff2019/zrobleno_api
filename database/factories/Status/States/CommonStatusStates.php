<?php

/** @var Factory $factory */

use App\Models\Status\Status;
use Faker\Generator as Faker;
use App\Models\Status\CommonStatus;
use Illuminate\Database\Eloquent\Factory;
use App\Models\Status\Common\ActiveStatus;
use App\Models\Status\Common\InactiveStatus;

/**
 * ===================================================================================================================
 */

$factory->state(Status::class, ActiveStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_NAME  => ActiveStatus::DEFAULT_NAME,
        Status::COLUMN_SLUG  => ActiveStatus::DEFAULT_SLUG,
        Status::COLUMN_TYPE  => ActiveStatus::DEFAULT_SLUG,
        Status::COLUMN_GROUP => ActiveStatus::DEFAULT_GROUP,
    ];
});

$factory->state(Status::class, InactiveStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_NAME  => InactiveStatus::DEFAULT_NAME,
        Status::COLUMN_SLUG  => InactiveStatus::DEFAULT_SLUG,
        Status::COLUMN_TYPE  => InactiveStatus::DEFAULT_SLUG,
        Status::COLUMN_GROUP => InactiveStatus::DEFAULT_GROUP,
    ];
});

/**
 * ===================================================================================================================
 */

$factory->state(CommonStatus::class, ActiveStatus::class, function (Faker $faker) {
    return [
        CommonStatus::COLUMN_NAME => ActiveStatus::DEFAULT_NAME,
        CommonStatus::COLUMN_SLUG => ActiveStatus::DEFAULT_SLUG,
        CommonStatus::COLUMN_TYPE => ActiveStatus::DEFAULT_SLUG,
    ];
});

$factory->state(CommonStatus::class, InactiveStatus::class, function (Faker $faker) {
    return [
        CommonStatus::COLUMN_NAME => InactiveStatus::DEFAULT_NAME,
        CommonStatus::COLUMN_SLUG => InactiveStatus::DEFAULT_SLUG,
        CommonStatus::COLUMN_TYPE => InactiveStatus::DEFAULT_SLUG,
    ];
});

/**
 * ===================================================================================================================
 */

$factory->define(ActiveStatus::class, function (Faker $faker) {
    return [
    ];
});

$factory->define(InactiveStatus::class, function (Faker $faker) {
    return [
    ];
});

