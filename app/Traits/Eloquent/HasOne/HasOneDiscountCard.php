<?php

namespace App\Traits\Eloquent\HasOne;

use App\Models\DiscountCard\DiscountCard;

/**
 *  @method discountCard()
 */ 
trait HasOneDiscountCard
{

    /**
     * Get the application for the this tender.
     * 
     * @return HasOne \App\Models\DiscountCard\DiscountCard
     */
    public function discountCard()
    {
        return $this->hasOne(
            DiscountCard::class
        );
    }
    
}
