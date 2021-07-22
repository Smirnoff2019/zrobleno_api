<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Support\Facades\Route;

Breadcrumbs::macro('pageTitle', function ($title = '') {
    if(Breadcrumbs::exists(Route::currentRouteName())) {
        $title = ($breadcrumb = Breadcrumbs::current() ?? null) ? "{$breadcrumb->title} – " : '';
    }
    
    if (($page = (int) request()->get('page')) > 1) {
        $title .= "Сторінка $page – ";
    }
    
    return $title . 'Зроблено™ | Admin Panel';
});

Breadcrumbs::macro('currentTitle', function ($before = '', $after = '') {
    $title = Breadcrumbs::current()->title ?? '';

    return trim("$before $title $after");
});

Breadcrumbs::macro('resource', function ($name, $indexLabel, $createLabel = 'Створити', $editLabel = "Редагувати") {

    // Home > Blog
    Breadcrumbs::for("$name.index", function ($trail) use ($name, $indexLabel) {
        $trail->parent('admin.home');
        $trail->push($indexLabel, route("$name.index"));
    });

    // Home > Blog > Create
    Breadcrumbs::for("$name.create", function ($trail) use ($name, $createLabel) {
        $trail->parent("$name.index");
        $trail->push($createLabel, route("$name.create"));
    });

    // Home > Blog > Post 123
    Breadcrumbs::for("$name.edit", function ($trail, $model) use ($name, $editLabel) {
        $trail->parent("$name.index");
        $trail->push(($model->name ?? $model->title ?? $editLabel ?? ''), route("$name.edit", $model));
    });

});

Breadcrumbs::for('admin.home', function ($trail) {
    $trail->push('Головна', route('admin.home'));
});

Breadcrumbs::resource('admin.rooms', 'Кімнати');
Breadcrumbs::resource('admin.notifications', 'Сповіщення');
Breadcrumbs::resource('admin.projects', 'Проекти ремонтів');
Breadcrumbs::resource('admin.tenders', 'Тендери');
Breadcrumbs::resource('admin.tenders.applications', 'Заявки на тендер');
Breadcrumbs::resource('admin.tenders.restart-applications', 'Заявки на перезапуск тендеру');
Breadcrumbs::resource('admin.options-groups', 'Групи опцій');
Breadcrumbs::resource('admin.options', 'Опції');
Breadcrumbs::resource('admin.posts.categories', 'Категорії публікацій');
Breadcrumbs::resource('admin.posts', 'Публікації');
Breadcrumbs::resource('admin.widgets', 'Віджети');
Breadcrumbs::resource('admin.menus', 'Усі меню');
Breadcrumbs::resource('admin.pages', 'Сторінки');
Breadcrumbs::resource('admin.images', 'Зображення');
Breadcrumbs::resource('admin.calculator-settings.coefficient', 'Коефіцієнти калькулятора');
Breadcrumbs::resource('admin.calculator-settings.coefficient-per-region', 'Коефіцієнти на область');
Breadcrumbs::resource('admin.calculator-settings.ceiling-height-coefficient', 'Коефіцієнти на висоту стелі');
Breadcrumbs::resource('admin.calculator-settings.property-condition-coefficient', 'Коефіцієнти на стан об\'єкту');
Breadcrumbs::resource('admin.calculator-settings.property-walls-condition-coefficient', 'Коефіцієнти на стан стін');
Breadcrumbs::resource('admin.categories', 'Категорії');
Breadcrumbs::resource('admin.portfolios', 'Портфоліо');
Breadcrumbs::resource('admin.suppliers', 'Постачальники');
Breadcrumbs::resource('admin.suppliers-discounts', 'Програми знижок');
Breadcrumbs::resource('admin.complaints', 'Скарги');
Breadcrumbs::resource('admin.portfolios.categories', 'Категорії портфоліо');
Breadcrumbs::resource('admin.users.contractors.portfolios', 'Портфоліо підрядників');
Breadcrumbs::resource('admin.taxonomies', 'Таксономії');
Breadcrumbs::resource('admin.meta-fields.groups', 'Групи мета-полів');
Breadcrumbs::resource('admin.users', 'Користувачі');
Breadcrumbs::resource('admin.users.personal-data-requests', 'Заявки на редагування персональних даних');
Breadcrumbs::resource('admin.avatars', 'Аватарки');
Breadcrumbs::resource('admin.accessTokens', 'Контроль параметрів');
Breadcrumbs::resource('admin.tests.queues', 'Тестирование');
