<?php

use Illuminate\Database\Seeder;
use App\Models\Permission\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        collect($this->permission())->map(function ($item) {
            $permission = factory(Permission::class)->create([
                Permission::COLUMN_NAME => $item['name'],
                Permission::COLUMN_SLUG => $item['slug'],
                Permission::COLUMN_MODULE_NAME => $item['module_name'],
            ]);
            collect($item['subs'])->map(function ($item_) use ($permission) {
                factory(Permission::class)->create([
                    Permission::COLUMN_NAME => $item_['name'],
                    Permission::COLUMN_SLUG => $item_['slug'],
                    Permission::COLUMN_MODULE_NAME => $item_['module_name'],
                    Permission::COLUMN_METHOD_NAME => $item_['method_name'],
                    Permission::COLUMN_PARENT_ID => $permission->id,
                ]);
            });
        });
    }

    private function permission () {
        return [
            [
                'name' => 'Пользователи',
                'slug' => 'user',
                'module_name' => 'user',
                'method_name' => null,
                'parent_id' => null,
                'subs' => [
                    [
                        'name' => 'Редактирование',
                        'slug' => 'user_edit',
                        'module_name' => 'user',
                        'method_name' => 'edit',
                    ],
                    [
                        'name' => 'Создание',
                        'slug' => 'user_create',
                        'module_name' => 'user',
                        'method_name' => 'create',
                    ],
                    [
                        'name' => 'Просмотр',
                        'slug' => 'user_show',
                        'module_name' => 'user',
                        'method_name' => 'show',
                    ],
                    [
                        'name' => 'Удаление',
                        'slug' => 'user_delete',
                        'module_name' => 'user',
                        'method_name' => 'delete',
                    ]
                ]
            ],
            [
                'name' => 'Тендеры',
                'slug' => 'tender',
                'module_name' => 'tender',
                'method_name' => null,
                'parent_id' => null,
                'subs' => [
                    [
                        'name' => 'Создание',
                        'slug' => 'tender_create',
                        'module_name' => 'tender',
                        'method_name' => 'create',
                    ],
                    [
                        'name' => 'Редактирование',
                        'slug' => 'tender_edit',
                        'module_name' => 'tender',
                        'method_name' => 'edit',
                    ],
                    [
                        'name' => 'Просмотр',
                        'slug' => 'tender_show',
                        'module_name' => 'tender',
                        'method_name' => 'show',
                    ],
                    [
                        'name' => 'Удаление',
                        'slug' => 'tender_delete',
                        'module_name' => 'tender',
                        'method_name' => 'delete',
                    ]
                ]
            ],

            [
                'name' => 'Роли',
                'slug' => 'role',
                'module_name' => 'role',
                'method_name' => null,
                'parent_id' => null,
                'subs' => [
                    [
                        'name' => 'Создание',
                        'slug' => 'role_create',
                        'module_name' => 'role',
                        'method_name' => 'create',
                    ],
                    [
                        'name' => 'Редактирование',
                        'slug' => 'role_edit',
                        'module_name' => 'role',
                        'method_name' => 'edit',
                    ],
                    [
                        'name' => 'Просмотр',
                        'slug' => 'role_show',
                        'module_name' => 'role',
                        'method_name' => 'show',
                    ],
                    [
                        'name' => 'Удаление',
                        'slug' => 'role_delete',
                        'module_name' => 'role',
                        'method_name' => 'delete',
                    ]
                ]
            ],
        ];
    }
}
