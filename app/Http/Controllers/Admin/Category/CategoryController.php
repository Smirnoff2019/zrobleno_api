<?php

namespace App\Http\Controllers\Admin\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Models\Category\Category;

class CategoryController extends Controller
{

    /**
     * The resource route names prefix
     *
     * @var string
     */
    protected $routeNamePrefix = 'categories';

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(Category $category, array $routes, array $layouts)
    {
        $this->model = $category;

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
        $records = $this->model->whereNull('parent_id')->with('children')->paginate(50);
        
        return view($this->layouts->index, ['records' => $records]);
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
        $room = $this->model->create($request->all());

        return redirect()
            ->route($this->routes->edit, $room->id)    
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
    public function edit(Request $request, Category $category)
    {
        return view($this->layouts->edit, ['record' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        
        return back()->with('success', $this->successUpdateMessage)->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {   
        $category->delete($category);
        return redirect()
            ->route($this->routes->index)
            ->with('success', $this->successDeleteMessage);
    }

}
