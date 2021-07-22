<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\Status\Common\ActiveStatus;
use App\Models\ProjectPropertyCondition\ProjectPropertyCondition;
use App\Models\ProjectPropertyCondition\NewBuildingProjectPropertyCondition;
use App\Models\ProjectPropertyCondition\SecondaryBuildingProjectPropertyCondition;


$factory->define(ProjectPropertyCondition::class, function (Faker $faker) {
    return [
        ProjectPropertyCondition::COLUMN_NAME      => $title = $faker->sentences(1, true),
        ProjectPropertyCondition::COLUMN_SLUG      => Str::slug($title),
        ProjectPropertyCondition::COLUMN_STATUS_ID => ActiveStatus::first(),
    ];
});


/**
 * ===================================================================================================================
 */

$factory->state(
    ProjectPropertyCondition::class, 
    NewBuildingProjectPropertyCondition::class, 
    [
        ProjectPropertyCondition::COLUMN_SLUG => NewBuildingProjectPropertyCondition::DEFAULT_SLUG,
        ProjectPropertyCondition::COLUMN_NAME => NewBuildingProjectPropertyCondition::DEFAULT_NAME,
    ]
);

$factory->state(
    ProjectPropertyCondition::class, 
    SecondaryBuildingProjectPropertyCondition::class, 
    [
        ProjectPropertyCondition::COLUMN_SLUG => SecondaryBuildingProjectPropertyCondition::DEFAULT_SLUG,
        ProjectPropertyCondition::COLUMN_NAME => SecondaryBuildingProjectPropertyCondition::DEFAULT_NAME,
    ]
);

/**
 * ===================================================================================================================
 */