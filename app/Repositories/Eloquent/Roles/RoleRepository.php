<?php

namespace App\Repositories\Eloquent\Roles;

use App\Models\PermissionRole\PermissionRole;
use App\Models\Role\Role;
use App\Schemes\PermissionRole\PermissionRoleSchema;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\Roles\Interfaces\RoleRepositoryInterface;
use App\Repositories\Kernel\Repository;

class RoleRepository extends Repository implements RoleRepositoryInterface
{
    protected $with = [
        'permissions'
    ];
    /**
     * Create a new repository instance.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    /**
     * Get all of the models from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function all()
    {
        return $this->model->with($this->with)->get();
    }

    /**
     * Get all of the models pagination from the database.
     *
     * @param  int $perPage
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function allPagination(int $perPage = null)
    {
        //
    }

    /**
     * Find a model by its primary key or throw an exception.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static|static[]
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find(int $id)
    {
        //
    }

    /**
     * Save a new model and return the instance.
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Update a record by its primary key in the database or throw an exception.
     *
     * @param  int $id
     * @param  Illuminate\Http\Request $request
     * @return int|bool
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function update(int $id, Request $request)
    {
        $this->model->find($id)->permissions()->detach();
        $this->model->find($id)->permissions()->attach($request->permissions);
//        collect($request->permissions)->map(function ($item) use ($id){
//            PermissionRole::create([PermissionRoleSchema::COLUMN_ROLE_ID => $id , PermissionRoleSchema::COLUMN_PERMISSION_ID => $item]);
//        });
    }

    /**
     * Delete a record by its primary key from the database or throw an exception.
     *
     * @param  int  $id
     * @return bool
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function destroy(int $id)
    {
        //
    }

}
