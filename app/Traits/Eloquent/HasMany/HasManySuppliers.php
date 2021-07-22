<?php

namespace App\Traits\Eloquent\HasMany;

use App\Models\Supplier\Supplier;

/**
 *  @method suppliers()
 */ 
trait HasManySuppliers
{

    /**
     * Get the suppliers
     * 
     * @return HasMany \App\Models\Supplier\Supplier
     */
    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }
    
}
