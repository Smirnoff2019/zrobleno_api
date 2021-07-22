<?php

namespace App\Models\User\Customer;

use App\Models\TenderDeals\TenderDeals;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends User
{

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(
            'customer_role',
            function(Builder $builder)
            {
                $builder->customer();
            }
        );
    }

    /**
     * Get the all deals from tender for the this essence.
     *
     * @return hasMany \App\Models\Tender\Tender
     */
    public function tenderDeals()
    {

        return $this->hasMany(
            TenderDeals::class,
            'customer_id',
            'id'
        );

    }

}
