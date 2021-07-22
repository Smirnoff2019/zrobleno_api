<?php

namespace App\Http\Controllers\Admin\Complaint;

use App\Http\Controllers\Admin\Controller;
use App\Models\Complaint\Complaint;
use App\Models\ComplaintResponse\ComplaintResponse;
use App\Models\Status\Complaint\ProcessedStatus;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ComplaintController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @param Complaint $complaint
     * @param array $routes
     * @param array $layouts
     */
    public function __construct(Complaint $complaint, array $routes, array $layouts)
    {
        $this->model = $complaint;

        $this->routes = (object) $routes;
        $this->layouts = (object) $layouts;
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @return Application|Factory|Response|View
     */
    public function index()
    {

        $records = $this->model->whereDoesntHave('complaint')->paginate(50);

        return view($this->layouts->index, [
            'records' => $records,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @method GET
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view($this->layouts->create);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @method POST
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->model->create($request->all());

        return redirect()
            ->route($this->routes->index)
            ->with('success', $this->successCreateMessage);
    }

    /**
     * Display the specified resource.
     *
     * @method GET
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @method GET
     * @param Complaint $complaint
     * @return Application|Factory|Response|View
     */
    public function edit(Complaint $complaint)
    {
        return view($this->layouts->edit, [
            'records'        => $this->model::whereDoesntHave('complaint')->get(),
            'current_record' => $complaint,
            'update_url'     => route($this->routes->update, $complaint->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param \Illuminate\Http\Request $request
     * @param Complaint $complaint
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Complaint $complaint)
    {
        $answer = Complaint::create([
            Complaint::COLUMN_SUBJECT    => $complaint->subject,
            Complaint::COLUMN_MESSAGE    => $request->get('answer'),
            Complaint::COLUMN_USER_ID    => $request->user()->id,
            Complaint::COLUMN_STATUS_ID  => ProcessedStatus::first()->id,
        ]);


        ComplaintResponse::create([
            ComplaintResponse::COLUMN_COMPLAINT_ID => $complaint->id,
            ComplaintResponse::COLUMN_RESPONSE_ID  => $answer->id,
            ComplaintResponse::COLUMN_USER_ID      => $complaint->user->id,
        ]);

        $complaint->status()->associate(ProcessedStatus::first()->id)->save();
        // $complaint->push();
        //$complaint->update($request->all());

        return redirect()
            ->route($this->routes->index)
            ->with('success', $this->successUpdateMessage)
            ->withInput();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param Complaint $complaint
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Complaint $complaint)
    {

        $complaint->delete($complaint);

        return redirect()
            ->route($this->routes->index)
            ->with('success', $this->successDeleteMessage);

    }

}
