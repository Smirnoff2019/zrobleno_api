<?php

namespace App\Http\Controllers\API\Customer\Tenders\Deals;

use Illuminate\Http\Request;
use App\Models\Tender\Tender;
use App\Http\Controllers\ApiController;
use App\Models\User\Contractor\Contractor;
use App\Jobs\Contractor\Tenders\Deals\NewDealOffer;
use App\Jobs\Contractor\Tenders\Deals\RejectDealOffer;
use App\Http\Resources\TenderDeals\TenderDealsResource;
use App\Jobs\Contractor\Tenders\Deals\ConfirmDealOffer;
use App\Http\Resources\TenderDeals\TenderDealsResourceCollection;

class TenderDealsApiController extends ApiController
{

    /**
     * The repository resource model namespace.
     *
     * @var string
     */
    protected $resourceName = TenderDealsResource::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var string
     */
    protected $resourceCollectionName = TenderDealsResourceCollection::class;

    /**
     * Instantiate a new controller instance.
     *
     * @param  \App\Models\TenderDeals\TenderDeals $tenderDeals
     * @return void
     */
    public function __construct(Request $request, Contractor $contractor)
    {
        $this->contractor = $contractor;
    }

    /**
     * Store a newly deal offer by tender.
     *
     * @method POST
     * @param Tender $tender
     * @return \Illuminate\Http\JsonResponse
     */
    public function offer(Request $request, Tender $tender)
    {   
        return $this->resource(
            NewDealOffer::dispatchNow(
                $this->contractor->findOrFail($request->get('contractor_id', null)),
                $tender,
            )->refresh()
        );
    }

}
