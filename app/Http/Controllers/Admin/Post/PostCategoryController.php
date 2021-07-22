<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Admin\Controller;
use App\Models\Category\BlogCategory;
use App\Models\Category\Category;
use App\Models\PostType\PostPostType;
use App\Models\Taxonomy\BlogCategoryTaxonomy;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PostCategoryController extends Controller
{

    /**
     * The resource route names prefix
     *
     * @var string
     */
    protected $routeNamePrefix = 'posts.categories';

    /**
     * Instantiate a new controller instance.
     *
     * @param BlogCategory $category
     * @param array $routes
     * @param array $layouts
     */
    public function __construct(BlogCategory $category, array $routes, array $layouts)
    {
        $taxonomy = BlogCategoryTaxonomy::firstOr(function() {
            $taxonomy = factory(BlogCategoryTaxonomy::class)->create();
            PostPostType::first()->taxonomies()->save($taxonomy);
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
     * @return Application|Factory|Response|View
     */
    public function index()
    {

        $query = $this->model;
        $records = $query->whereNull(BlogCategory::COLUMN_PARENT_ID)
            ->latest()
            ->paginate(50);

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
    public function store(Request $request): \Illuminate\Http\RedirectResponse
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
     * @param BlogCategory $category
     * @return Application|Factory|Response|View
     */
    public function edit(Request $request, BlogCategory $category)
    {
        return view($this->layouts->edit, ['record' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param \Illuminate\Http\Request $request
     * @param BlogCategory $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, BlogCategory $category)
    {
        $category->update($request->all());

        if($request->get('categories', null)) {
            $category->children()->sync($request->categories);
        }

        return redirect()
            ->route($this->routes->index)
            ->with('success', $this->successUpdateMessage)
            ->withInput();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Category $category)
    {

        $category->delete($category);

        return redirect()
            ->route($this->routes->index)
            ->with('success', $this->successDeleteMessage);

    }

}
