<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Room\Bathroom;
use App\Models\Room\Bedroom;
use App\Models\Room\Corridor;
use App\Models\Room\Kitchen;
use App\Models\Room\KitchenLivingRoom;
use App\Models\Room\LivingRoom;
use App\Models\Room\Room;
use App\Models\Status\Common\ActiveStatus;
use Illuminate\Support\Str;
use Faker\Generator as Faker;


$factory->define(Room::class, function (Faker $faker) {
    return [
        Room::COLUMN_NAME           => $name = $faker->name,
        Room::COLUMN_SLUG           => Str::slug($name),
        Room::COLUMN_SORT           => null,
        Room::COLUMN_MAX_COUNT      => 1,
        Room::COLUMN_DEFAULT_COUNT  => 0,
        Room::COLUMN_STATUS_ID      => ActiveStatus::first()
    ];
});


/**
 * ===================================================================================================================
 */

$factory->state(
    Room::class, 
    Bathroom::class, 
    [
        Room::COLUMN_NAME           => Bathroom::DEFAULT_NAME,
        Room::COLUMN_SLUG           => Bathroom::DEFAULT_SLUG,
        Room::COLUMN_MAX_COUNT      => Bathroom::DEFAULT_MAX_COUNT,
        Room::COLUMN_DEFAULT_COUNT  => Bathroom::DEFAULT_DEFAULT_COUNT,
    ]
);

$factory->state(
    Room::class, 
    Bedroom::class, 
    [
        Room::COLUMN_NAME           => Bedroom::DEFAULT_NAME,
        Room::COLUMN_SLUG           => Bedroom::DEFAULT_SLUG,
        Room::COLUMN_MAX_COUNT      => Bedroom::DEFAULT_MAX_COUNT,
        Room::COLUMN_DEFAULT_COUNT  => Bedroom::DEFAULT_DEFAULT_COUNT,
    ]
);

$factory->state(
    Room::class, 
    Kitchen::class, 
    [
        Room::COLUMN_NAME           => Kitchen::DEFAULT_NAME,
        Room::COLUMN_SLUG           => Kitchen::DEFAULT_SLUG,
        Room::COLUMN_MAX_COUNT      => Kitchen::DEFAULT_MAX_COUNT,
        Room::COLUMN_DEFAULT_COUNT  => Kitchen::DEFAULT_DEFAULT_COUNT,
    ]
);

$factory->state(
    Room::class, 
    LivingRoom::class, 
    [
        Room::COLUMN_NAME           => LivingRoom::DEFAULT_NAME,
        Room::COLUMN_SLUG           => LivingRoom::DEFAULT_SLUG,
        Room::COLUMN_MAX_COUNT      => LivingRoom::DEFAULT_MAX_COUNT,
        Room::COLUMN_DEFAULT_COUNT  => LivingRoom::DEFAULT_DEFAULT_COUNT,
    ]
);

$factory->state(
    Room::class, 
    Corridor::class, 
    [
        Room::COLUMN_NAME           => Corridor::DEFAULT_NAME,
        Room::COLUMN_SLUG           => Corridor::DEFAULT_SLUG,
        Room::COLUMN_MAX_COUNT      => Corridor::DEFAULT_MAX_COUNT,
        Room::COLUMN_DEFAULT_COUNT  => Corridor::DEFAULT_DEFAULT_COUNT,
    ]
);

$factory->state(
    Room::class, 
    KitchenLivingRoom::class, 
    [
        Room::COLUMN_NAME           => KitchenLivingRoom::DEFAULT_NAME,
        Room::COLUMN_SLUG           => KitchenLivingRoom::DEFAULT_SLUG,
        Room::COLUMN_MAX_COUNT      => KitchenLivingRoom::DEFAULT_MAX_COUNT,
        Room::COLUMN_DEFAULT_COUNT  => KitchenLivingRoom::DEFAULT_DEFAULT_COUNT,
    ]
);

/**
 * ===================================================================================================================
 */
