<?php

namespace App\Traits\Eloquent\HasMany;

use App\Models\Payment\Payment;

trait HasManyPayments
{

    /**
     * Get the related Payments
     * 
     * @return HasMany \App\Models\Payment\Payment
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    
}
