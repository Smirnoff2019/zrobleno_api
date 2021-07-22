<?php

namespace App\Http\Controllers;

use App\Traits\Controller\CallResponse;
use App\Traits\Controller\ResourceResponsible;
use Illuminate\Http\Request;

class ApiController extends Controller
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

    /**
     * Get a count record per page
     *
     * @param Request $request
     * @return int
     */
    public function perPageCount(Request $request)
    {
        return $request->get('per_page', $this->perPage) ?? $this->perPage;
    }

}

