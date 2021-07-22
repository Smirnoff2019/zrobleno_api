<?php

namespace App\Models\SupplierDiscount;

use App\Models\Role\CustomerRole;
use Illuminate\Database\Eloquent\Builder;

class CustomerSupplierDiscount extends SupplierDiscount
{

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        //
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        self::COLUMN_EXPIRATED_AT,
        self::COLUMN_UPDATED_AT,
        self::COLUMN_CREATED_AT,
    ];
    
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('forCustomers', function (Builder $builder) {
            $builder->forCustomers()
                ->oldest()
                ->take(1);
        });

        static::created(function ($discount) {
            if(!$discount->role_id) {
                CustomerRole::first()
                    ->supplierDiscounts()
                    ->save($discount);
            }
        });
    }

}
