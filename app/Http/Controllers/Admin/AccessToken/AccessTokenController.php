<?php

namespace App\Http\Controllers\Admin\AccessToken;

use App\Http\Controllers\Admin\Controller;
use App\Models\AccessToken\AccessToken;
use App\Models\Complaint\Complaint;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AccessTokenController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @param AccessToken $accessToken
     * @param array $routes
     * @param array $layouts
     */
    public function __construct(AccessToken $accessToken, array $routes, array $layouts)
    {
        $this->model = $accessToken;

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

        $records = $this->model->paginate(50);

        return view($this->layouts->index, ['records' => $records]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @method GET
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $this->model->create([
            'group' => 'params_access_token_for_contractor',
            'token' => md5(Str::random(16)),
            'active' => true
        ]);

        return redirect()
            ->route($this->routes->index)
            ->with('success', $this->successCreateMessage);
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
//        $this->model->create($request->all());
//
//        return redirect()
//            ->route($this->routes->index)
//            ->with('success', $this->successCreateMessage);
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
     * @param AccessToken $accessToken
     * @return Application|Factory|Response|View
     */
    public function edit(AccessToken $accessToken)
    {
        //return view($this->layouts->edit, ['record' => $accessToken]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param \Illuminate\Http\Request $request
     * @param AccessToken $accessToken
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, AccessToken $accessToken): \Illuminate\Http\RedirectResponse
    {

//        $accessToken->update($request->all());
//
//        return redirect()
//            ->route($this->routes->index)
//            ->with('success', $this->successUpdateMessage)
//            ->withInput();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param AccessToken $accessToken
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(AccessToken $accessToken): \Illuminate\Http\RedirectResponse
    {

        $accessToken->delete($accessToken);

        return redirect()
            ->route($this->routes->index)
            ->with('success', $this->successDeleteMessage);

    }

}
