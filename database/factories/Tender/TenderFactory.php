<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Arr;
use App\Models\Tender\Tender;
use Faker\Generator as Faker;
use App\Models\Project\Project;
use App\Models\Status\Tender\AwaitingConfirmationStatus;
use App\Models\Status\Tender\RecruitmentOfParticipantsStatus;

$factory->define(Tender::class, function (Faker $faker) {
    $name = Arr::random([
        'Ремонт смарт-квартири',
        'Ремонт 1-о кімнатної квартири',
        'Ремонт 2-ох кімнатної квартири',
        'Ремонт 3-ох кімнатної квартири',
    ]);
    $max_participants = rand(4, 11);
    $price = rand(420, 2000);

    return [
        Tender::COLUMN_NAME                 => $name,
        Tender::COLUMN_MAX_PARTICIPANTS     => $max_participants,
        Tender::COLUMN_PRICE                => $price,
        Tender::COLUMN_STATUS_ID            => AwaitingConfirmationStatus::first(),
        Tender::COLUMN_PROJECT_ID           => null,
        Tender::COLUMN_STARTED_AT           => now()->addDays(3),
        Tender::COLUMN_FINISHED_AT          => now()->addDays(31),
    ];
});
