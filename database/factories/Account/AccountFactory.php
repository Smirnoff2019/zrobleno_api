<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\Account\Account;
use App\Models\Status\Common\ActiveStatus;

$factory->define(Account::class, function (Faker $faker) {
    return [
        Account::COLUMN_PID          => time(),
        Account::COLUMN_BALANCE      => 2000,
        Account::COLUMN_ACCOUNT_TYPE => 'main',
        Account::COLUMN_STATUS_ID    => ActiveStatus::first(),
    ];
});

$factory->state(Account::class, "main", [
    Account::COLUMN_ACCOUNT_TYPE => 'main',
    Account::COLUMN_BALANCE      => 0,
]);

$factory->state(Account::class, "bonus", [
    Account::COLUMN_ACCOUNT_TYPE => 'bonus',
    Account::COLUMN_BALANCE      => 2000,
]);

$factory->state(Account::class, "Empty", [
    Account::COLUMN_BALANCE => 0,
]);

$factory->state(Account::class, "Standart", [
    Account::COLUMN_BALANCE => 2000,
]);

$factory->state(Account::class, "Standart+", [
    Account::COLUMN_BALANCE => 4000,
]);
