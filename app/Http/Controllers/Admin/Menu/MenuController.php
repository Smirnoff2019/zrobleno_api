<?php

namespace App\Http\Controllers\Admin\Menu;

use App\Http\Controllers\Admin\Controller;
use App\Models\Post\MenuPost;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class MenuController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @param MenuPost $menu
     * @param array $routes
     * @param array $layouts
     */
    public function __construct(MenuPost $menu, array $routes, array $layouts)
    {
        $this->model = $menu;

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
        return view(
            $this->layouts->index, [
                'records' => $this->model::get()
            ]
        );
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

        $menu = $this->model->create($request->all());

        return redirect()
            ->route($this->routes->edit, $menu->id)
            ->with('success', $this->successCreateMessage);

    }

    /**
     * Display the specified resource.
     *
     * @method GET
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($id): \Illuminate\Http\RedirectResponse
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @method GET
     * @param MenuPost $menu
     * @return Application|Factory|Response|View
     */
    public function edit(MenuPost $menu)
    {
        return view($this->layouts->edit, [
            'records'        => $this->model::get(),
            'current_record' => $menu,
            'update_url'     => route($this->routes->update, $menu->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param \Illuminate\Http\Request $request
     * @param MenuPost $menu
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, MenuPost $menu): \Illuminate\Http\RedirectResponse
    {

        $menu->update($request->all());

        return redirect()
            ->route($this->routes->index)
            ->with(
                'success',
                $this->successUpdateMessage
            )->withInput();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param MenuPost $menu
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(MenuPost $menu): \Illuminate\Http\RedirectResponse
    {

        $menu->delete($menu);

        return redirect()
            ->route($this->routes->index)
            ->with('success', $this->successDeleteMessage);

    }

}
