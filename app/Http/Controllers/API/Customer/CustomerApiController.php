<?php

namespace App\Http\Controllers\API\Customer;

use App\Models\Tender\Tender;
use App\Jobs\Tender\CancelTender;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Tender\TenderResource;
use App\Http\Resources\Tender\TenderResourceCollection;
use App\Jobs\User\CreateCustomer;
use Illuminate\Http\Request;

class CustomerApiController extends ApiController
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
     * @param  \App\Models\TenderDeals\TenderDeals $tenderDeals
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Store a newly customer user.
     *
     * @method POST
     * @param Tender $tender
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {   
        return $this->success( 
            $this->resource(
                CreateCustomer::dispatchNow($request->only([
                    'first_name',
                    'middle_name',
                    'last_name',
                    'email',
                    'phone',
                ]))
            ),
            "Customer has been successfully created!"
        );
    }

}
