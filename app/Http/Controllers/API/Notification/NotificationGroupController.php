<?php

namespace App\Http\Controllers\Api\Notification;

use App\Http\Controllers\ApiController;
use App\Repositories\Eloquent\Notification\Interfaces\NotificationGroupRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class NotificationGroupController extends ApiController
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, NotificationGroupRepositoryInterface $notificationGroupRepository)
    {
//        $this->middleware('auth:api');
        $this->repository = $notificationGroupRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->collection(
            $this->repository->all()
        );
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
    public function show($slug)
    {

        try {
            return $this->resource($this->repository->find($slug));
        } catch (ModelNotFoundException $e) {
            return $this->notFound("No room with this Slug Group found!");
        }

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

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
