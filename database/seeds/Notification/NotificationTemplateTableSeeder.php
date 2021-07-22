<?php

use Illuminate\Database\Seeder;
use App\Models\NotificationTemplate\NotificationTemplate;

class NotificationTemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        collect(['success.refill.payment',
            'error.refill.payment',
            'information.refill.payment',
            'success.debit.payment',
            'error.debit.payment',
            'information.debit.payment'])->map(function ($item){
            factory(NotificationTemplate::class)->states($item)->create();
        });

    }
}
