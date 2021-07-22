<?php

namespace App\Http\Controllers\Admin\TenderApplication;

use App\Http\Controllers\Admin\Controller;
use App\Jobs\Project\ProjectCreate as ProjectProjectCreate;
use App\Jobs\Tender\ActivateTender;
use App\Jobs\Tender\ConfirmTenderApplication;
use App\Jobs\Tender\RejectTenderApplication;
use App\Jobs\Tender\ShareCustomerDataWithParticipants;
use App\Jobs\Tender\TenderCreate;
use App\Models\Status\TenderApplication\CanceledStatus;
use App\Models\Status\TenderApplication\ConfirmedStatus;
use App\Models\TenderApplication\TenderApplication;
use App\Models\Tender\Tender;
use App\Traits\Logs\Loger;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TenderApplicationController extends Controller
{

    use Loger;

    /**
     * Tender model instance
     *
     * @param Tender $model
     */
    public $model;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(
        TenderApplication $application,
        array $routes,
        array $layouts
    ) {
        $this->model = $application->with([
            'tender',
            'status',
        ])->has('tender');

        $this->routes  = (object) $routes;
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
        $query = $this->model
            ->where(array_filter($request->only([
                'status_id',
            ])))
            ->when($request->get('user_id'), function ($query, $user_id) {
                return $query->whereHas('tender', function (Builder $query) use($user_id) {
                    return $query->where('user_id', $user_id);
                });
            })
            ->when($request->get('uid'), function ($query, $uid) {
                $uid = intval((string) Str::of($uid)->replace('#', ''));

                return $query->whereHas('tender', function (Builder $query) use($uid) {
                    return $query->uidLike($uid);
                });
            })
            ->orderBy(
                $request->get('order_by', 'created_at') ?? 'created_at',
                $request->get('sort_by', 'desc') ?? 'desc'
            );

        $records = $query->paginate(50);

        return view($this->layouts->index, [
            'records' => $records,
            'confirmed_status' => ConfirmedStatus::first(),
            'canceled_status' => CanceledStatus::first()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @method GET
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view($this->layouts->create, []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @method POST
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = ProjectProjectCreate::dispatchNow(
            $request->all(),
            $request->user()
        );

        $tender = TenderCreate::dispatchNow(
            ['max_participants' => rand(2, 8)],
            $project,
            $request->user()
        );

        return redirect()
            ->route($this->routes->edit, $tender->id)
            ->with('success', $this->successCreateMessage);
    }

    /**
     * Display the specified resource.
     *
     * @method GET
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @method GET
     * @param  Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Tender $tender)
    {
        return view($this->layouts->edit, [
            'record' => $tender,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param  \Illuminate\Http\Request  $request
     * @param  Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TenderApplication $application)
    {
        $application->update($request->all());

        return back()->with('success', $this->successUpdateMessage)->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tender $tender)
    {
        $tender->delete();

        return redirect()
            ->route($this->routes->index)
            ->with('success', $this->successDeleteMessage);
    }
    
    /**
     * Reject tender application.
     *
     * @method POST
     * @param  \Illuminate\Http\Request  $request
     * @param  Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function reject(Request $request, TenderApplication $application)
    {
        RejectTenderApplication::dispatchNow($application->tender);

        return back()->with('success', $this->successUpdateMessage)->withInput();
    }
    
    /**
     * Reject tender application.
     *
     * @method POST
     * @param  \Illuminate\Http\Request  $request
     * @param  Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $request, TenderApplication $application)
    {
        ConfirmTenderApplication::dispatchNow($application->tender);

        ShareCustomerDataWithParticipants::dispatch($application->tender)
            ->delay(now()->addDay())
            ->onQueue('api-listeners');
            

        return back()->with('success', $this->successUpdateMessage)->withInput();
    }

}
