<?php

namespace App\Http\Controllers\API\Notification;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Tender\Tender;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Eloquent\Notification\Interfaces\NotificationRepositoryInterface;

class NotificationController extends ApiController
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, NotificationRepositoryInterface $notificationRepository)
    {
        $this->middleware('auth:api');
        $this->request = $request;
        $this->notificationRepository = $notificationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->collection(
            $this->notificationRepository->allPagination($this->request)
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
    public function show($id)
    {

    }

    public function showTenderNotification(Request $request, $tender_id) {
        return $this->collection(
            $request->user()->notifications()
                ->where('data->reason', 'tender')
                ->where('data->reason_id', $tender_id)
                ->paginate($request->get('per_page') ?? 10)
        );
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
        $this->notificationRepository->update($id, $this->request);

        return  $this->successMessage('Successfully read', 200);
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

    public function showTendersNotification (Request $request) {
        return $this->collection($request->user()->notifications()
            ->where('data->reason', 'tender')
            ->where('data->reason_id', $request->tender_id)->paginate(2));


    }

}
