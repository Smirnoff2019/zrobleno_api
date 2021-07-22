<?php

namespace App\Http\Controllers\API\Contractor\Tenders;

use Illuminate\Http\Request;
use App\Models\Tender\Tender;
use App\Models\User\Customer\Customer;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Tender\TenderResource;
use App\Http\Resources\Tender\TenderResourceCollection;
use App\Models\User\Contractor\Contractor;
use App\Jobs\Contractor\Tenders\BuyPlaceOnTender;

class TendersApiController extends ApiController
{

    /**
     * The repository resource model namespace.
     *
     * @var string
     */
    protected $resourceName = TenderResource::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var string
     */
    protected $resourceCollectionName = TenderResourceCollection::class;

    /**
     * Instantiate a new controller instance.
     *
     * @param  \App\Models\User\Contractor $contractor
     * @return void
     */
    public function __construct(Contractor $contractor)
    {
        $this->contractor = $contractor;
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->collection(
            $this->contractor
                ->tenders()
                ->queryFilters($request)
                ->paginate($request->perPage ?? $this->perPage)
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function available(Request $request)
    {
        $contractor_id = $request->user()->id;

        return $this->collection(
            Tender::availableTenders($contractor_id)
                ->queryFilters($request)
                ->paginate($request->get('per_page') ?? $this->perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @method POST
     * @param  int  $tender_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function buy(int $tender_id)
    {   
        $tender = $this->contractor
            ->availableTenders()
            ->findOrFail($tender_id);

        return $this->resource(
            BuyPlaceOnTender::dispatchNow(
                $this->contractor, 
                $tender
            )
        );
    }

    /**
     * Display the specified resource.
     *
     * @method GET
     * @param  int  $tender_id
     * @return \Illuminate\Http\Response
     */
    public function show(int $tender_id)
    {
        return $this->resource(
            $this->contractor->tenders()->findOrFail($tender_id)
        );
    }

    /**
     * Display the specified resource.
     *
     * @method GET
     * @return \Illuminate\Http\Response
     */
    public function forCustomer(Request $request, Customer $customer)
    {
        return $this->collection(
            $customer->tenders()->paginate($request->perPage ?? $this->perPage)
        );
    }
}
