<?php

namespace App\Http\Controllers\API\Manager\Tenders\Applications;

use App\Models\Tender\Tender;
use App\Jobs\Tender\CancelTender;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Tender\TenderResource;
use App\Http\Resources\Tender\TenderResourceCollection;
use App\Jobs\Tender\RejectTenderApplication;
use App\Jobs\Tender\СonfirmTenderApplication;

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
     * Confirm tender application
     *
     * @method POST
     * @param Tender $tender
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirm(Tender $tender)
    {   
        return $this->success( 
            $this->resource(
                СonfirmTenderApplication::dispatchNow(
                    $tender
                )
            ),
            "The tender application has been confirmed!"
        );
    }

    /**
     * Reject tender application
     *
     * @method POST
     * @param Tender $tender
     * @return \Illuminate\Http\JsonResponse
     */
    public function reject(Tender $tender)
    {   
        return $this->success( 
            $this->resource(
                RejectTenderApplication::dispatchNow(
                    $tender
                )
            ),
            "The tender application has been rejected!"
        );
    }

}
