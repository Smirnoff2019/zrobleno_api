<?php

namespace App\Traits\Eloquent\HasMany;

use App\Models\DiscountCard\DiscountCard;

/**
 *  @method discountCards()
 */ 
trait HasManyDiscountCards
{

    /**
     * Get the related roles
     * 
     * @return HasMany \App\Models\DiscountCard\DiscountCard
     */
    public function discountCards()
    {
        return $this->hasMany(
            DiscountCard::class
        );
    }
    
}
