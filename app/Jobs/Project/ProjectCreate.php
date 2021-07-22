<?php

namespace App\Jobs\Project;

use App\Models\CalculatorOption\CeilingHeightCoefficient;
use App\Models\CalculatorOption\CoefficientPerRegion;
use App\Models\CalculatorOption\PropertyConditionCoefficient;
use App\Models\CalculatorOption\PropertyWallsConditionCoefficient;
use App\Models\Option\Option;
use App\Models\Project\Project;
use Illuminate\Routing\UrlGenerator;
use App\Models\Status\Common\ActiveStatus;
use App\Models\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProjectCreate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Project data
     *
     * @var array
     */
    protected $data;

    /**
     * Project owner
     *
     * @var \App\Models\User\User
     */
    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, User $user)
    {
        $this->data = $data;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = optional((object) $this->data);

        $project = factory(Project::class)->make([
            Project::COLUMN_TOTAL_AREA  => $data->total_area,
            Project::COLUMN_TOTAL_PRICE => $data->total_price,
            Project::COLUMN_CITY        => $data->city,
            Project::COLUMN_ADDRESS     => $data->address,
            Project::COLUMN_STATUS_ID   => ActiveStatus::first(),
        ]);

        $project->wallsCondition()->associate(PropertyWallsConditionCoefficient::find($data->walls_condition_id));
        $project->region()->associate(CoefficientPerRegion::find($data->region_id));
        $project->propertyCondition()->associate(PropertyConditionCoefficient::find($data->property_condition_id));
        $project->ceilingHeight()->associate(CeilingHeightCoefficient::find($data->ceiling_height_id));
        $project->status()->associate(ActiveStatus::first());
        $project->user()->associate($this->user);
        
        $project->components = $data->components ?? $data->rooms;

        $project->save();

        return $project;
    }

}
