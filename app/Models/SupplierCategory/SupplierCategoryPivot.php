<?php

namespace App\Models\SupplierCategory;

use App\Schemes\SupplierCategory\SupplierCategoryPivotSchema;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SupplierCategoryPivot extends Pivot implements SupplierCategoryPivotSchema
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = self::TABLE;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        self::COLUMN_UPDATED_AT,
        self::COLUMN_CREATED_AT,
    ];

}
