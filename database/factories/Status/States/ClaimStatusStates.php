<?php

/** @var Factory $factory */

use App\Models\Status\Complaint\InProcessingStatus;
use App\Models\Status\Complaint\ProcessedStatus;
use App\Models\Status\Complaint\SatisfiedStatus;
use App\Models\Status\ComplaintStatus;
use App\Models\Status\Status;
use Faker\Generator as Faker;
use App\Models\Status\Complaint\RejectedStatus;
use Illuminate\Database\Eloquent\Factory;

/**
 * ===================================================================================================================
 */

$factory->state(Status::class, InProcessingStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_NAME  => InProcessingStatus::DEFAULT_NAME,
        Status::COLUMN_SLUG  => InProcessingStatus::DEFAULT_SLUG,
        Status::COLUMN_TYPE  => InProcessingStatus::DEFAULT_SLUG,
        Status::COLUMN_GROUP => InProcessingStatus::DEFAULT_GROUP,
    ];
});

$factory->state(Status::class, ProcessedStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_NAME  => ProcessedStatus::DEFAULT_NAME,
        Status::COLUMN_SLUG  => ProcessedStatus::DEFAULT_SLUG,
        Status::COLUMN_TYPE  => ProcessedStatus::DEFAULT_SLUG,
        Status::COLUMN_GROUP => ProcessedStatus::DEFAULT_GROUP,
    ];
});

$factory->state(Status::class, SatisfiedStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_NAME  => SatisfiedStatus::DEFAULT_NAME,
        Status::COLUMN_SLUG  => SatisfiedStatus::DEFAULT_SLUG,
        Status::COLUMN_TYPE  => SatisfiedStatus::DEFAULT_SLUG,
        Status::COLUMN_GROUP => SatisfiedStatus::DEFAULT_GROUP,
    ];
});

$factory->state(Status::class, RejectedStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_NAME  => RejectedStatus::DEFAULT_NAME,
        Status::COLUMN_SLUG  => RejectedStatus::DEFAULT_SLUG,
        Status::COLUMN_TYPE  => RejectedStatus::DEFAULT_SLUG,
        Status::COLUMN_GROUP => RejectedStatus::DEFAULT_GROUP,
    ];
});

/**
 * ===================================================================================================================
 */

$factory->state(ComplaintStatus::class, InProcessingStatus::class, function (Faker $faker) {
    return [
        ComplaintStatus::COLUMN_NAME  => InProcessingStatus::DEFAULT_NAME,
        ComplaintStatus::COLUMN_SLUG  => InProcessingStatus::DEFAULT_SLUG,
        ComplaintStatus::COLUMN_TYPE  => InProcessingStatus::DEFAULT_SLUG,
        ComplaintStatus::COLUMN_GROUP => InProcessingStatus::DEFAULT_GROUP,
    ];
});

$factory->state(ComplaintStatus::class, ProcessedStatus::class, function (Faker $faker) {
    return [
        ComplaintStatus::COLUMN_NAME  => ProcessedStatus::DEFAULT_NAME,
        ComplaintStatus::COLUMN_SLUG  => ProcessedStatus::DEFAULT_SLUG,
        ComplaintStatus::COLUMN_TYPE  => ProcessedStatus::DEFAULT_SLUG,
        ComplaintStatus::COLUMN_GROUP => ProcessedStatus::DEFAULT_GROUP,
    ];
});

$factory->state(ComplaintStatus::class, SatisfiedStatus::class, function (Faker $faker) {
    return [
        ComplaintStatus::COLUMN_NAME  => SatisfiedStatus::DEFAULT_NAME,
        ComplaintStatus::COLUMN_SLUG  => SatisfiedStatus::DEFAULT_SLUG,
        ComplaintStatus::COLUMN_TYPE  => SatisfiedStatus::DEFAULT_SLUG,
        ComplaintStatus::COLUMN_GROUP => SatisfiedStatus::DEFAULT_GROUP,
    ];
});

$factory->state(ComplaintStatus::class, RejectedStatus::class, function (Faker $faker) {
    return [
        ComplaintStatus::COLUMN_NAME  => RejectedStatus::DEFAULT_NAME,
        ComplaintStatus::COLUMN_SLUG  => RejectedStatus::DEFAULT_SLUG,
        ComplaintStatus::COLUMN_TYPE  => RejectedStatus::DEFAULT_SLUG,
        ComplaintStatus::COLUMN_GROUP => RejectedStatus::DEFAULT_GROUP,
    ];
});

/**
 * ===================================================================================================================
 */

$factory->define(InProcessingStatus::class, function (Faker $faker) {
    return [
    ];
});

$factory->define(ProcessedStatus::class, function (Faker $faker) {
    return [
    ];
});

$factory->define(SatisfiedStatus::class, function (Faker $faker) {
    return [
    ];
});

$factory->define(RejectedStatus::class, function (Faker $faker) {
    return [
    ];
});
