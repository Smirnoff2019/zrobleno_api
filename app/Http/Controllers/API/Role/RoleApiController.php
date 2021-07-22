<?php

namespace App\Http\Controllers\API\Role;

use App\Models\Role\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Role\RoleResource;
use App\Http\Requests\Api\Role\RoleRequest;
use App\Http\Resources\Role\RoleResourceCollection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RoleApiController extends ApiController
{

    /**
     * The repository resource model namespace.
     *
     * @var string
     */
    protected $resourceName = RoleResource::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var string
     */
    protected $resourceCollectionName = RoleResourceCollection::class;

    /**
     * Instantiate a new controller instance.
     *
     * @param \App\Models\Role\Role $role
     * @return void
     */
    public function __construct(Role $role)
    {
        $this->middleware('auth:api');
        $this->model = $role->with([
            'image',
            'status'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @return \Illuminate\Http\JsonResponse
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
     * @return false
     */
    public function store()
    {
        return false;
    }

    /**
     * Display the specified resource.
     *
     * @method GET
     * @param  int  $role_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $role_id)
    {
        try {
            return $this->resource($this->model->findOrFail($role_id));
        } catch (ModelNotFoundException $e) {
            return $this->notFound("No role with this `id` was found!");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param  \App\Http\Requests\Api\Role\RoleRequest  $request
     * @param  int  $role_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RoleRequest $request, int $role_id)
    {
        try {
            $role = $this->model->findOrFail($role_id);
            $result = $role->update($request->only([
                'name',
                'description',
                'image_id',
                'status_id',
            ]));

            return $this->success(
                [
                    'update' => $result,
                    'role' => $this->resource($role->refresh())
                ],
                'Role data was successfully updated!'
            );
        } catch (ModelNotFoundException $e) {
            return $this->notFound("No role with this `id` was found!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @return false
     */
    public function destroy()
    {
        return false;
    }

}
