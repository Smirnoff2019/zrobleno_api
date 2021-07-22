<?php

namespace App\Traits\Eloquent\HasOne;

use App\Models\TenderApplication\TenderApplication;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasOneTenderApplication
{

    /**
     * Get the application for the this tender.
     * 
     * @return HasOne \App\Models\TenderApplication\TenderApplication
     */
    public function application()
    {
        return $this->hasOne(
            TenderApplication::class
        );
    }
    
}
