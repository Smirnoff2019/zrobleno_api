<?php

namespace App\Http\Controllers\Admin\Widget;

use App\Http\Controllers\Admin\Controller;
use App\Models\Post\WidgetPost;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class WidgetController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @param WidgetPost $widget
     * @param array $routes
     * @param array $layouts
     */
    public function __construct(WidgetPost $widget, array $routes, array $layouts)
    {
        $this->model = $widget;

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
        return view($this->layouts->index, ['records' => $this->model::get()]);
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

        $widget = $this->model->create($request->all());

        return redirect()
            ->route($this->routes->edit, $widget->id)
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
     * @param WidgetPost $widget
     * @return Application|Factory|Response|View
     */
    public function edit(WidgetPost $widget)
    {
        return view($this->layouts->edit, [
            'records'        => $this->model::get(),
            'current_record' => $widget,
            'update_url'     => route($this->routes->update, $widget->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param \Illuminate\Http\Request $request
     * @param WidgetPost $widget
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, WidgetPost $widget): \Illuminate\Http\RedirectResponse
    {

        $widget->update($request->all());

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
     * @param WidgetPost $widget
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(WidgetPost $widget): \Illuminate\Http\RedirectResponse
    {

        $widget->delete($widget);

        return redirect()
            ->route($this->routes->index)
            ->with('success', $this->successDeleteMessage);

    }

}
