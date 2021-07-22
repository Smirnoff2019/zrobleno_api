<?php

use Illuminate\Database\Seeder;

class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\AccountType\AccountType::class)->states(['main'])->create();
        factory(App\Models\AccountType\AccountType::class)->states(['bonus'])->create();
    }
}
