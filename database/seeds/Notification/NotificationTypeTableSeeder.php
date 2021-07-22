<?php

use Illuminate\Database\Seeder;
use App\Models\NotificationType\NotificationType;

class NotificationTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(NotificationType::class)->states(['telegram'])->create();
        factory(NotificationType::class)->states(['mail'])->create();
        factory(NotificationType::class)->states(['database'])->create();
    }
}
