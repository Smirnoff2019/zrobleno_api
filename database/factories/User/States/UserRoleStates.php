<?php

/** @var Factory $factory */

use App\Models\Role\AdminRole;
use App\Models\Role\ContractorRole;
use App\Models\Role\CustomerRole;
use App\Models\Role\EditorRole;
use App\Models\Role\ManagerRole;
use App\Models\Role\OwnerQARole;
use App\Models\Role\SeniorAdminRole;
use App\Models\Role\SuperUserRole;
use App\Models\Role\UserRole;
use App\Models\User\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/**
 * ===================================================================================================================
 * Role user states
 */

$factory->state(User::class, SuperUserRole::class, function (Faker $faker) {
    return [
        User::COLUMN_ROLE_ID => SuperUserRole::first()
    ];
});

$factory->state(User::class, SeniorAdminRole::class, function (Faker $faker) {
    return [
        User::COLUMN_ROLE_ID => SeniorAdminRole::first()
    ];
});

$factory->state(User::class, AdminRole::class, function (Faker $faker) {
    return [
        User::COLUMN_ROLE_ID => AdminRole::first()
    ];
});

$factory->state(User::class, ManagerRole::class, function (Faker $faker) {
    return [
        User::COLUMN_ROLE_ID => ManagerRole::first()
    ];
});

$factory->state(User::class, EditorRole::class, function (Faker $faker) {
    return [
        User::COLUMN_ROLE_ID => EditorRole::first()
    ];
});

$factory->state(User::class, ContractorRole::class, function (Faker $faker) {
    return [
        User::COLUMN_ROLE_ID => ContractorRole::first()
    ];
});

$factory->state(User::class, CustomerRole::class, function (Faker $faker) {
    return [
        User::COLUMN_ROLE_ID => CustomerRole::first()
    ];
});

$factory->state(User::class, UserRole::class, function (Faker $faker) {
    return [
        User::COLUMN_ROLE_ID => UserRole::first()
    ];
});

$factory->state(User::class, OwnerQARole::class, function (Faker $faker) {
    return [
        User::COLUMN_ROLE_ID => OwnerQARole::first()
    ];
});
