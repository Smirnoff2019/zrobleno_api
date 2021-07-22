<?php

namespace App\Http\Controllers\API\User;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserResourceCollection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Eloquent\User\Interfaces\UserRepositoryInterface;

class UserController extends ApiController
{

    /**
     * The repository resource model namespace.
     *
     * @var App\Http\Resources\User\UserResource
     */
    protected $resourceName = UserResource::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var \App\Http\Resources\User\UserResourceCollection
     */
    protected $resourceCollectionName = UserResourceCollection::class;

    /**
     * Instantiate a new controller instance.
     *
     * @param \App\Repositories\Eloquent\User\Interfaces\UserRepositoryInterface $userRepository
     * 
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->middleware('auth:api');
        $this->repository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->collection(
            $this->repository->allPagination()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @method POST
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->resource(
            $this->repository->create($request)
        );
    }

    /**
     * Display the specified resource.
     *
     * @method GET
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $id)
    {
        try {
            return $this->resource(
                $this->repository->find($id)
            );
        } catch (ModelNotFoundException $e) {
            return $this->notFound("No user with this ID found!");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        try {
            return $this->success(
                [
                    'update' => $this->repository->update($id, $request),
                    'user' => $this->repository->find($id)
                ],
                'User data was successfully updated!'
            );
        } catch(ModelNotFoundException $e) {
            return $this->notFound("No user with this ID found!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        try {
            return $this->repository->destroy($id)
                ? $this->successMessage('User was successfully deleted from database!')
                : $this->error();
        } catch (ModelNotFoundException $e) {
            return $this->notFound("No user with this ID found!");
        }
    }

    /**
     * Return authorized user.
     *
     * @method <GET>
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function getMe(Request $request)
    {
        try {
            return $this->resource(
                $request->user()
            );
        } catch (ModelNotFoundException $e) {
            return $this->notFound("User is not found!");
        }
    }

}
