<?php

/** @var Factory $factory */

use App\Models\Status\Status;
use Faker\Generator as Faker;
use App\Models\Status\TenderDeals\AgreedStatus;
use App\Models\Status\TenderDeals\PendingStatus;
use App\Models\Status\TenderDeals\RejectedStatus;
use App\Models\Status\TenderDealStatus;
use Illuminate\Database\Eloquent\Factory;

/**
 * ===================================================================================================================
 */

$factory->state(Status::class, PendingStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_NAME  => PendingStatus::DEFAULT_NAME, 
        Status::COLUMN_SLUG  => PendingStatus::DEFAULT_SLUG,
        Status::COLUMN_TYPE  => PendingStatus::DEFAULT_SLUG,
        Status::COLUMN_GROUP => PendingStatus::DEFAULT_GROUP,
    ];
});

$factory->state(Status::class, AgreedStatus::class, function (Faker $faker) {
    return [
        Status::COLUMN_NAME  => AgreedStatus::DEFAULT_NAME, 
        Status::COLUMN_SLUG  => AgreedStatus::DEFAULT_SLUG,
        Status::COLUMN_TYPE  => AgreedStatus::DEFAULT_SLUG,
        Status::COLUMN_GROUP => AgreedStatus::DEFAULT_GROUP,
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

$factory->state(TenderDealStatus::class, PendingStatus::class, function (Faker $faker) {
    return [
        TenderDealStatus::COLUMN_NAME  => PendingStatus::DEFAULT_NAME, 
        TenderDealStatus::COLUMN_SLUG  => PendingStatus::DEFAULT_SLUG,
        TenderDealStatus::COLUMN_TYPE  => PendingStatus::DEFAULT_SLUG,
        TenderDealStatus::COLUMN_GROUP => PendingStatus::DEFAULT_GROUP,
    ];
});

$factory->state(TenderDealStatus::class, AgreedStatus::class, function (Faker $faker) {
    return [
        TenderDealStatus::COLUMN_NAME  => AgreedStatus::DEFAULT_NAME, 
        TenderDealStatus::COLUMN_SLUG  => AgreedStatus::DEFAULT_SLUG,
        TenderDealStatus::COLUMN_TYPE  => AgreedStatus::DEFAULT_SLUG,
        TenderDealStatus::COLUMN_GROUP => AgreedStatus::DEFAULT_GROUP,
    ];
});

$factory->state(TenderDealStatus::class, RejectedStatus::class, function (Faker $faker) {
    return [
        TenderDealStatus::COLUMN_NAME  => RejectedStatus::DEFAULT_NAME, 
        TenderDealStatus::COLUMN_SLUG  => RejectedStatus::DEFAULT_SLUG,
        TenderDealStatus::COLUMN_TYPE  => RejectedStatus::DEFAULT_SLUG,
        TenderDealStatus::COLUMN_GROUP => RejectedStatus::DEFAULT_GROUP,
    ];
});

/**
 * ===================================================================================================================
 */

$factory->define(PendingStatus::class, function (Faker $faker) {
    return [
    ];
});

$factory->define(AgreedStatus::class, function (Faker $faker) {
    return [
    ];
});

$factory->define(RejectedStatus::class, function (Faker $faker) {
    return [
    ];
});
