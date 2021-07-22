<?php

use App\Models\ProjectPropertyCondition\NewBuildingProjectPropertyCondition;
use Illuminate\Database\Seeder;
use App\Models\ProjectPropertyCondition\ProjectPropertyCondition;
use App\Models\ProjectPropertyCondition\SecondaryBuildingProjectPropertyCondition;

class ProjectPropertyConditionTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(ProjectPropertyCondition::class)
            ->states(NewBuildingProjectPropertyCondition::class)
            ->create();

        factory(ProjectPropertyCondition::class)
            ->states(SecondaryBuildingProjectPropertyCondition::class)
            ->create();

    }
    
}
