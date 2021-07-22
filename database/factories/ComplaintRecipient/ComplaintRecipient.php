<?php

/** @var Factory $factory */

use App\Models\ComplaintRecipient\ComplaintRecipient;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(ComplaintRecipient::class, function (Faker $faker) {
    return [
        ComplaintRecipient::COLUMN_COMPLAINT_ID => null,
        ComplaintRecipient::COLUMN_USER_ID      => null,
    ];
});
