<?php

namespace App\Models\SupplierCategory;

use App\Models\Supplier\Supplier;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Eloquent\BelongsTo\BelongsToStatus;
use App\Schemes\SupplierCategory\SupplierCategorySchema;

class SupplierCategory extends Model implements SupplierCategorySchema
{

    use BelongsToStatus;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = self::TABLE;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::COLUMN_NAME,
        self::COLUMN_SLUG,
        self::COLUMN_STATUS_ID,
    ];

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
        self::COLUMN_UPDATED_AT,
        self::COLUMN_CREATED_AT,
    ];

    /**
     * Get the suppliers
     * 
     * @return BelongsToMany \App\Models\Supplier\Supplier 
     */
    public function suppliers()
    {
        return $this->belongsToMany(
            Supplier::class,
            SupplierCategoryPivot::class,
            SupplierCategoryPivot::COLUMN_SUPPLIER_CATEGORY_ID,
            SupplierCategoryPivot::COLUMN_SUPPLIER_ID,
        )->withTimestamps();
    }

}
