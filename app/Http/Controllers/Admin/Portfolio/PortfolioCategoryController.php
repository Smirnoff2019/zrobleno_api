<?php

namespace App\Http\Controllers\Admin\Portfolio;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Models\Category\Category;
use App\Models\Category\PortfolioCategory;
use App\Models\Post\PortfolioPost;
use App\Models\PostType\PortfolioPostType;
use App\Models\Taxonomy\PortfolioCategoryTaxonomy;
use App\Models\Taxonomy\PortfolioTaxonomy;
use Illuminate\Database\Eloquent\Builder;

class PortfolioCategoryController extends Controller
{

    /**
     * The resource route names prefix
     *
     * @var string
     */
    protected $routeNamePrefix = 'portfolios.categories';

    /**
     * Instantiate a new controller instance.
     *
     * @param PortfolioCategory $category
     * @param array $routes
     * @param array $layouts
     */
    public function __construct(PortfolioCategory $category, array $routes, array $layouts)
    {
        $taxonomy = PortfolioCategoryTaxonomy::firstOr(function() {
            $taxonomy = factory(PortfolioCategoryTaxonomy::class)->create();
            PortfolioPostType::first()->taxonomies()->save($taxonomy);
            return $taxonomy;
        });

        $this->model = $category->with('children');
        $this->taxonomy = $taxonomy;

        $this->routes = (object) $routes;
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
        $query = $this->model;
        $records = $query->whereNull(PortfolioCategory::COLUMN_PARENT_ID)
                        ->latest()
                        ->paginate(50);
        
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
        $category = $this->model->create($request->all());
        $category->taxonomies()->save($this->taxonomy);

        return redirect()
            ->route($this->routes->edit, $category->id)    
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
    public function edit(Request $request, PortfolioCategory $category)
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
    public function update(Request $request, PortfolioCategory $category)
    {
        $category->update($request->all());
        
        if($request->get('categories', null)) {
            $category->children()->sync($request->categories);
        }
        
        return back()->with('success', $this->successUpdateMessage)->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PortfolioCategory $category)
    {   
        $category->delete($category);
        return redirect()
            ->route($this->routes->index)
            ->with('success', $this->successDeleteMessage);
    }

}

