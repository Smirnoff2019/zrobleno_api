<?php

namespace App\Providers;

use App\Services\Blade\MenuService;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AdminMenuServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {   
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app
            ->when([\App\View\Components\Menu::class])
            ->needs('$menu')
            ->give(function ($app) {
                return [
                    "Користувач" => [
                        $this->makeNavLink(
                            'Сповіщення',
                            route('admin.notifications.index'),
                            'fa-bell',
                        ),
                    ],
                    "Контент" => [
                        $this->makeNavLink(
                            'Сторінки',
                            route('admin.pages.index')
                        ),
                        $this->makeNavLink(
                            'Портфоліо',
                            route('admin.portfolios.index'),
                            'fa-folder',
                            [
                                $this->makeNavLink(
                                    'Всі портфоліо',
                                    route('admin.portfolios.index')
                                ),
                                $this->makeNavLink(
                                    'Додати портфоліо',
                                    route('admin.portfolios.create')
                                ),
                                $this->makeNavLink(
                                    'Категорії',
                                    route('admin.portfolios.categories.index')
                                ),
                                $this->makeNavLink(
                                    'Створити категорії',
                                    route('admin.portfolios.categories.create')
                                ),
                            ]
                        ),
                        $this->makeNavLink(
                            'Блог',
                            route('admin.posts.index'),
                            'fa-folder',
                            [
                                $this->makeNavLink(
                                    'Всі публікації',
                                    route('admin.posts.index')
                                ),
                                $this->makeNavLink(
                                    'Додати публікації',
                                    route('admin.posts.create')
                                ),
                                $this->makeNavLink(
                                    'Категорії',
                                    route('admin.posts.categories.index')
                                ),
                                $this->makeNavLink(
                                    'Створити категорію',
                                    route('admin.posts.categories.create')
                                ),
                            ]
                        ),
                        $this->makeNavLink(
                            'Віджети',
                            route('admin.widgets.index')
                        ),
                        $this->makeNavLink(
                            'Меню',
                            route('admin.menus.index')
                        ),
                        $this->makeNavLink(
                            'Зображення',
                            route('admin.images.index')
                        ),
                        $this->makeNavLink(
                            'Таксономії',
                            route('admin.taxonomies.index')
                        ),
                        $this->makeNavLink(
                            'Групи мета-полів',
                            route('admin.meta-fields.groups.index'),
                            'fa-folder',
                            [
                                $this->makeNavLink(
                                    'Всі групи мета-полів',
                                    route('admin.meta-fields.groups.index')
                                ),
                                $this->makeNavLink(
                                    'Створити групу мета-полів',
                                    route('admin.meta-fields.groups.create')
                                ),
                            ]
                        ),
                    ],
                    "Калькулятор ремонтів" => [
                        $this->makeNavLink(
                            'Кімнати',
                            route('admin.rooms.index')
                        ),
                        $this->makeNavLink(
                            'Групи опцій',
                            route('admin.options-groups.index')
                        ),
                        $this->makeNavLink(
                            'Опції',
                            route('admin.options.index')
                        ),
                        $this->makeNavLink(
                            'Параметри',
                            route('admin.calculator-settings.coefficient-per-region.index'),
                            'fa-folder',
                            [
                                $this->makeNavLink(
                                    'Коефіцієнти на область',
                                    route('admin.calculator-settings.coefficient-per-region.index')
                                ),
                                $this->makeNavLink(
                                    'Коефіцієнти на висоту стелі',
                                    route('admin.calculator-settings.ceiling-height-coefficient.index')
                                ),
                                $this->makeNavLink(
                                    'Коефіцієнти на стан об\'єкту',
                                    route('admin.calculator-settings.property-condition-coefficient.index')
                                ),
                                $this->makeNavLink(
                                    'Коефіцієнти на стан стін',
                                    route('admin.calculator-settings.property-walls-condition-coefficient.index')
                                ),
                            ]
                        ),
                    ],
                    "Замовлення" => [
                        $this->makeNavLink(
                            'Проекти ремонту',
                            route('admin.projects.index'),
                            'fa-folder',
                            [
                                $this->makeNavLink(
                                    'Всі проекти ремонту',
                                    route('admin.projects.index')
                                ),
                                $this->makeNavLink(
                                    'Створити проект ремонту',
                                    route('admin.projects.create')
                                ),
                            ]
                        ),
                        $this->makeNavLink(
                            'Тендери',
                            route('admin.tenders.index')
                        ),
                        $this->makeNavLink(
                            'Заявки на тендер',
                            route('admin.tenders.applications.index')
                        ),
                        $this->makeNavLink(
                            'Перезапуск тендеру',
                            route('admin.tenders.restart-applications.index')
                        )
                    ],
                    "Адміністрування" => [
                        $this->makeNavLink(
                            'Адміністрація',
                            url('admin/users?search=&sort_by=&role_id=3'),
                            'fa-folder',
                            [
                                $this->makeNavLink(
                                    'Усі адміністратори',
                                    url('admin/users?search=&sort_by=&role_id=3')
                                ),
                            ]
                        ),
                    ],
                    "Користувачі" => [
                        $this->makeNavLink(
                            'Користувачі',
                            route('admin.users.index'),
                            'fa-folder',
                            [
                                $this->makeNavLink(
                                    'Усі користувачі',
                                    route('admin.users.index')
                                ),
                                $this->makeNavLink(
                                    'Менеджери',
                                    route('admin.users.index', [
                                        'role_id' => 4 
                                    ])
                                ),
                                $this->makeNavLink(
                                    'Замовники',
                                    route('admin.users.index', [
                                        'role_id' => 7 
                                    ])
                                ),
                                $this->makeNavLink(
                                    'Підрядники',
                                    route('admin.users.index', [
                                        'role_id' => 6 
                                    ])
                                ),
                                $this->makeNavLink(
                                    'Додати користувача',
                                    route('admin.users.create')
                                ),
                            ]
                            
                        ),
                        $this->makeNavLink(
                            'Аватарки',
                            route('admin.avatars.index')
                        ),
                        $this->makeNavLink(
                            'Заявки ЗПД',
                            route('admin.users.personal-data-requests.index')
                        ),
                         $this->makeNavLink(
                             'Параметри доступу',
                             route('admin.accessTokens.index')
                         ),
                    ],
                    "Спонсори" => [
                        $this->makeNavLink(
                                'Постачальники',
                                route('admin.suppliers.index')
                        ),
                    ],
                    "Обговорення" => [
                        $this->makeNavLink(
                            'Скарги',
                            route('admin.complaints.index')
                        )
                    ],
                    "Core" => [
                        $this->makeNavLink(
                            'Dashboard',
                            route('admin.home')
                        ),
                    ],
                    "Тестирование" => [
                        $this->makeNavLink(
                            'Отложенные задачи',
                            route('admin.tests.queues.index')
                        ),
                    ],
                ];
            });

    }

    /**
     * Return array configs for menu nav-link
     *
     * @param  string $label
     * @param  string $url
     * @param  string $icon
     * @param  array  $collapse
     * @return object
     */    
    public function makeNavLink(string $label, string $url = null, string $icon = 'fa-folder', array $collapse = [])
    {
        return (object) [
            'label'    => $label,
            'url'      => $url,
            'icon'     => $icon,
            'collapse' => $collapse
        ];
    }
}
