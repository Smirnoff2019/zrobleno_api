<?php

namespace App\Http\Controllers\API\Calculator;

use App\Http\Controllers\ApiController;
use App\Services\CalculatorService;

class CalculatorApiController extends ApiController
{

    /**
     * The repository resource model namespace.
     *
     * @var string
     */
    protected $resourceName = CalculatorResource::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var string
     */
    protected $resourceCollectionName = CalculatorResourceCollection::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var CalculatorService
     */
    protected $service;

    /**
     * Instantiate a new controller instance.
     *
     * @param \App\Models\Category\Category $category
     */
    public function __construct( CalculatorService $calculator )
    {
        $this->service = $calculator;
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->success(
            $this->service->get(),
            'Success'
        );
    }

}
