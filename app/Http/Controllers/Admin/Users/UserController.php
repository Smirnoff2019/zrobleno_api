<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Admin\Controller;
use App\Models\Portfolio\Portfolio;
use App\Models\PortfolioImage\PortfolioImage;
use App\Models\User\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class UserController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @param User $user
     * @param array $routes
     * @param array $layouts
     */
    public function __construct(User $user, array $routes, array $layouts)
    {
        $this->model = $user->with('portfolios.images');

        $this->routes = (object) $routes;
        $this->layouts = (object) $layouts;
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @param Request $request
     * @return Application|Factory|Response|View
     */
    public function index(Request $request)
    {

        $query = $this->model;
        if($request->filled('role_id')) {
            $query = $query->whereHas('role', function (Builder $query) use($request) {
                return $query->where('role_id', $request->get('role_id'));
            });
        }
        $records = $query->latest()->paginate(50);

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
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @method POST
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, User $user): \Illuminate\Http\RedirectResponse
    {
        return back();
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
     * @param User $user
     * @return Application|Factory|Response|View
     */
    public function edit(User $user)
    {
        return view($this->layouts->edit, ['record' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user): \Illuminate\Http\RedirectResponse
    {
        $user->update($request->only([
            User::COLUMN_LAST_NAME,
            User::COLUMN_FIRST_NAME,
            User::COLUMN_MIDDLE_NAME,
            User::COLUMN_PHONE,
            User::COLUMN_EMAIL,
            User::COLUMN_ROLE_ID,
            User::COLUMN_IMAGE_ID,
            User::COLUMN_STATUS_ID,
        ]));

        $portfolios = collect((array) $request->get('portfolios', []))->map(function($portfolio) use($user) {
            $portfolio = (object) $portfolio;

            $portf = $user->portfolios()->updateOrCreate(
                collect($portfolio)->only(['id'])->toArray(),
                collect($portfolio)->only([
                    'name', 
                    'slug', 
                    'total_area', 
                    'duration', 
                    'budget',
                    'image_id',
                    'status_id',
                ])->toArray()
            );

            $portf->images()->sync( collect($portfolio->images)->filter() );

            return $portf;
        });

        return back()->with('success', $this->successUpdateMessage)->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user): \Illuminate\Http\RedirectResponse
    {
        $user->delete($user);

        return redirect()
            ->route($this->routes->index)
            ->with('success', $this->successDeleteMessage);
    }

}
