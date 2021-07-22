<?php

/** @var Factory $factory */

use App\Models\Role\Role;
use Illuminate\Support\Str;
use App\Models\Role\UserRole;
use Faker\Generator as Faker;
use App\Models\Role\AdminRole;
use App\Models\Role\EditorRole;
use App\Models\Role\ManagerRole;
use App\Models\Role\CustomerRole;
use App\Models\Role\SuperUserRole;
use App\Models\Role\ContractorRole;
use App\Models\Role\OwnerQARole;
use App\Models\Role\SeniorAdminRole;
use Illuminate\Database\Eloquent\Factory;
use App\Models\Status\Common\ActiveStatus;

/**
 * ===================================================================================================================
 */

$factory->define(Role::class, function (Faker $faker) {
    return [
        Role::COLUMN_NAME        => $name = $faker->name,
        Role::COLUMN_SLUG        => Str::slug($name, '_'),
        Role::COLUMN_DESCRIPTION => $faker->paragraph,
        Role::COLUMN_STATUS_ID   => ActiveStatus::first()
    ];
});

/**
 * ===================================================================================================================
 */

$factory->state(Role::class, SuperUserRole::class, [
    Role::COLUMN_SLUG => SuperUserRole::DEFAULT_SLUG,
    Role::COLUMN_NAME => SuperUserRole::DEFAULT_NAME
]);

$factory->state(Role::class, SeniorAdminRole::class, [
    Role::COLUMN_SLUG => SeniorAdminRole::DEFAULT_SLUG,
    Role::COLUMN_NAME => SeniorAdminRole::DEFAULT_NAME
]);

$factory->state(Role::class, AdminRole::class, [
    Role::COLUMN_SLUG => AdminRole::DEFAULT_SLUG,
    Role::COLUMN_NAME => AdminRole::DEFAULT_NAME
]);

$factory->state(Role::class, ManagerRole::class, [
    Role::COLUMN_SLUG => ManagerRole::DEFAULT_SLUG,
    Role::COLUMN_NAME => ManagerRole::DEFAULT_NAME
]);

$factory->state(Role::class, EditorRole::class, [
    Role::COLUMN_SLUG => EditorRole::DEFAULT_SLUG,
    Role::COLUMN_NAME => EditorRole::DEFAULT_NAME
]);

$factory->state(Role::class, ContractorRole::class, [
    Role::COLUMN_SLUG => ContractorRole::DEFAULT_SLUG,
    Role::COLUMN_NAME => ContractorRole::DEFAULT_NAME
]);

$factory->state(Role::class, CustomerRole::class, [
    Role::COLUMN_SLUG => CustomerRole::DEFAULT_SLUG,
    Role::COLUMN_NAME => CustomerRole::DEFAULT_NAME
]);

$factory->state(Role::class, UserRole::class, [
    Role::COLUMN_SLUG => UserRole::DEFAULT_SLUG,
    Role::COLUMN_NAME => UserRole::DEFAULT_NAME
]);

$factory->state(Role::class, OwnerQARole::class, [
    Role::COLUMN_SLUG => OwnerQARole::DEFAULT_SLUG,
    Role::COLUMN_NAME => OwnerQARole::DEFAULT_NAME
]);

/**
 * ===================================================================================================================
 */

$factory->state(Role::class, SuperUserRole::DEFAULT_SLUG, [
    Role::COLUMN_SLUG => SuperUserRole::DEFAULT_SLUG,
    Role::COLUMN_NAME => SuperUserRole::DEFAULT_NAME
]);

$factory->state(Role::class, SeniorAdminRole::DEFAULT_SLUG, [
    Role::COLUMN_SLUG => SeniorAdminRole::DEFAULT_SLUG,
    Role::COLUMN_NAME => SeniorAdminRole::DEFAULT_NAME
]);

$factory->state(Role::class, AdminRole::DEFAULT_SLUG, [
    Role::COLUMN_SLUG => AdminRole::DEFAULT_SLUG,
    Role::COLUMN_NAME => AdminRole::DEFAULT_NAME
]);

$factory->state(Role::class, ManagerRole::DEFAULT_SLUG, [
    Role::COLUMN_SLUG => ManagerRole::DEFAULT_SLUG,
    Role::COLUMN_NAME => ManagerRole::DEFAULT_NAME
]);

$factory->state(Role::class, EditorRole::DEFAULT_SLUG, [
    Role::COLUMN_SLUG => EditorRole::DEFAULT_SLUG,
    Role::COLUMN_NAME => EditorRole::DEFAULT_NAME
]);

$factory->state(Role::class, ContractorRole::DEFAULT_SLUG, [
    Role::COLUMN_SLUG => ContractorRole::DEFAULT_SLUG,
    Role::COLUMN_NAME => ContractorRole::DEFAULT_NAME
]);

$factory->state(Role::class, CustomerRole::DEFAULT_SLUG, [
    Role::COLUMN_SLUG => CustomerRole::DEFAULT_SLUG,
    Role::COLUMN_NAME => CustomerRole::DEFAULT_NAME
]);

$factory->state(Role::class, UserRole::DEFAULT_SLUG, [
    Role::COLUMN_SLUG => UserRole::DEFAULT_SLUG,
    Role::COLUMN_NAME => UserRole::DEFAULT_NAME
]);

$factory->state(Role::class, OwnerQARole::DEFAULT_SLUG, [
    Role::COLUMN_SLUG => OwnerQARole::DEFAULT_SLUG,
    Role::COLUMN_NAME => OwnerQARole::DEFAULT_NAME
]);

/**
 * ===================================================================================================================
 */
