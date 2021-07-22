<?php

namespace App\Repositories\Eloquent\Room\Interfaces;

use Illuminate\Http\Request;
use App\Repositories\Kernel\RepositoryInterface;

interface RoomRepositoryInterface extends RepositoryInterface
{
    
    /**
     * Get all of the models from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\Room\Room[]
     */
    public function all();

    /**
     * Get all of the models pagination from the database.
     *
     * @param  int $perPage
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\Room\Room[]
     */
    public function allPagination(int $perPage = null);

    /**
     * Find a model by its primary key or throw an exception.
     *
     * @param  int  $id
     * @return \App\Models\Room\Room|\Illuminate\Database\Eloquent\Collection|static|static[]
     * 
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find(int $id);

    /**
     * Save a new model and return the instance.
     *
     * @param  Illuminate\Http\Request $request
     * @return \App\Models\Room\Room
     */
    public function create(Request $request);

    /**
     * Update a record by its primary key in the database or throw an exception.
     *
     * @param  int $id
     * @param  Illuminate\Http\Request $request
     * @return int|bool
     * 
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function update(int $id, Request $request);

    /**
     * Delete a record by its primary key from the database or throw an exception.
     *
     * @param  int  $id
     * @return bool
     * 
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function destroy(int $id);

}
