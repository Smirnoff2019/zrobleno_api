<?php

namespace App\Models\Supplier;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Schemes\Supplier\SupplierSchema;
use App\Models\SupplierCategory\SupplierCategory;
use App\Models\SupplierDiscount\SupplierDiscount;
use App\Traits\Eloquent\BelongsTo\BelongsToImage;
use App\Traits\Eloquent\BelongsTo\BelongsToStatus;
use App\Models\SupplierCategory\SupplierCategoryPivot;
use App\Traits\Eloquent\HasMany\HasManySupplierDiscounts;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model implements SupplierSchema
{

    use BelongsToImage,
        BelongsToStatus,
        HasManySupplierDiscounts;

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
        self::COLUMN_DESCRIPTION,
        self::COLUMN_CATALOG_URL,
        self::COLUMN_IMAGE_ID,
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
     * Get the one supplier discount
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne \App\Models\SupplierDiscount\SupplierDiscount
     */
    public function discount(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(SupplierDiscount::class);
    }
    
    /**
     * Get the supplier categories
     * 
     * @return BelongsToMany \App\Models\SupplierCategory\SupplierCategory 
     */
    public function supplierCategories()
    {
        return $this->belongsToMany(
            SupplierCategory::class,
            SupplierCategoryPivot::class,
            SupplierCategoryPivot::COLUMN_SUPPLIER_ID,
            SupplierCategoryPivot::COLUMN_SUPPLIER_CATEGORY_ID,
        )->withTimestamps();
    }
    
    /**
     * Supplier discount for users with the "contractor" role
     *
     * @return HasMany \App\Models\SupplierDiscount\SupplierDiscount
     */
    public function contractorsDiscount()
    {
        return $this->discount()->forContractors();
    }
    
    /**
     * Supplier discount for users with the "customer" role
     *
     * @return HasMany \App\Models\SupplierDiscount\SupplierDiscount
     */
    public function customersDiscount()
    {
        return $this->discount()->forCustomers();
    }
    
    /**
     * Supplier discount for users with a given role slug
     *
     * @param  Builder  $query
     * @param  string  $slug
     * @return Builder
     * 
     * @method discountsForRole(string $slug)
     */
    public function scopeDiscountsForRole(Builder $query, string $slug)
    {
        return $query->discounts()->forRole($slug);
    }
    
    /**
     * Supplier discount for users with the "customer" role
     *
     * @param  Builder $query
     * @return Builder
     * 
     * @method discountsForContractors()
     */
    public function scopeDiscountsForContractors($query)
    {
        return $query->discounts()->forContractors();
    }
    
    /**
     * Supplier discount for users with the "customer" role
     *
     * @param  Builder $query
     * @return Builder
     * 
     * @method discountsForCustomers()
     */
    public function scopeDiscountsForCustomers($query)
    {
        return $query->discounts()->forCustomers();
    }
    
    /**
     * Category scope
     *
     * @param  Builder $query
     * @param  string $category
     * @return Builder
     */
    public function scopeHasCategory($query, string $category)
    {
        return $query->whereHas(
            'supplierCategories', 
            function($query) use($category) {
                $query->where('slug', $category);
            }
        );
    }

}
