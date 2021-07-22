<?php

namespace App\Http\Controllers\API\User\DiscountCard;

use App\Models\User\User;
use App\Http\Controllers\ApiController;
use App\Models\DiscountCard\DiscountCard;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Api\DiscountCard\DiscountCardRequest;
use App\Http\Resources\User\DiscountCard\DiscountCardResource;
use App\Http\Resources\User\DiscountCard\DiscountCardResourceCollection;

class DiscountCardApiController extends ApiController
{

    /**
     * The repository resource model namespace.
     *
     * @var string
     */
    protected $resourceName = DiscountCardResource::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var string
     */
    protected $resourceCollectionName = DiscountCardResourceCollection::class;

    /**
     * Instantiate a new controller instance.
     *
     * @param \App\Models\User\User $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->middleware('auth:api');
        $this->model = $user;

        $this->textUserNotFound = "No user with this `id` was found!";
        $this->textCardNotFound = "No user discount card with this `id` was found!";
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @param  int  $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(int $user_id)
    {
        try {
            return $this->collection(
                $this->model
                    ->findOrFail($user_id)
                    ->discountCards()
                    ->latest()
                    ->paginate($this->perPage)
            );
        } catch (ModelNotFoundException $e) {
            return $this->notFound($this->textUserNotFound);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @method POST
     * @param  \App\Http\Requests\Api\DiscountCard\DiscountCardRequest $request
     * @param  int  $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(DiscountCardRequest $request, int $user_id)
    {
        try {
            return $this->resource(
                $this->model
                    ->findOrFail($user_id)
                    ->discountCards()
                    ->save(
                        factory(DiscountCard::class)->make($request->only([
                            DiscountCard::COLUMN_TENDER_ID,
                            DiscountCard::COLUMN_STATUS_ID,
                            DiscountCard::COLUMN_EXPIRATED_AT,
                        ])
                    ))
            );
        } catch (ModelNotFoundException $e) {
            return $this->notFound($this->textUserNotFound);
        }
    }

}
