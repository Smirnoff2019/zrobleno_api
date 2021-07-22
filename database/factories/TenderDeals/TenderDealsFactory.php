<?php

/** @var Factory $factory */

use App\Models\Status\TenderDeals\PendingStatus;
use App\Models\TenderDeals\TenderDeals;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(TenderDeals::class, function (Faker $faker) {
    return [
        TenderDeals::COLUMN_TENDER_ID      => null,
        TenderDeals::COLUMN_CUSTOMER_ID    => null,
        TenderDeals::COLUMN_CONTRACTOR_ID  => null,
        TenderDeals::COLUMN_STATUS_ID      => PendingStatus::first(),
    ];
});
