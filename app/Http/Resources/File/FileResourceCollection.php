<?php

namespace App\Http\Resources\File;

use App\Schemes\File\FileSchema;
use App\Http\Resources\ApiResourceCollection;

class FileResourceCollection extends ApiResourceCollection implements FileSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Files retrieved successfully!';
    
}
