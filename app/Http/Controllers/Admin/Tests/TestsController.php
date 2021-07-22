<?php

namespace App\Http\Controllers\Admin\Tests;

use App\Http\Controllers\Admin\Controller;
use App\Jobs\Tests\SendNotify;
use App\Models\Taxonomy\Taxonomy;
use App\Models\User\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Faker\Factory as Faker;
use Illuminate\View\View;

class TestsController extends Controller
{

    /**
     * The faker instance
     *
     * @var Faker
     */
    public $faker;

    /**
     * Instantiate a new controller instance.
     *
     * @param Taxonomy $taxonomy
     * @param array $routes
     * @param array $layouts
     */
    public function __construct(array $routes, array $layouts)
    {
        $this->faker = Faker::create();

        $this->routes = (object) $routes;
        $this->layouts = (object) $layouts;
    }

    /**
     * Index method.
     *
     * @method GET
     * @return Application|Factory|Response|View
     */
    public function index(Request $request)
    {
        return view($this->layouts->index, [
            'faker' => $this->faker,
        ]);
    }

    /**
     * Queues method.
     *
     * @method POST
     * @return Application|Factory|Response|View
     */
    public function queues(Request $request)
    {
        SendNotify::dispatch(
            // $request->user(),
            User::find(3),
            $request->get('subject'),
            $request->get('message'),
        )->delay(now()->addMinutes( (int) $request->get('time') ?? 1))->onQueue('api-listeners');

        return back()->with('success', 'Успешно отправлено!');
    }

}