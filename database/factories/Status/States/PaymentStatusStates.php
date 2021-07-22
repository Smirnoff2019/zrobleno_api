<?php

/** @var Factory $factory */

use App\Models\Status\Status;
use Faker\Generator as Faker;
use App\Models\Status\PaymentStatus;
use Illuminate\Database\Eloquent\Factory;
use App\Models\Status\Payments\PendingStatus;
use App\Models\Status\Payments\ApprovedStatus;
use App\Models\Status\Payments\DeclinedStatus;
use App\Models\Status\Payments\InprocessingStatus;

$factory->state(Status::class, ApprovedStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_NAME  => ApprovedStatus::DEFAULT_NAME,
        Status::COLUMN_SLUG  => ApprovedStatus::DEFAULT_SLUG,
        Status::COLUMN_TYPE  => ApprovedStatus::DEFAULT_SLUG,
        Status::COLUMN_GROUP => ApprovedStatus::DEFAULT_GROUP,
    ];
});

$factory->state(Status::class, PendingStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_NAME  => PendingStatus::DEFAULT_NAME,
        Status::COLUMN_SLUG  => PendingStatus::DEFAULT_SLUG,
        Status::COLUMN_TYPE  => PendingStatus::DEFAULT_SLUG,
        Status::COLUMN_GROUP => PendingStatus::DEFAULT_GROUP,
    ];
});

$factory->state(Status::class, DeclinedStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_NAME  => DeclinedStatus::DEFAULT_NAME,
        Status::COLUMN_SLUG  => DeclinedStatus::DEFAULT_SLUG,
        Status::COLUMN_TYPE  => DeclinedStatus::DEFAULT_SLUG,
        Status::COLUMN_GROUP => DeclinedStatus::DEFAULT_GROUP,
    ];
});

$factory->state(Status::class, InprocessingStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_NAME  => InprocessingStatus::DEFAULT_NAME,
        Status::COLUMN_SLUG  => InprocessingStatus::DEFAULT_SLUG,
        Status::COLUMN_TYPE  => InprocessingStatus::DEFAULT_SLUG,
        Status::COLUMN_GROUP => InprocessingStatus::DEFAULT_GROUP,
    ];
});

/**
 * ===================================================================================================================
 */

$factory->state(PaymentStatus::class, ApprovedStatus::class, function (Faker $faker) {
    return [
        PaymentStatus::COLUMN_NAME => ApprovedStatus::DEFAULT_NAME,
        PaymentStatus::COLUMN_SLUG => ApprovedStatus::DEFAULT_SLUG,
        PaymentStatus::COLUMN_TYPE => ApprovedStatus::DEFAULT_SLUG,
    ];
});

$factory->state(PaymentStatus::class, PendingStatus::class, function (Faker $faker) {
    return [
        PaymentStatus::COLUMN_NAME => PendingStatus::DEFAULT_NAME,
        PaymentStatus::COLUMN_SLUG => PendingStatus::DEFAULT_SLUG,
        PaymentStatus::COLUMN_TYPE => PendingStatus::DEFAULT_SLUG,
    ];
});

$factory->state(PaymentStatus::class, DeclinedStatus::class, function (Faker $faker) {
    return [
        PaymentStatus::COLUMN_NAME => DeclinedStatus::DEFAULT_NAME,
        PaymentStatus::COLUMN_SLUG => DeclinedStatus::DEFAULT_SLUG,
        PaymentStatus::COLUMN_TYPE => DeclinedStatus::DEFAULT_SLUG,
    ];
});

$factory->state(PaymentStatus::class, InprocessingStatus::class, function (Faker $faker) {
    return [
        PaymentStatus::COLUMN_NAME => InprocessingStatus::DEFAULT_NAME,
        PaymentStatus::COLUMN_SLUG => InprocessingStatus::DEFAULT_SLUG,
        PaymentStatus::COLUMN_TYPE => InprocessingStatus::DEFAULT_SLUG,
    ];
});
