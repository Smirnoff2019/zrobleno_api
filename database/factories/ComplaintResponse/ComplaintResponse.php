<?php

/** @var Factory $factory */

use App\Models\ComplaintResponse\ComplaintResponse;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(ComplaintResponse::class, function (Faker $faker) {
    return [
        ComplaintResponse::COLUMN_COMPLAINT_ID => null,
        ComplaintResponse::COLUMN_RESPONSE_ID  => null,
        ComplaintResponse::COLUMN_USER_ID      => null
    ];
});
