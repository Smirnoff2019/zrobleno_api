<?php

namespace App\Http\Controllers\API\Contractor\Tenders\Deals;

use App\Events\Tender\TenderDealConfirmEvent;
use App\Events\Tender\TenderDealRejectEvent;
use App\Models\Tender\Tender;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Tender\TenderResource;
use App\Http\Resources\Tender\TenderResourceCollection;
use App\Jobs\User\CreateDiscountCard;
use App\Models\Status\TenderDeals\AgreedStatus;
use App\Models\Status\TenderDeals\RejectedStatus;
use App\Models\User\Contractor\Contractor;
use Illuminate\Http\Request;

class TenderDealsApiController extends ApiController
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
    public function __construct(Contractor $contractor, Tender $tender)
    {
        $this->contractor = $contractor;
        $this->tender = $tender;
    }

    /**
     * Confirm deal offer by tender
     *
     * @method POST
     * @param int $tender_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirm(Request $request, Tender $tender)
    {   
        $tender->activeDeal->status()->associate(AgreedStatus::first())->save();
        $tender->setAsCompleted();
        
        $customerCard = CreateDiscountCard::dispatchNow($tender, $tender->activeDeal->customer);
        $contractorCard = CreateDiscountCard::dispatchNow($tender, $tender->activeDeal->contractor);

        event(new TenderDealConfirmEvent($tender, $tender->user));

        return $this->resource($tender->refresh());
    }

    /**
     * Reject deal offer by tender
     *
     * @method POST
     * @param int $tender_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function reject(Request $request, Tender $tender)
    {
        $tender->activeDeal->status()->associate(RejectedStatus::first())->save();
        
        event(new TenderDealRejectEvent($tender, $tender->user));

        return $this->resource($tender->refresh());
    }

}
