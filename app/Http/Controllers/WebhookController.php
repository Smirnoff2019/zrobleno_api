<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\ApiResource;
use App\Traits\Controller\CallResponse;
use App\Http\Resources\ResourceResponseMeta;
use App\Http\Resources\ApiResourceCollection;
use App\Traits\Controller\ResourceResponsible;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Resources\Tender\TenderResourceCollection;

class WebhookController extends Controller
{

    use CallResponse, ResourceResponsible;

    /**
     * The repository instance.
     *
     * @var App\Repositories\AbstractRepository
     */
    protected $repository;

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 25;


}

