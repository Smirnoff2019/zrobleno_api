<?php

/** @var Factory $factory */

use App\Models\Status\Status;
use Faker\Generator as Faker;
use App\Models\Status\TenderStatus;
use Illuminate\Database\Eloquent\Factory;
use App\Models\Status\TenderRestart\CanceledStatus;
use App\Models\Status\TenderRestart\ConfirmedStatus;
use App\Models\Status\TenderRestart\OnDesigningStatus;
use App\Models\Status\TenderRestart\AwaitingConfirmationStatus;
use App\Models\Status\TenderRestartStatus;

/**
 * ===================================================================================================================
 */

$factory->state(Status::class, AwaitingConfirmationStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_NAME   => AwaitingConfirmationStatus::DEFAULT_NAME,
        Status::COLUMN_SLUG   => AwaitingConfirmationStatus::DEFAULT_SLUG,
        Status::COLUMN_TYPE   => AwaitingConfirmationStatus::DEFAULT_SLUG,
        Status::COLUMN_GROUP  => AwaitingConfirmationStatus::DEFAULT_GROUP
    ];
});

$factory->state(Status::class, CanceledStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_NAME   => CanceledStatus::DEFAULT_NAME,
        Status::COLUMN_SLUG   => CanceledStatus::DEFAULT_SLUG,
        Status::COLUMN_TYPE   => CanceledStatus::DEFAULT_SLUG,
        Status::COLUMN_GROUP  => CanceledStatus::DEFAULT_GROUP
    ];
});

$factory->state(Status::class, OnDesigningStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_NAME   => OnDesigningStatus::DEFAULT_NAME,
        Status::COLUMN_SLUG   => OnDesigningStatus::DEFAULT_SLUG,
        Status::COLUMN_TYPE   => OnDesigningStatus::DEFAULT_SLUG,
        Status::COLUMN_GROUP  => OnDesigningStatus::DEFAULT_GROUP
    ];
});

$factory->state(Status::class, ConfirmedStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_NAME   => ConfirmedStatus::DEFAULT_NAME,
        Status::COLUMN_SLUG   => ConfirmedStatus::DEFAULT_SLUG,
        Status::COLUMN_TYPE   => ConfirmedStatus::DEFAULT_SLUG,
        Status::COLUMN_GROUP  => ConfirmedStatus::DEFAULT_GROUP
    ];
});

/**
 * ===================================================================================================================
 */

$factory->state(TenderRestartStatus::class, AwaitingConfirmationStatus::class, function (Faker $faker) {
    return [
        TenderRestartStatus::COLUMN_NAME => AwaitingConfirmationStatus::DEFAULT_NAME,
        TenderRestartStatus::COLUMN_SLUG => AwaitingConfirmationStatus::DEFAULT_SLUG,
        TenderRestartStatus::COLUMN_TYPE => AwaitingConfirmationStatus::DEFAULT_SLUG,
    ];
});

$factory->state(TenderRestartStatus::class, CanceledStatus::class, function (Faker $faker) {
    return [
        TenderRestartStatus::COLUMN_NAME => CanceledStatus::DEFAULT_NAME,
        TenderRestartStatus::COLUMN_SLUG => CanceledStatus::DEFAULT_SLUG,
        TenderRestartStatus::COLUMN_TYPE => CanceledStatus::DEFAULT_SLUG,
    ];
});

$factory->state(TenderRestartStatus::class, OnDesigningStatus::class, function (Faker $faker) {
    return [
        TenderRestartStatus::COLUMN_NAME => OnDesigningStatus::DEFAULT_NAME,
        TenderRestartStatus::COLUMN_SLUG => OnDesigningStatus::DEFAULT_SLUG,
        TenderRestartStatus::COLUMN_TYPE => OnDesigningStatus::DEFAULT_SLUG,
    ];
});

$factory->state(TenderRestartStatus::class, ConfirmedStatus::class, function (Faker $faker) {
    return [
        TenderRestartStatus::COLUMN_NAME => ConfirmedStatus::DEFAULT_NAME,
        TenderRestartStatus::COLUMN_SLUG => ConfirmedStatus::DEFAULT_SLUG,
        TenderRestartStatus::COLUMN_TYPE => ConfirmedStatus::DEFAULT_SLUG,
    ];
});

/**
 * ===================================================================================================================
 */

$factory->define(AwaitingConfirmationStatus::class, function (Faker $faker) {
    return [
    ];
});

$factory->define(CanceledStatus::class, function (Faker $faker) {
    return [
    ];
});

$factory->define(OnDesigningStatus::class, function (Faker $faker) {
    return [
    ];
});

$factory->define(ConfirmedStatus::class, function (Faker $faker) {
    return [
    ];
});
