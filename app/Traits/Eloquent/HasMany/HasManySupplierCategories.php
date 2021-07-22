<?php

namespace App\Traits\Eloquent\HasMany;

use App\Models\SupplierCategory\SupplierCategory;

/**
 *  @method supplierCategories()
 */ 
trait HasManySupplierCategories
{

    /**
     * Get the supplier categories
     * 
     * @return HasMany \App\Models\SupplierCategory\SupplierCategory
     */
    public function supplierCategories()
    {
        return $this->hasMany(SupplierCategory::class);
    }
    
}
