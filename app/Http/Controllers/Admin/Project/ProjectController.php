<?php

namespace App\Http\Controllers\Admin\Project;

use App\Filters\ProjectFilter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Status\Status;
use App\Models\Project\Project;
use App\Jobs\Tender\TenderCreate;
use App\Jobs\Project\ProjectCreate;
use App\Models\Status\CommonStatus;
use App\Services\ProjectCreateService;
use App\Http\Controllers\Admin\Controller;
use App\Models\CalculatorOption\CoefficientPerRegion;
use App\Models\CalculatorOption\CeilingHeightCoefficient;
use App\Models\CalculatorOption\PropertyConditionCoefficient;
use App\Models\CalculatorOption\PropertyWallsConditionCoefficient;

class ProjectController extends Controller
{

    /**
     * Project model instance
     *
     * @param Project $model
     */
    public $model;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(
        Project $project,
        array $routes,
        array $layouts,
        CoefficientPerRegion $region,
        CeilingHeightCoefficient $ceiling_height,
        PropertyWallsConditionCoefficient $walls_condition,
        PropertyConditionCoefficient $property_condition,
        CommonStatus $status
    ) {
        $this->model = $project->with([
            'region',
            'ceilingHeight',
            'wallsCondition',
            'propertyCondition',
            'user',
            'status',
            'tenders',
        ]);

        $this->routes  = (object) $routes;
        $this->layouts = (object) $layouts;

        $this->region             = $region;
        $this->ceiling_height     = $ceiling_height;
        $this->walls_condition    = $walls_condition;
        $this->property_condition = $property_condition;
        $this->status             = $status;
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ProjectFilter $filter) 
    {
        $records = $this->model
            ->filter($filter)
            ->paginate($this->perPageCount($request));

        return view($this->layouts->index, [
            'records'             => $records,
            'regions'             => $this->region->all(),
            'ceiling_heights'     => $this->ceiling_height->all(),
            'walls_conditions'    => $this->walls_condition->all(),
            'property_conditions' => $this->property_condition->all(),
            'statuses'            => $this->status->all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @method GET
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $query = ProjectCreateService::make()->makeProjectData();
        
        return view($this->layouts->create, [
            'regions'               => $this->region->all(),
            'ceiling_heights'       => $this->ceiling_height->all(),
            'walls_conditions'      => $this->walls_condition->all(),
            'property_conditions'   => $this->property_condition->all(),
            'status'                => $this->status->all(),

            'region_id'             => $query->get('region_id'),
            'ceiling_height_id'     => $query->get('ceiling_height_id'),
            'walls_condition_id'    => $query->get('walls_condition_id'),
            'property_condition_id' => $query->get('property_condition_id'),
            'city'                  => $query->get('city'),
            'address'               => $query->get('address'),
            'components'            => $query->get('rooms'),
            'total_area'            => $query->get('total_area'),
            'total_price'           => $query->get('total_price'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @method POST
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = ProjectCreate::dispatchNow(
            $request->all(),
            $request->user()
        );

        $tender = TenderCreate::dispatchNow(
            ['max_participants' => rand(2, 8)],
            $project,
            $request->user()
        );

        return redirect()
            ->route($this->routes->edit, $project->id)
            ->with('success', $this->successCreateMessage);
    }

    /**
     * Display the specified resource.
     *
     * @method GET
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @method GET
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Project $project)
    {
        return view($this->layouts->edit, [
            'record'              => $project,
            'regions'             => $this->region->all(),
            'ceiling_heights'     => $this->ceiling_height->all(),
            'walls_conditions'    => $this->walls_condition->all(),
            'property_conditions' => $this->property_condition->all(),
            'status'              => $this->status->all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $project->update($request->all());

        return back()->with('success', $this->successUpdateMessage)->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()
            ->route($this->routes->index)
            ->with('success', $this->successDeleteMessage);
    }

}
