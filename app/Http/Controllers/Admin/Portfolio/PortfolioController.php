<?php

namespace App\Http\Controllers\Admin\Portfolio;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Models\Category\Category;
use App\Models\Category\PortfolioCategory;
use App\Models\Post\PortfolioPost;
use App\Models\PostType\PortfolioPostType;
use App\Models\PostType\PostType;
use App\Models\Taxonomy\PortfolioCategoryTaxonomy;
use App\Models\Taxonomy\PortfolioTaxonomy;
use App\Models\Taxonomy\Taxonomy;
use Illuminate\Database\Eloquent\Builder;

class PortfolioController extends Controller
{

    /**
     * The resource route names prefix
     *
     * @var string
     */
    protected $routeNamePrefix = 'portfolios';

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(PortfolioPost $portfolio, array $routes, array $layouts)
    {
        $this->model = $portfolio;

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
        if($request->filled('category_id')) {
            $query = $query->whereHas('categories', function (Builder $query) use($request) {
                return $query->where('category_id', $request->get('category_id'));
            });
        }
        $records = $query->latest()->paginate(50);
        
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
        $metaFieldsGroups = PostType::portfolio()->first()->metaFieldsGroups()->with(['fields' => function($query) {
            return $query->whereNull('parent_id');
        }])->get();
        
        return view($this->layouts->create, [
            'meta_fields_groups' => $metaFieldsGroups
        ]);
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
        // dd($request->all());
        
        $portfolio = $this->model->create($request->all());

        if($request->get('categories', null)) {
            $portfolio->categories()->sync($request->categories);
        }

        if($request->get('meta_fields', null)) {
            $portfolio->meta()->sync(collect($request->get('meta_fields', []))->mapWithKeys(function($value, $id) {
                if(is_array($value)) {
                    $value = json_encode($value);
                }
                
                return [ $id => [
                    'action' => 'storage',
                    'value' => $value
                ]];
            })->all());
        }

        return redirect()
            ->route($this->routes->edit, $portfolio->id)    
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
    public function edit(Request $request, PortfolioPost $portfolio)
    {
        return view($this->layouts->edit, ['record' => $portfolio->load(['meta', 'metaStorage'])]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PortfolioPost $portfolio)
    {
        // dd($request->all());
        
        $portfolio->update($request->all());
        
        if($request->get('categories', null)) {
            $portfolio->categories()->sync($request->categories);
        }

        if($request->get('meta_fields', null)) {
            $portfolio->meta()->sync(collect($request->get('meta_fields', []))->mapWithKeys(function($value, $id) {
                if(is_array($value)) {
                    $value = json_encode($value);
                }

                return [ $id => [
                    'action' => 'storage',
                    'value' => $value
                ]];
            })->all());
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
    public function destroy(PortfolioPost $portfolio)
    {   
        $portfolio->delete($portfolio);
        return redirect()
            ->route($this->routes->index)
            ->with('success', $this->successDeleteMessage);
    }

}

