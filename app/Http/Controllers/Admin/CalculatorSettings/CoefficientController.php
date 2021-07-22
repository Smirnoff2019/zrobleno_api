<?php

namespace App\Http\Controllers\Admin\CalculatorSettings;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Models\CalculatorOption\Coefficient;

class CoefficientController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(Coefficient $coefficient, array $routes, array $layouts)
    {
        $this->model = $coefficient;
        
        $this->routes = (object) $routes;
        $this->layouts = (object) $layouts;
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->layouts->index, ['records' => $this->model::get()]);
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
        $coefficient = $this->model->create($request->all());
        return redirect()
            ->route($this->routes->edit, $coefficient->id)    
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
    public function edit(Request $request, Coefficient $coefficient)
    {
        return view($this->layouts->edit, [
            'records'        => $this->model::get(),
            'current_record' => $coefficient,
            'update_url'     => route($this->routes->update, $coefficient->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coefficient $coefficient)
    {
        $coefficient->update($request->all());
        
        return back()->with('success', $this->successUpdateMessage)->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coefficient $coefficient)
    {   
        $coefficient->delete($coefficient);

        return redirect()
            ->route($this->routes->index)
            ->with('success', $this->successDeleteMessage);
    }

}

