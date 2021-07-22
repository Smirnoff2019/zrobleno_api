<?php

namespace App\Traits\Eloquent\HasMany;

use App\Models\SupplierDiscount\SupplierDiscount;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *  @method supplierDiscounts()
 */ 
trait HasManySupplierDiscounts
{

    /**
     * Get the supplier discounts
     * 
     * @return HasMany \App\Models\SupplierDiscount\SupplierDiscount
     */
    public function discounts(): HasMany
    {
        return $this->hasMany(SupplierDiscount::class);
    }
    
}
