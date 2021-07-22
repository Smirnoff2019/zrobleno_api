<?php

/** @var Factory $factory */

use App\Models\Status\TenderRestart\AwaitingConfirmationStatus;
use App\Models\TenderRestart\TenderRestart;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(TenderRestart::class, function (Faker $faker) {
    return [
        TenderRestart::COLUMN_TENDER_ID      => null,
        TenderRestart::COLUMN_NEW_TENDER_ID  => null,
        TenderRestart::COLUMN_STATUS_ID      => AwaitingConfirmationStatus::first(),
    ];
});
