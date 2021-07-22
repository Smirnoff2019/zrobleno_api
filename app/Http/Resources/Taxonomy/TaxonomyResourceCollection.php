<?php

namespace App\Http\Resources\Taxonomy;

use App\Http\Resources\ApiResourceCollection;
use App\Schemes\Taxonomy\TaxonomySchema;

class TaxonomyResourceCollection extends ApiResourceCollection implements TaxonomySchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Taxonomies retrieved successfully!';

}
