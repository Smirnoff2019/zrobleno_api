<?php

namespace App\Repositories\Eloquent\User;

use App\Models\User\User;
use Illuminate\Http\Request;
use App\Repositories\Kernel\Repository;
use App\Repositories\Eloquent\User\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository extends Repository implements UserRepositoryInterface
{

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'image',
        'role',
        'account',
        'accounts',
        'status',
        'chatBotApp',
    ];

    /**
     * Create a new repository instance.
     *
     * @param \App\Models\User\User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    /**
     * Get all of the models from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\User\User[]
     */
    public function all()
    {
        return $this->model
            ->with($this->with)
            ->latest()
            ->all();
    }

    /**
     * Get all of the models pagination from the database.
     *
     * @param  int $perPage
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\User\User[]
     */
    public function allPagination(int $perPage = null)
    {
        return $this->model
            ->with($this->with)
            ->latest()
            ->paginate($perPage ?? $this->perPage);
    }

    /**
     * Find a model by its primary key or throw an exception.
     *
     * @param  int  $id
     * @return \App\Models\User\User|\Illuminate\Database\Eloquent\Collection|static|static[]
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find(int $id)
    {
        return $this->model
            ->findOrFail($id);
    }

    /**
     * Save a new model and return the instance.
     *
     * @param  Illuminate\Http\Request $request
     * @return \App\Models\User\User
     */
    public function create(Request $request)
    {
        $userData = $request->only($this->model->getFillable());
        $userData[User::COLUMN_PASSWORD] = $this->model->makeHashPassword($userData[User::COLUMN_PASSWORD]);

        return $this->model
            ->create($userData);
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
        return $this->model
            ->findOrFail($id)
            ->update($request->only($this->model->getFillable()));
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
        return $this->model
            ->findOrFail($id)
            ->delete();
    }

}
