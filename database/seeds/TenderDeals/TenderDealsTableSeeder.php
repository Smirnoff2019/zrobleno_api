<?php

use App\Models\TenderDeals\TenderDeals;
use Illuminate\Database\Seeder;

class TenderDealsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(TenderDeals::class, 3)->create();

    }

}
