<?php

namespace App\Http\Resources;

use App\Http\Response\Template\SuccessResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ApiResourceCollection extends ResourceCollection
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Data retrieved successfully!';

    /**
     * Indicates if all existing request query parameters should be added to pagination links.
     *
     * @var bool
     */
    protected $preserveAllQueryParameters = true;

    /**
     * Customize the response for a request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\JsonResponse  $response
     * @return void
     */
    public function withResponse($request, $response)
    {
        $newResponseData = collect($response->getData())
            ->merge(
                collect(SuccessResponse::make()
                    ->message($this->responseMessage)
                    ->transporter()
                    ->getResponseData())
                    ->except('data')
                    ->all()
            )
            ->all();
        
        $response->setData($newResponseData);
    }
    
}
