<?php

namespace App\Http\Controllers\Admin\Portfolio;

use App\Http\Controllers\Admin\Controller;
use App\Models\Portfolio\Portfolio;
use App\Models\User\Contractor\Contractor;
use App\Models\User\Contractor\PortfolioContractor;
use App\Models\User\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PortfolioContractorController extends Controller
{

    /**
     * The resource route names prefix
     *
     * @var string
     */
    protected $routeNamePrefix = 'users.contractors.portfolios';

    /**
     * Instantiate a new controller instance.
     *
     * @param Portfolio $portfolio
     * @param array $routes
     * @param array $layouts
     */
    public function __construct(User $user, array $routes, array $layouts)
    {
        $this->model = $user->whereRoleId('name', 'contractor')->with('portfolios');

        $this->routes = (object) $routes;
        $this->layouts = (object) $layouts;
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        /** @noinspection ForgottenDebugOutputInspection */
        //dd($this->model);
        $records = $this->model->paginate(50);
        //dd($records);

        return view($this->layouts->index, ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @method GET
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        //return view($this->layouts->create);
        return redirect()
            ->route($this->routes->index);
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
     * @param Contractor $contractor
     * @return Application|Factory|Response|View
     */
    public function edit(Contractor $contractor)
    {

        return view($this->layouts->edit, ['record' => $this->model]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {

        $this->model->update($request->all());

        return redirect()
            ->route($this->routes->index)
            ->with('success', $this->successUpdateMessage)
            ->withInput();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(): \Illuminate\Http\RedirectResponse
    {

        $this->model->delete($this->model);

        return redirect()
            ->route($this->routes->index)
            ->with('success', $this->successDeleteMessage);

    }

}
