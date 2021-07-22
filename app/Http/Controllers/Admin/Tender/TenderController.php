<?php

namespace App\Http\Controllers\Admin\Tender;

use App\Filters\TenderFilter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Status\Status;
use App\Models\Tender\Tender;
use App\Jobs\Tender\TenderCreate;
use App\Jobs\Tender\ProjectCreate;
use App\Models\Status\CommonStatus;
use App\Models\Status\TenderStatus;
use App\Services\ProjectCreateService;
use App\Http\Controllers\Admin\Controller;
use App\Models\CalculatorOption\CoefficientPerRegion;
use App\Models\CalculatorOption\CeilingHeightCoefficient;
use App\Jobs\Project\ProjectCreate as ProjectProjectCreate;
use App\Models\CalculatorOption\PropertyConditionCoefficient;
use App\Models\CalculatorOption\PropertyWallsConditionCoefficient;

class TenderController extends Controller
{

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
        Tender $tender,
        array $routes,
        array $layouts
    ) {
        $this->model = $tender->with([
            'user',
            'customer',
            'status',
        ])->withCount(['participants']);

        $this->routes  = (object) $routes;
        $this->layouts = (object) $layouts;
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, TenderFilter $filter) 
    {
        $records = $this->model->filter($filter)->paginate( $this->perPageCount($request) );
            
        return view($this->layouts->index, [
            'records' => $records,
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
            'record' => $tender
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
    public function update(Request $request, Tender $tender)
    {
        $tender->update($request->all());

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

}
