<?php

namespace App\Providers;

use App\Repositories\Eloquent\Abilities\AbilityRepository;
use App\Repositories\Eloquent\Abilities\Interfaces\AbilityRepositoryInterface;
use App\Repositories\Eloquent\Notification\Interfaces\NotificationGroupRepositoryInterface;
use App\Repositories\Eloquent\Notification\Interfaces\NotificationTemplateRepositoryInterface;
use App\Repositories\Eloquent\Notification\Interfaces\NotificationTypeRepositoryInterface;
use App\Repositories\Eloquent\Notification\NotificationGroupRepository;
use App\Repositories\Eloquent\Notification\NotificationTemplateRepository;

use App\Repositories\Eloquent\Notification\NotificationTypeRepository;
use App\Repositories\Eloquent\Payment\Interfaces\PaymentRepositoryInterface;
use App\Repositories\Eloquent\Payment\PaymentRepository;
use App\Repositories\Eloquent\Permission\Interfaces\PermissionRepositoryInterface;
use App\Repositories\Eloquent\Permission\PermissionRepository;
use App\Repositories\Eloquent\Roles\Interfaces\RoleRepositoryInterface;
use App\Repositories\Eloquent\Roles\RoleRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\Room\RoomRepository;
use App\Repositories\Eloquent\User\UserRepository;
use App\Repositories\Eloquent\Tender\TenderRepository;
use App\Repositories\Eloquent\Notification\NotificationRepository;
use App\Repositories\Eloquent\Room\Interfaces\RoomRepositoryInterface;
use App\Repositories\Eloquent\User\Interfaces\UserRepositoryInterface;
use App\Repositories\Eloquent\Tender\Interfaces\TenderRepositoryInterface;
use App\Repositories\Eloquent\Notification\Interfaces\NotificationRepositoryInterface;

class RepositoriesServiceProvider extends ServiceProvider
{

    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        UserRepositoryInterface::class                 => UserRepository::class,
        TenderRepositoryInterface::class               => TenderRepository::class,
        RoomRepositoryInterface::class                 => RoomRepository::class,
        NotificationRepositoryInterface::class         => NotificationRepository::class,
        NotificationTemplateRepositoryInterface::class => NotificationTemplateRepository::class,
        NotificationGroupRepositoryInterface::class    => NotificationGroupRepository::class,
        NotificationTypeRepositoryInterface::class     => NotificationTypeRepository::class,
        PaymentRepositoryInterface::class              => PaymentRepository::class,
        AbilityRepositoryInterface::class              => AbilityRepository::class,
        RoleRepositoryInterface::class                 => RoleRepository::class,
        PermissionRepositoryInterface::class           => PermissionRepository::class
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

}
