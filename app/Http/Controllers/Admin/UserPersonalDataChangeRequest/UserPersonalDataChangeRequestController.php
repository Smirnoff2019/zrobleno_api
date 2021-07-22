<?php

namespace App\Http\Controllers\Admin\UserPersonalDataChangeRequest;

use App\Models\Status\TenderApplication\ConfirmedStatus;
use App\Models\User\User;
use App\Models\UserLegalData\UserLegalData;
use App\Models\UserPersonalDataChangeRequests\UserPersonalDataChangeRequests;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Models\Status\TenderApplication\AwaitingConfirmationStatus;
use App\Models\Status\TenderApplication\CanceledStatus;
use Illuminate\Http\Response;
use Illuminate\View\View;

class UserPersonalDataChangeRequestController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @param UserPersonalDataChangeRequests $personal_data_request
     * @param array $routes
     * @param array $layouts
     */
    public function __construct(UserPersonalDataChangeRequests $personal_data_request, array $routes, array $layouts)
    {
        $this->model = $personal_data_request;
        
        $this->routes = (object) $routes;
        $this->layouts = (object) $layouts;
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @param Request $request
     * @return Application|Factory|Response|View
     */
    public function index(Request $request)
    {
//        $this->model->create([
//            'data' => [
//                'first_name'  => 'Tolya',
//                'middle_name' => 'Gooplin',
//                'last_name'   => 'Ramzanuch',
//                'phone' => '1122345456',
//                'email' => 'foo-556@gmail.com',
//            ],
//            'user_id' => User::find(36)->id,
//            'status_id' => AwaitingConfirmationStatus::first()->id,
//        ]);

        $query = $this->model;
        
        $query = $query->when(
                $request->filled('user_id'),
                function($query, $user_id) use($request) {
                    return $query->where('user_id', $request->get('user_id'));
                }
            )
            ->when(
                $request->filled('status_id'),
                function($query, $status_id) use($request) {
                    return $query->where('status_id', $request->get('status_id'));
                }
            )
            ->when(
                $request->filled('sort_by'),
                function($query,$sortBy) use($request) {
                    switch ($request->get('sort_by', '')) {
                        case 'latest':
                            $query = $query->latest();
                            break;

                        case 'oldest':
                            $query = $query->oldest();
                            break;
                        
                        default:
                            $query->latest();
                            break;
                    }
                }
            );

        $records = $query->paginate($request->get('per_page') ?? $this->perPage);

        return view($this->layouts->index, [
            'records' => $records
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
    public function store(Request $request)
    {
        $userData = $this->model->create($request->all());

        return redirect()
            ->route($this->routes->edit, $userData->id)    
            ->with('success', $this->successCreateMessage);
    }

    /**
     * Display the specified resource.
     *
     * @method GET
     * @param UserPersonalDataChangeRequests $personal_data_request
     * @return Application|Factory|\Illuminate\Http\RedirectResponse|View
     */
    public function show(UserPersonalDataChangeRequests $personal_data_request)
    {
        $legal = $personal_data_request->user->legalData;
//        $legal_request = (object) $personal_data_request['data']['legal_data'];
//        dd($legal_request);
        //$personal_data_request->user->legalData;
        return view($this->layouts->edit, [
            'record' => $personal_data_request,
            'data' => (object)$personal_data_request->data,
            'legal' => (object)$legal,
            //'legal_request' => $legal_request
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @method GET
     * @param UserPersonalDataChangeRequests $personal_data_request
     * @return Application|Factory|Response|View
     */
    public function edit(UserPersonalDataChangeRequests $personal_data_request)
    {
        $legal = $personal_data_request->user->legalData;
        $legal_request = (object)$personal_data_request['data']['legal_data'];
        //dd($legal_request);

        return view($this->layouts->edit, [
            'record' => $personal_data_request,
            'data' => (object)$personal_data_request->data,
            'legal' => (object)$legal,
            'legal_request' => $legal_request
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param \Illuminate\Http\Request $request
     * @param UserPersonalDataChangeRequests $personal_data_request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, UserPersonalDataChangeRequests $personal_data_request): \Illuminate\Http\RedirectResponse
    {
        //$personal_data_request->update($request->all());

        return redirect()
            ->route($this->routes->index);
    }

    /**
     * Update the specified resource in storage.
     *
     * @method POST
     * @param int $personal_data_request_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirm(int $personal_data_request_id)
    {
        $personal_data_request = $this->model->findOrFail($personal_data_request_id);

        $personal_data_request->update([
            'status_id' => ConfirmedStatus::first()->id
        ]);

        $data = (object)$personal_data_request->data;

        $personal_data_request->user()->update([
            'first_name'  => $data->first_name,
            'middle_name' => $data->middle_name,
            'last_name'   => $data->last_name,
            'phone'       => $data->phone,
            'email'       => $data->email,
        ]);

        return back()
            ->with('success', $this->successUpdateMessage);
    }

    /**
     * Update the specified resource in storage.
     *
     * @method POST
     * @param int $personal_data_request_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reject(int $personal_data_request_id)
    {
        $personal_data_request = $this->model->findOrFail($personal_data_request_id);

        $personal_data_request->update([
            'status_id' => CanceledStatus::first()->id
        ]);

        return back()
            ->with('success', $this->successUpdateMessage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param UserPersonalDataChangeRequests $personal_data_request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(UserPersonalDataChangeRequests $personal_data_request)
    {
        $personal_data_request->delete($personal_data_request);
        
        return redirect()
            ->route($this->routes->index)
            ->with('success', $this->successDeleteMessage);
    }

}
