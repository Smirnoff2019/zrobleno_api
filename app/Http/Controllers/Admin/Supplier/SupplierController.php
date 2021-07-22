<?php

namespace App\Http\Controllers\Admin\Supplier;

use App\Http\Controllers\Admin\Controller;
use App\Models\Supplier\Supplier;
use App\Models\SupplierDiscount\ContractorSupplierDiscount;
use App\Models\SupplierDiscount\CustomerSupplierDiscount;
use App\Models\SupplierDiscount\SupplierDiscount;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SupplierController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @param Supplier $supplier
     * @param array $routes
     * @param array $layouts
     */
    public function __construct(Supplier $supplier, array $routes, array $layouts)
    {
        $this->model = $supplier->with('contractorsDiscount', 'customersDiscount');

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
        $supplier = factory(Supplier::class)->create($request->only([
            Supplier::COLUMN_NAME,
            Supplier::COLUMN_DESCRIPTION,
            Supplier::COLUMN_CATALOG_URL,
            Supplier::COLUMN_IMAGE_ID,
            Supplier::COLUMN_STATUS_ID,
        ]));

        if($request->filled('contractors_discount')) {
            $supplier->contractorsDiscount()->save(
                factory(ContractorSupplierDiscount::class)
                    ->create((array) collect($request->contractors_discount)->only([
                        'value',
                        'expirated_at',
                        'status_id',
                    ])->toArray())
            );
        }
        if($request->filled('customers_discount')) {
            $supplier->customersDiscount()->save(
                factory(CustomerSupplierDiscount::class)
                    ->create((array) collect($request->customers_discount)->only([
                        'value',
                        'expirated_at',
                        'status_id',
                    ])->toArray())
            );
        }

        return redirect()
            ->route($this->routes->index)
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
     * @param Supplier $supplier
     * @return Application|Factory|Response|View
     */
    public function edit(Supplier $supplier)
    {
        return view($this->layouts->edit, ['record' => $supplier]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param \Illuminate\Http\Request $request
     * @param Supplier $supplier
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Supplier $supplier): \Illuminate\Http\RedirectResponse
    {

        $supplier->update($request->only([
            Supplier::COLUMN_NAME,
            Supplier::COLUMN_DESCRIPTION,
            Supplier::COLUMN_CATALOG_URL,
            Supplier::COLUMN_IMAGE_ID,
            Supplier::COLUMN_STATUS_ID,
        ]));

        if($request->get('contractorsDiscount')) {
            $supplier->contractorsDiscount()->update([
                SupplierDiscount::COLUMN_VALUE        => $request->get('contractorsDiscount')['value'],
                SupplierDiscount::COLUMN_EXPIRATED_AT => $request->get('contractorsDiscount')['expirated_at'],
                SupplierDiscount::COLUMN_STATUS_ID    => $request->get('contractorsDiscount')['status_id'],
            ]);
        }

        if($request->get('customersDiscount')) {
            $supplier->customersDiscount()->update([
                SupplierDiscount::COLUMN_VALUE        => $request->get('customersDiscount')['value'],
                SupplierDiscount::COLUMN_EXPIRATED_AT => $request->get('customersDiscount')['expirated_at'],
                SupplierDiscount::COLUMN_STATUS_ID    => $request->get('customersDiscount')['status_id'],
            ]);
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
     * @param Supplier $supplier
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Supplier $supplier): \Illuminate\Http\RedirectResponse
    {

        $supplier->delete($supplier);

//        if ($supplier->delete($supplier))
//        {
//            $supplier->discounts()->where('supplier_id', $supplier->id)->delete();
//            //$supplier->contractorsDiscount()->where('supplier_id', $supplier->id)->delete();
//        }

        return redirect()
            ->route($this->routes->index)
            ->with('success', $this->successDeleteMessage);

    }

}
