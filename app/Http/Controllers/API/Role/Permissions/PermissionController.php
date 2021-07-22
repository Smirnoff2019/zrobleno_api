<?php

namespace App\Http\Controllers\Api\Role\Permissions;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Repositories\Eloquent\Roles\Interfaces\RoleRepositoryInterface;

class PermissionController extends ApiController
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, RoleRepositoryInterface $roleRepository)
    {
        $this->middleware('auth:api');
        $this->request = $request;
        $this->repository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  $this->collesction($this->repository->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $role_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $role_id)
    {
        $this->repository->update($role_id, $request);
        return  $this->successMessage('Data succesfully updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

}
