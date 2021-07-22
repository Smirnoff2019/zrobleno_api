<?php

namespace App\Http\Controllers\API\Customer\Tenders;

use Illuminate\Http\Request;
use App\Models\Tender\Tender;
use App\Models\User\Customer\Customer;
use App\Http\Controllers\ApiController;
use App\Models\User\Contractor\Contractor;
use App\Jobs\Contractor\Tenders\BuyPlaceOnTender;
use App\Http\Resources\Tender\TenderResource;
use App\Http\Resources\Tender\TenderResourceCollection;
use App\Jobs\Tender\ConfirmTenderStart;
use App\Jobs\Tender\NewlyCreateTender;
use App\Jobs\Tender\Restart\CreateOfferToRestartTender;
use App\Models\Project\Project;
use App\Models\Status\Tender\AwaitingConfirmationStatus;
use App\Models\Status\TenderApplication\AwaitingConfirmationStatus as TenderApplicationAwaitingConfirmationStatus;
use Illuminate\Database\Eloquent\Builder;

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
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
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
            $this->customer
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
    public function initialized(Request $request)
    {
        return $this->collection(
            $this->customer
                ->tenders()
                ->whereDoesntHave('status', function (Builder $query) {
                    $query->where('slug', AwaitingConfirmationStatus::DEFAULT_SLUG);
                })
                ->whereDoesntHave('application.status', function (Builder $query) {
                    $query->where('slug', TenderApplicationAwaitingConfirmationStatus::DEFAULT_SLUG);
                })
                ->queryFilters($request)
                ->paginate($request->perPage ?? $this->perPage)
        );
    }

    /**
     * Display the specified resource.
     *
     * @method GET
     * @param  Tender $tender
     * @return \Illuminate\Http\Response
     */
    public function show(Tender $tender)
    {   
        return $this->resource($tender);
    }

    /**
     * Display the specified resource.
     *
     * @method GET
     * @param  Tender $tender
     * @return \Illuminate\Http\JsonResponse
     */
    public function restart(Tender $tender)
    {   
        return CreateOfferToRestartTender::dispatchNow($tender)
            ?   $this->successMessage(
                    'The offer to restart the tender has been successfully created! Wait for the confirmation of the application by the manager.'
                )
            :   $this->errorMessage(
                    'Error in creating a offer to restart the tender.'
                );
    }

    /**
     * Display the specified resource.
     *
     * @method POST
     * @param  Tender $tender
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {   
        return $this->resource(NewlyCreateTender::dispatchNow(
            Project::generateNewProjectData(),
            $this->customer
        ));
    }
 
}
