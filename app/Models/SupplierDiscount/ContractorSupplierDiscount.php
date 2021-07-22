<?php

namespace App\Models\SupplierDiscount;

use App\Models\Role\ContractorRole;
use Illuminate\Database\Eloquent\Builder;

class ContractorSupplierDiscount extends SupplierDiscount
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
        static::addGlobalScope('forContractors', function (Builder $builder) {
            $builder->forContractors()
                ->oldest()
                ->take(1);
        });

        static::created(function ($discount) {
            if(!$discount->role_id) {
                ContractorRole::first()
                    ->supplierDiscounts()
                    ->save($discount);
            }
        });
    }

}
