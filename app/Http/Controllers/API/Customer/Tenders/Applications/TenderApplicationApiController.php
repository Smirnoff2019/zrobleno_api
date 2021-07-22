<?php

namespace App\Http\Controllers\API\Customer\Tenders\Applications;

use App\Models\Tender\Tender;
use App\Jobs\Tender\CancelTender;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Tender\TenderResource;
use App\Http\Resources\Tender\TenderResourceCollection;

class TenderApplicationApiController extends ApiController
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
     * Store a newly deal offer by tender.
     *
     * @method POST
     * @param Tender $tender
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancel(Tender $tender)
    {   
        return $this->success( 
            $this->resource(
                CancelTender::dispatchNow(
                    $tender
                )
            ),
            "The tender application has been successfully canceled!"
        );
    }

}
