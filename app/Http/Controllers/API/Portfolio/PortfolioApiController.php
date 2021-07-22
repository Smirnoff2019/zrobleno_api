<?php

namespace App\Http\Controllers\API\Portfolio;

use App\Models\User\User;
use App\Models\Image\Image;
use Illuminate\Http\Request;
use App\Models\Status\Status;
use App\Models\Supplier\Supplier;
use Illuminate\Http\JsonResponse;
use App\Models\Portfolio\Portfolio;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Portfolio\PortfolioResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Api\Supplier\SupplierUpdateRequest;
use App\Http\Requests\Api\Portfolio\PortfolioIndexRequest;
use App\Http\Requests\Api\Portfolio\PortfolioStoreRequest;
use App\Http\Requests\Api\Portfolio\PortfolioUpdateRequest;
use App\Http\Resources\Portfolio\PortfolioResourceCollection;

class PortfolioApiController extends ApiController
{

    /**
     * The repository resource model namespace.
     *
     * @var string
     */
    protected $resourceName = PortfolioResource::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var string
     */
    protected $resourceCollectionName = PortfolioResourceCollection::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $modelFillable = [
        'name',
        'slug',
        'total_area',
        'duration',
        'budget',
    ];

    /**
     * Instantiate a new controller instance.
     *
     * @param Supplier $supplier
     * @return void
     */
    public function __construct(Portfolio $portfolio)
    {
        $this->middleware('auth:api');

        $this->relationsToLoad = [
            'cover',
            'images',
            'status',
            'user',
        ];

        $this->model = $portfolio->with($this->relationsToLoad);

        $this->notFoundMessage = "No supplier with this ID found!";
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @param  PortfolioIndexRequest  $request
     * @return JsonResponse
     */
    public function index(PortfolioIndexRequest $request, int $user_id)
    {
        return $this->collection(
            $this->model
                ->when(
                    $request->filled('slug'), 
                    function($query) use($request) {
                        return $query->where('slug', 'like', "%{$request->slug}%");
                    }
                )
                ->when(
                    $request->filled('name'), 
                    function($query) use($request) {
                        return $query->where('name', 'like', "%{$request->name}%");
                    }
                )
                ->when(
                    $request->filled('orderBy') && $request->filled('direction'), 
                    function($query) use($request) {
                        return $query->orderBy(
                            $request->orderBy,
                            $request->direction,
                        );
                    }
                )
                ->unless(
                    $request->filled('orderBy'), 
                    function($query) use($request) {
                        return $query->latest();
                    }
                )
                ->whereHas('user', function($query) use($user_id) {
                    return $query->whereId($user_id)->take(1);
                })
                ->paginate($request->perPage ?? $this->perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @method POST
     * @param  PortfolioStoreRequest $request
     * @param  int  $user_id
     * @return JsonResponse
     */
    public function store(PortfolioStoreRequest $request, int $user_id)
    {   
        $portfolio = $this->model
            ->create($request->only($this->modelFillable));

        User::find($user_id)->portfolios()->save($portfolio);
                
        if($request->filled('images')) {
            $portfolio->images()->sync((array) $request->images);
        }

        if($request->filled('cover')) {
            $portfolio->cover()->associate(Image::find($request->cover))->save();
        }

        return $this->resource(
            $portfolio->refresh()
        );
    }

    /**
     * Display the specified resource.
     *
     * @method GET
     * @param  int  $portfolio_id 
     * @return JsonResponse
     */
    public function show(int $portfolio_id)
    {
        try {
            return $this->resource(
                $this->model
                    ->findOrFail($portfolio_id)
            );
        } catch (ModelNotFoundException $e) {
            return $this->notFound($this->notFoundMessage);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param  SupplierUpdateRequest  $request
     * @param  int  $portfolio_id
     * @return \Illuminate\Http\Response
     */
    public function update(PortfolioUpdateRequest $request, int $portfolio_id)
    {
        try {
            $portfolio = $this->model
                ->findOrFail($portfolio_id);
                
            if($request->filled('status_id')) {
                $portfolio->cover()
                    ->associate(
                        Status::findOrFail( (int) $request->filled('status_id') )
                    )
                    ->save();
            }
    
            if($request->filled('images')) {
                $portfolio->images()->sync((array) $request->images);
            }

            if($request->filled('cover')) {
                $portfolio->cover()->associate($request->cover);
            }

            return $this->success(
                [
                    'update' => $portfolio->update($request->only($this->modelFillable)),
                    'portfolio' => $this->resource($portfolio->refresh())
                ],
                'Portfolio data was successfully updated!'
            );
        } catch (ModelNotFoundException $e) {
            return $this->notFound($this->notFoundMessage);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $portfolio_id)
    {
        try {
            $result = $this->model
                ->without($this->relationsToLoad)
                ->findOrFail($portfolio_id)
                ->delete();

            return $result
                ? $this->success(
                    [
                        "portfolio_id" => $portfolio_id,
                        "destroyed" => $result
                    ],
                    'The Portfolio has been successfully deleted from the database!'
                )
                : $this->error();
        } catch (ModelNotFoundException $e) {
            return $this->notFound($this->notFoundMessage);
        }
    }

}
