<?php

use App\Models\User\User;
use Illuminate\Database\Seeder;
use App\Jobs\Tender\TenderCreate;

class TenderTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i=0; $i < 10; $i++) {
            TenderCreate::dispatchNow(
                [],
                User::customer()
                    ->inRandomOrder()
                    ->first()
            );
        }

    }
  
}
