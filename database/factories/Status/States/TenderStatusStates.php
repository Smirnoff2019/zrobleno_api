<?php

/** @var Factory $factory */

use App\Models\Status\Status;
use Faker\Generator as Faker;
use App\Models\Status\TenderStatus;
use Illuminate\Database\Eloquent\Factory;
use App\Models\Status\Tender\ActiveStatus;
use App\Models\Status\Tender\CanceledStatus;
use App\Models\Status\Tender\CompletedStatus;
use App\Models\Status\Tender\SuspendedStatus;
use App\Models\Status\Tender\AwaitingConfirmationStatus;
use App\Models\Status\Tender\RecruitmentOfParticipantsStatus;

/**
 * ===================================================================================================================
 */

$factory->state(Status::class, ActiveStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_NAME   => ActiveStatus::DEFAULT_NAME,
        Status::COLUMN_SLUG   => ActiveStatus::DEFAULT_SLUG,
        Status::COLUMN_TYPE   => ActiveStatus::DEFAULT_SLUG,
        Status::COLUMN_GROUP  => ActiveStatus::DEFAULT_GROUP
    ];
});

$factory->state(Status::class, RecruitmentOfParticipantsStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_NAME   => RecruitmentOfParticipantsStatus::DEFAULT_NAME,
        Status::COLUMN_SLUG   => RecruitmentOfParticipantsStatus::DEFAULT_SLUG,
        Status::COLUMN_TYPE   => RecruitmentOfParticipantsStatus::DEFAULT_SLUG,
        Status::COLUMN_GROUP  => RecruitmentOfParticipantsStatus::DEFAULT_GROUP
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

$factory->state(Status::class, SuspendedStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_NAME   => SuspendedStatus::DEFAULT_NAME,
        Status::COLUMN_SLUG   => SuspendedStatus::DEFAULT_SLUG,
        Status::COLUMN_TYPE   => SuspendedStatus::DEFAULT_SLUG,
        Status::COLUMN_GROUP  => SuspendedStatus::DEFAULT_GROUP
    ];
});

$factory->state(Status::class, CompletedStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_NAME   => CompletedStatus::DEFAULT_NAME,
        Status::COLUMN_SLUG   => CompletedStatus::DEFAULT_SLUG,
        Status::COLUMN_TYPE   => CompletedStatus::DEFAULT_SLUG,
        Status::COLUMN_GROUP  => CompletedStatus::DEFAULT_GROUP
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

/**
 * ===================================================================================================================
 */

$factory->state(TenderStatus::class, ActiveStatus::class, function (Faker $faker) {
    return [
        TenderStatus::COLUMN_NAME => ActiveStatus::DEFAULT_NAME,
        TenderStatus::COLUMN_SLUG => ActiveStatus::DEFAULT_SLUG,
        TenderStatus::COLUMN_TYPE => ActiveStatus::DEFAULT_SLUG,
    ];
});

$factory->state(TenderStatus::class, RecruitmentOfParticipantsStatus::class, function (Faker $faker) {
    return [
        TenderStatus::COLUMN_NAME => RecruitmentOfParticipantsStatus::DEFAULT_NAME,
        TenderStatus::COLUMN_SLUG => RecruitmentOfParticipantsStatus::DEFAULT_SLUG,
        TenderStatus::COLUMN_TYPE => RecruitmentOfParticipantsStatus::DEFAULT_SLUG,
    ];
});

$factory->state(TenderStatus::class, AwaitingConfirmationStatus::class, function (Faker $faker) {
    return [
        TenderStatus::COLUMN_NAME => AwaitingConfirmationStatus::DEFAULT_NAME,
        TenderStatus::COLUMN_SLUG => AwaitingConfirmationStatus::DEFAULT_SLUG,
        TenderStatus::COLUMN_TYPE => AwaitingConfirmationStatus::DEFAULT_SLUG,
    ];
});

$factory->state(TenderStatus::class, SuspendedStatus::class, function (Faker $faker) {
    return [
        TenderStatus::COLUMN_NAME => SuspendedStatus::DEFAULT_NAME,
        TenderStatus::COLUMN_SLUG => SuspendedStatus::DEFAULT_SLUG,
        TenderStatus::COLUMN_TYPE => SuspendedStatus::DEFAULT_SLUG,
    ];
});

$factory->state(TenderStatus::class, CompletedStatus::class, function (Faker $faker) {
    return [
        TenderStatus::COLUMN_NAME => CompletedStatus::DEFAULT_NAME,
        TenderStatus::COLUMN_SLUG => CompletedStatus::DEFAULT_SLUG,
        TenderStatus::COLUMN_TYPE => CompletedStatus::DEFAULT_SLUG,
    ];
});

$factory->state(TenderStatus::class, CanceledStatus::class, function (Faker $faker) {
    return [
        TenderStatus::COLUMN_NAME => CanceledStatus::DEFAULT_NAME,
        TenderStatus::COLUMN_SLUG => CanceledStatus::DEFAULT_SLUG,
        TenderStatus::COLUMN_TYPE => CanceledStatus::DEFAULT_SLUG,
    ];
});

/**
 * ===================================================================================================================
 */

$factory->define(ActiveStatus::class, function (Faker $faker) {
    return [
    ];
});

$factory->define(RecruitmentOfParticipantsStatus::class, function (Faker $faker) {
    return [
    ];
});

$factory->define(AwaitingConfirmationStatus::class, function (Faker $faker) {
    return [
    ];
});

$factory->define(SuspendedStatus::class, function (Faker $faker) {
    return [
    ];
});

$factory->define(CompletedStatus::class, function (Faker $faker) {
    return [
    ];
});

$factory->define(CanceledStatus::class, function (Faker $faker) {
    return [
    ];
});
