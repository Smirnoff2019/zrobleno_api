<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([

            PermissionSeeder::class,

            StatusTableSeeder::class,

            RoleTableSeeder::class,

            RolePermissionSeeder::class,

            AccountTypeSeeder::class,

            UserTableSeeder::class,

            PostTableSeeder::class,

            FileTableSeeder::class,

            ImageTableSeeder::class,

            RoomTableSeeder::class,

//            ProjectPropertyConditionTableSeeder::class,
//
//            ProjectTableSeeder::class,
//
//            TenderTableSeeder::class,

            SupplierTableSeeder::class,

            PostTypeTableSeeder::class,

            CategoryTableSeeder::class,
            
            CalculatorOptionTableSeeder::class,

            //MetaFieldTableSeeder::class,

            MetaFieldsGroupsTableSeeder::class,

            //MetaTableSeeder::class,

            // NotificationTypeTableSeeder::class,
            //NotificationGroupTableSeeder::class,
            //NotificationTemplateTableSeeder::class,

        ]);
    }
}
