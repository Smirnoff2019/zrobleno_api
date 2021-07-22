<?php

namespace App\Http\Controllers\Admin\Option;

use App\Filters\OptionFilter;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Models\Option\Option;

class OptionController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(Option $option, array $routes, array $layouts)
    {
        $this->model = $option->with([
            'status',
            'image.file',
            'status',
            'optionsGroup',
            'room'
        ]);
        
        $this->routes = (object) $routes;
        $this->layouts = (object) $layouts;
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, OptionFilter $filter)
    {
        return view($this->layouts->index, [
            'records' => $this->model->filter($filter)->paginate( $this->perPageCount($request) )
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @method GET
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $option = $this->model->create($request->all());

        $option->display = (int) $request->has('display');
        $option->default = (int) $request->has('default');
        $option->middlewares = [
            'door' => (bool) $request->has('middlewares.door'),
        ];
        $option->save();

        return redirect()
            ->route($this->routes->edit, $option->id)    
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Option $option)
    {
        return view($this->layouts->edit, ['record' => $option]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Option $option)
    {
        $option->update($request->all());
        $option->display = (int) $request->has('display');
        $option->default = (int) $request->has('default');
        $option->middlewares = (bool) $request->has('middlewares.door');
        $option->middlewares = [
            'door' => (bool) $request->has('middlewares.door'),
        ];
        $option->save();

        return back()
            ->with('success', $this->successUpdateMessage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Option $option)
    {   
        $option->delete($option);
        
        return redirect()
            ->route($this->routes->index)
            ->with('success', $this->successDeleteMessage);
    }

}

