<?php

namespace App\Http\Controllers\Admin\Notification;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Models\Room\Room;
use App\Repositories\Eloquent\Notification\Interfaces\NotificationRepositoryInterface;

class NotificationController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(NotificationRepositoryInterface $notificationRepository, array $routes, array $layouts)
    {
        $this->model = $notificationRepository;

        $this->routes = (object) $routes;
        $this->layouts = (object) $layouts;
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view($this->layouts->index, [
            'records' => $request->user()
                ->notifications()
                ->latest()
                ->paginate($request->get('per_page') ?? $this->perPage)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @method POST
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function read(Request $request, $id)
    {
        $this->model->update($id, $request);
        
        return back()->with('success', $this->successUpdateMessage)->withInput();
    }

}

