<?php

use Illuminate\Database\Seeder;
use App\Models\NotificationGroup\NotificationGroup;

class NotificationGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(NotificationGroup::class)->states(['payments'])->create();
        factory(NotificationGroup::class)->states(['tenders'])->create();
        factory(NotificationGroup::class)->states(['auth'])->create();
    }
}
