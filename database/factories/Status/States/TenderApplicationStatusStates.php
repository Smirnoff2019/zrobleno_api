<?php

/** @var Factory $factory */

use App\Models\Status\Status;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use App\Models\Status\TenderApplication\CanceledStatus;
use App\Models\Status\TenderApplication\ConfirmedStatus;
use App\Models\Status\TenderApplication\OnDesigningStatus;
use App\Models\Status\TenderApplication\AwaitingConfirmationStatus;
use App\Models\Status\TenderApplication\AwaitingRestartStatus;
use App\Models\Status\TenderApplicationStatus;

/**
 * ===================================================================================================================
 */

$factory->state(Status::class, OnDesigningStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_NAME   => OnDesigningStatus::DEFAULT_NAME,
        Status::COLUMN_SLUG   => OnDesigningStatus::DEFAULT_SLUG,
        Status::COLUMN_TYPE   => OnDesigningStatus::DEFAULT_SLUG,
        Status::COLUMN_GROUP  => OnDesigningStatus::DEFAULT_GROUP
    ];
});

$factory->state(Status::class, AwaitingConfirmationStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_NAME   => AwaitingConfirmationStatus::DEFAULT_NAME,
        Status::COLUMN_SLUG   => AwaitingConfirmationStatus::DEFAULT_SLUG,
        Status::COLUMN_TYPE   => AwaitingConfirmationStatus::DEFAULT_SLUG,
        Status::COLUMN_GROUP  => AwaitingConfirmationStatus::DEFAULT_GROUP
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

$factory->state(Status::class, CanceledStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_NAME   => CanceledStatus::DEFAULT_NAME,
        Status::COLUMN_SLUG   => CanceledStatus::DEFAULT_SLUG,
        Status::COLUMN_TYPE   => CanceledStatus::DEFAULT_SLUG,
        Status::COLUMN_GROUP  => CanceledStatus::DEFAULT_GROUP
    ];
});

$factory->state(Status::class, AwaitingRestartStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_NAME   => AwaitingRestartStatus::DEFAULT_NAME,
        Status::COLUMN_SLUG   => AwaitingRestartStatus::DEFAULT_SLUG,
        Status::COLUMN_TYPE   => AwaitingRestartStatus::DEFAULT_SLUG,
        Status::COLUMN_GROUP  => AwaitingRestartStatus::DEFAULT_GROUP
    ];
});

/**
 * ===================================================================================================================
 */

$factory->state(TenderApplicationStatus::class, OnDesigningStatus::class, function (Faker $faker) {
    return [
        TenderApplicationStatus::COLUMN_NAME => OnDesigningStatus::DEFAULT_NAME,
        TenderApplicationStatus::COLUMN_SLUG => OnDesigningStatus::DEFAULT_SLUG,
        TenderApplicationStatus::COLUMN_TYPE => OnDesigningStatus::DEFAULT_SLUG,
    ];
});

$factory->state(TenderApplicationStatus::class, AwaitingConfirmationStatus::class, function (Faker $faker) {
    return [
        TenderApplicationStatus::COLUMN_NAME => AwaitingConfirmationStatus::DEFAULT_NAME,
        TenderApplicationStatus::COLUMN_SLUG => AwaitingConfirmationStatus::DEFAULT_SLUG,
        TenderApplicationStatus::COLUMN_TYPE => AwaitingConfirmationStatus::DEFAULT_SLUG,
    ];
});

$factory->state(TenderApplicationStatus::class, ConfirmedStatus::class, function (Faker $faker) {
    return [
        TenderApplicationStatus::COLUMN_NAME => ConfirmedStatus::DEFAULT_NAME,
        TenderApplicationStatus::COLUMN_SLUG => ConfirmedStatus::DEFAULT_SLUG,
        TenderApplicationStatus::COLUMN_TYPE => ConfirmedStatus::DEFAULT_SLUG,
    ];
});

$factory->state(TenderApplicationStatus::class, CanceledStatus::class, function (Faker $faker) {
    return [
        TenderApplicationStatus::COLUMN_NAME => CanceledStatus::DEFAULT_NAME,
        TenderApplicationStatus::COLUMN_SLUG => CanceledStatus::DEFAULT_SLUG,
        TenderApplicationStatus::COLUMN_TYPE => CanceledStatus::DEFAULT_SLUG,
    ];
});

$factory->state(TenderApplicationStatus::class, AwaitingRestartStatus::class, function (Faker $faker) {
    return [
        TenderApplicationStatus::COLUMN_NAME => AwaitingRestartStatus::DEFAULT_NAME,
        TenderApplicationStatus::COLUMN_SLUG => AwaitingRestartStatus::DEFAULT_SLUG,
        TenderApplicationStatus::COLUMN_TYPE => AwaitingRestartStatus::DEFAULT_SLUG,
    ];
});

/**
 * ===================================================================================================================
 */

$factory->define(OnDesigningStatus::class, function (Faker $faker) {
    return [
    ];
});

$factory->define(AwaitingConfirmationStatus::class, function (Faker $faker) {
    return [
    ];
});

$factory->define(ConfirmedStatus::class, function (Faker $faker) {
    return [
    ];
});

$factory->define(CanceledStatus::class, function (Faker $faker) {
    return [
    ];
});

$factory->define(AwaitingRestartStatus::class, function (Faker $faker) {
    return [
    ];
});
