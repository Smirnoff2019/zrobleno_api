<?php

namespace App\Http\Controllers\API\ProjectPropertyCondition;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\ProjectPropertyCondition\ProjectPropertyCondition;
use App\Http\Resources\ProjectPropertyCondition\ProjectPropertyConditionResource;
use App\Http\Requests\Api\ProjectPropertyCondition\ProjectPropertyConditionRequest;
use App\Http\Requests\Api\ProjectPropertyCondition\UpdateProjectPropertyConditionRequest;
use App\Http\Resources\ProjectPropertyCondition\ProjectPropertyConditionResourceCollection;

class ProjectPropertyConditionController extends ApiController
{

    /**
     * The repository resource model namespace.
     *
     * @var string
     */
    protected $resourceName = ProjectPropertyConditionResource::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var string
     */
    protected $resourceCollectionName = ProjectPropertyConditionResourceCollection::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var \App\Models\Project\Project
     */
    protected $model;

    /**
     * Instantiate a new controller instance.
     *
     * @param \App\Models\ProjectPropertyCondition\ProjectPropertyCondition $propertyCondition
     * @return void
     */
    public function __construct(ProjectPropertyCondition $propertyCondition)
    {
        $this->middleware('auth:api');
        $this->model = $propertyCondition;
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
                ->paginate($this->perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @method POST
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectPropertyConditionRequest $request)
    {       
        return $this->resource(
            factory(ProjectPropertyCondition::class)
                ->create($request->only([
                    ProjectPropertyCondition::COLUMN_NAME,
                    ProjectPropertyCondition::COLUMN_SLUG,
                    ProjectPropertyCondition::COLUMN_STATUS_ID,
                ]))
        );
    }

    /**
     * Display the specified resource.
     *
     * @method GET
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try {
            return $this->resource(
                $this->model
                    ->findOrFail($id)
            );
        } catch (ModelNotFoundException $e) {
            return $this->notFound("No project property condition with this ID found!");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectPropertyConditionRequest $request, int $id)
    {
        try {
            return $this->success(
                [
                    'update' => $this->model
                        ->find($id)
                        ->update($request->only([
                            ProjectPropertyCondition::COLUMN_NAME,
                            ProjectPropertyCondition::COLUMN_SLUG,
                            ProjectPropertyCondition::COLUMN_STATUS_ID,
                        ])),
                    'project_property_condition' => $this->resource($this->model->find($id))
                ],
                'Project property condition data was successfully updated!'
            );
        } catch (ModelNotFoundException $e) {
            return $this->notFound("No project property condition with this ID found!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        try {
            return $this->model->findOrFail($id)->delete()
                ? $this->successMessage('Project property condition was successfully deleted from database!')
                : $this->error();
        } catch (ModelNotFoundException $e) {
            return $this->notFound("No project property condition with this ID found!");
        }
    }

}
