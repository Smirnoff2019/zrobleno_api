<?php

namespace App\Http\Controllers\Api\NotificationTemplate;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\NotificationTemplate\CreateRequest;
use App\Repositories\Eloquent\Notification\Interfaces\NotificationTemplateRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\NotificationTemplate\NotificationTemplate;

class NotificationTemplateController extends ApiController
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, NotificationTemplateRepositoryInterface $notificationTemplateRepository)
    {
//        $this->middleware('auth:api');
        $this->request = $request;
        $this->repository = $notificationTemplateRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
    public function store(CreateRequest $request)
    {
        return $this->resource(
            $this->repository->create($request)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(NotificationTemplate $notificationTemplate)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(NotificationTemplate $notificationTemplate)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        try {
            $this->repository->update($id, $request);
            return $this->resource($this->repository->find($id));
        } catch (ModelNotFoundException $e) {
            return $this->notFound("No template with this ID found!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotificationTemplate $notificationTemplate)
    {

    }

}
