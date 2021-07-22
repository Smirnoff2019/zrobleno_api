<?php

namespace App\Http\Controllers\API\Project;

use Illuminate\Http\Request;
use App\Models\Project\Project;
use App\Jobs\Project\ProjectCreate;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Project\ProjectResource;
use App\Http\Requests\Api\Project\ProjectRequest;
use App\Http\Requests\Api\Project\ProjectUpdateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\Project\ProjectResourceCollection;
use App\Jobs\Tender\TenderCreate;
use App\Jobs\User\CreateCustomer;
use App\Models\User\Customer\Customer;
use App\Models\User\User;

class ProjectController extends ApiController
{

    /**
     * The repository resource model namespace.
     *
     * @var string
     */
    protected $resourceName = ProjectResource::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var string
     */
    protected $resourceCollectionName = ProjectResourceCollection::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var \App\Models\Project\Project
     */
    protected $model;

    /**
     * Instantiate a new controller instance.
     *
     * @param \App\Repositories\Eloquent\Tender\Interfaces\TenderRepositoryInterface $tender
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->model = $project;
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->collection(
            $this->model
                ->latest()
                ->paginate($this->perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @method POST
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Customer $customer)
    {       
        $customer = $customer->where('phone', $request->get('phone'))
            ->orWhere('email', $request->get('email'))
            ->firstOrFail();

        $project = ProjectCreate::dispatchNow(
            $request->only([
                'walls_condition_id',
                'region_id',
                'property_condition_id',
                'ceiling_height_id',
                'city',
                'address',
                'total_area',
                'total_price',
                'rooms',
            ]), 
            $customer
        );

        $tender = TenderCreate::dispatchNow(
            $request->only(['max_participants']), 
            $project,
            $customer
        );

        return $this->successMessage('Project successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @method GET
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return $this->resource(
            $project
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $project_id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectUpdateRequest $request, Project $project)
    {
            return $this->success(
                [
                    'update' => $project->update($request->only([
                        'city',
                        'status_id',
                    ])),
                    'project' => $this->resource($project->refresh())
                ],
                'Project data was successfully updated!'
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param  int  $project_id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Project $project)
    {
        return $project->delete()
            ? $this->successMessage('Project was successfully deleted from database!')
            : $this->error();
    }

}
