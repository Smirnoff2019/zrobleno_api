<?php

namespace App\Http\Controllers\API\Supplier;

use Illuminate\Http\Request;
use App\Models\Supplier\Supplier;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Supplier\SupplierResource;
use App\Http\Requests\Api\Supplier\SupplierIndexRequest;
use App\Http\Requests\Api\Supplier\SupplierStoreRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Api\Supplier\SupplierUpdateRequest;
use App\Models\SupplierDiscount\CustomerSupplierDiscount;
use App\Http\Resources\Supplier\SupplierResourceCollection;
use App\Models\SupplierDiscount\ContractorSupplierDiscount;

class SupplierApiController extends ApiController
{

    /**
     * The repository resource model namespace.
     *
     * @var string
     */
    protected $resourceName = SupplierResource::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var string
     */
    protected $resourceCollectionName = SupplierResourceCollection::class;

    /**
     * Instantiate a new controller instance.
     *
     * @param Supplier $supplier
     * @return void
     */
    public function __construct(Supplier $supplier)
    {
        $this->middleware('auth:api');
        $this->model = $supplier->with([
            'supplierCategories',
            'status',
            // 'contractorsDiscount',
            // 'customersDiscount',
        ]);

        $this->notFoundMessage = "No supplier with this ID found!";
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @param  SupplierIndexRequest  $request
     * @return JsonResponse
     */
    public function index(SupplierIndexRequest $request)
    {
        return $this->collection(
            $this->model
                ->with([
                    'discount' => function($query) use($request) {
                        return $query->forUser($request->user());
                    },
                ])
                ->when(
                    $request->filled('categories'),
                    function($query) use($request) {
                        return $query->hasCategory($request->category);
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
                ->paginate($request->perPage ?? $this->perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @method POST
     * @param  SupplierStoreRequest $request
     * @return JsonResponse
     */
    public function store(SupplierStoreRequest $request)
    {
        $supplier = factory(Supplier::class)->create($request->only([
            'name',
            'description',
            'catalog_url',
            'image_id',
            'status_id',
        ]));

        if($request->filled('contractors_discount')) {
            $supplier->customersDiscount()->save(
                factory(ContractorSupplierDiscount::class)
                    ->create((array) collect($request->contractors_discount)->only([
                        'value',
                        'expirated_at',
                        'status_id',
                    ])->toArray())
            );
        }
        if($request->filled('customers_discount')) {
            $supplier->contractorsDiscount()->save(
                factory(CustomerSupplierDiscount::class)
                    ->create((array) collect($request->customers_discount)->only([
                        'value',
                        'expirated_at',
                        'status_id',
                    ])->toArray())
            );
        }

        if($request->filled('categories')) {
            $supplier->supplierCategories()->sync($request->categories);
        }

        return $this->resource($supplier->load([
                'discount' => function($query) use($request) {
                    return $query->forUser($request->user());
                },
            ])->refresh());
    }

    /**
     * Display the specified resource.
     *
     * @method GET
     * @param  Request $request
     * @param  int $supplier_id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $supplier_id)
    {
        try {
            return $this->resource(
                $this->model->with([
                    'discount' => function($query) use($request) {
                        return $query->forUser($request->user());
                    },
                ])->findOrFail($supplier_id)
            );
        } catch (ModelNotFoundException $e) {
            return $this->notFound($this->notFoundMessage);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param  SupplierUpdateRequest $request
     * @param  int $supplier_id
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierUpdateRequest $request, int $supplier_id)
    {
        try {
            $supplier = $this->model
                ->with([
                    'discount' => function($query) use($request) {
                        return $query->forUser($request->user());
                    },
                ])
                ->findOrFail($supplier_id);
                
            if($request->filled('customers_discount')) {
                $supplier->customersDiscount()
                    ->first()
                    ->update(collect((array) $request->customers_discount)->only([
                        'value',
                        'expirated_at',
                        'status_id',
                    ])
                    ->toArray());
            }
    
            if($request->filled('contractors_discount')) {
                $supplier->contractorsDiscount()
                    ->first()
                    ->update(collect((array) $request->contractors_discount)->only([
                        'value',
                        'expirated_at',
                        'status_id',
                    ])
                    ->toArray());
            }

            if($request->filled('categories')) {
                $supplier->supplierCategories()->sync($request->categories);
            }

            return $this->success(
                [
                    'update' => $supplier->update($request->only([
                        'name',
                        'description',
                        'catalog_url',
                        'image_id',
                        'status_id',
                    ])),
                    'supplier' => $this->resource($supplier->refresh())
                ],
                'Supplier data was successfully updated!'
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
    public function destroy(int $supplier_id)
    {
        try {
            $result = $this->model
                ->findOrFail($supplier_id)
                ->delete();

            return $result
                ? $this->success(
                    [
                        "supplier_id" => $supplier_id,
                        "destroyed" => $result
                    ],
                    'The supplier has been successfully deleted from the database!'
                )
                : $this->error();
        } catch (ModelNotFoundException $e) {
            return $this->notFound($this->notFoundMessage);
        }
    }

}
