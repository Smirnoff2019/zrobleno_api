<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Status\Tender\AwaitingConfirmationStatus;
use App\Models\TenderApplication\TenderApplication;
use Faker\Generator as Faker;

$factory->define(TenderApplication::class, function (Faker $faker) {
    return [
        TenderApplication::COLUMN_STATUS_ID => AwaitingConfirmationStatus::first(),
    ];
});

