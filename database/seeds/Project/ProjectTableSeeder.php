<?php

use App\Models\Project\Project;
use Illuminate\Database\Seeder;
use App\Models\ProjectPropertyCondition\NewBuildingProjectPropertyCondition;
use App\Models\ProjectPropertyCondition\SecondaryBuildingProjectPropertyCondition;

class ProjectTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(Project::class, 10)
            ->create()
            ->each(function($project) {
                //
            });

    }
    
}
