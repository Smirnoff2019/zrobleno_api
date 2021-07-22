<?php

namespace App\Http\Controllers\Admin\OptionsGroup;

use App\Filters\OptionsGroupFilter;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\UpdateOptionsGroupRequest;
use App\Models\OptionsGroup\OptionsGroup;

class OptionsGroupController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(OptionsGroup $group, array $routes, array $layouts)
    {
        $this->model = $group->with('image.file', 'room', 'status');
        
        $this->routes = (object) $routes;
        $this->layouts = (object) $layouts;
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, OptionsGroupFilter $filter)
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
    public function store(UpdateOptionsGroupRequest $request)
    {
        $group = $this->model->create($request->all());

        return redirect()
            ->route($this->routes->edit, $group->id)    
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
    public function edit(Request $request, OptionsGroup $group)
    {
        return view($this->layouts->edit, ['record' => $group]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOptionsGroupRequest $request, OptionsGroup $group)
    {
        $group->update($request->all());
        $group->display = (int) $request->has('display');
        $group->save();

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
    public function destroy(OptionsGroup $group)
    {   
        $group->delete($group);
        
        return redirect()
            ->route($this->routes->index)
            ->with('success', $this->successDeleteMessage);
    }

}

