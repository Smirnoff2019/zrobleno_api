<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User\User;
use Faker\Generator as Faker;
use App\Models\Project\Project;
use App\Models\Status\Common\ActiveStatus;

$factory->define(Project::class, function (Faker $faker) {
    return [
        Project::COLUMN_TOTAL_AREA      => $area = rand(45, 120),
        Project::COLUMN_TOTAL_PRICE     => rand(10000, 25000) * $area,
        Project::COLUMN_CITY            => $faker->city,
        Project::COLUMN_ADDRESS         => $faker->streetAddress,
        Project::COLUMN_USER_ID         => User::customer()->inRandomOrder()->first(),
        Project::COLUMN_STATUS_ID       => ActiveStatus::first()
    ];
});
