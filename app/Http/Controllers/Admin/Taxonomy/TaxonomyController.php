<?php

namespace App\Http\Controllers\Admin\Taxonomy;

use App\Http\Controllers\Admin\Controller;
use App\Models\Taxonomy\Taxonomy;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class TaxonomyController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @param Taxonomy $taxonomy
     * @param array $routes
     * @param array $layouts
     */
    public function __construct(Taxonomy $taxonomy, array $routes, array $layouts)
    {
        $this->model = $taxonomy;

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
        $records = $this->model->paginate(50);

        return view($this->layouts->index, ['records' => $records]);
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
        $taxonomy = $this->model->create($request->all());

        return redirect()
            ->route($this->routes->edit, $taxonomy->id)
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
     * @param Request $request
     * @param Taxonomy $taxonomy
     * @return Application|Factory|Response|View
     */
    public function edit(Request $request, Taxonomy $taxonomy)
    {
        return view($this->layouts->edit, ['record' => $taxonomy]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param \Illuminate\Http\Request $request
     * @param Taxonomy $taxonomy
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Taxonomy $taxonomy)
    {
        $taxonomy->update($request->all());

        return back()
            ->with('success', $this->successUpdateMessage)
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param Taxonomy $taxonomy
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Taxonomy $taxonomy)
    {
        $taxonomy->delete($taxonomy);

        return redirect()
            ->route($this->routes->index)
            ->with('success', $this->successDeleteMessage);
    }

}