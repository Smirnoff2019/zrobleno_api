<?php

namespace App\Models\SupplierDiscount;

use App\Models\User\User;
use App\Models\Role\CustomerRole;
use App\Models\Role\ContractorRole;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Eloquent\BelongsTo\BelongsToRole;
use App\Traits\Eloquent\BelongsTo\BelongsToStatus;
use App\Traits\Eloquent\BelongsTo\BelongsToSupplier;
use App\Schemes\SupplierDiscount\SupplierDiscountSchema;
use Illuminate\Database\Eloquent\Builder;

class SupplierDiscount extends Model implements SupplierDiscountSchema
{

    use BelongsToStatus,
        BelongsToRole,
        BelongsToSupplier;

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
        self::COLUMN_VALUE,
        self::COLUMN_SUPPLIER_ID,
        self::COLUMN_ROLE_ID,
        self::COLUMN_STATUS_ID,
        self::COLUMN_EXPIRATED_AT,
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
        self::COLUMN_EXPIRATED_AT,
        self::COLUMN_UPDATED_AT,
        self::COLUMN_CREATED_AT,
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        self::COLUMN_EXPIRATED_AT => 'datetime',
    ];
    
    /**
     * Get expirated formated
     *
     * @return string
     * 
     * @property $expirated_formated
     */
    public function getExpiratedFormatedAttribute()
    {
        if($this->expirated_at) {
            return $this->expirated_at->format('Y-m-d');
        }

        return '';
    }

    /**
     * Supplier discount for users with a given role slug
     *
     * @param  Builder  $query
     * @param  string  $slug
     * @return Builder
     * 
     * @method forRole(string $slug)
     */
    public function scopeForRole($query, string $slug)
    {
        return $query->whereHas('role', function($query) use($slug) {
                $query->where('slug', $slug);
        });
    }

    /**
     * Supplier discount for users with a given role slug
     *
     * @param  Builder  $query
     * @param  User  $user
     * @return Builder
     * 
     * @method forRole(string $slug)
     */
    public function scopeForUser($query, User $user)
    {
        return $query->whereHas('role', function($query) use($user) {
                $query->where('slug', $user->role->slug);
        });
    }
    
    /**
     * Supplier discount for users with the "customer" role
     *
     * @param  Builder $query
     * @return Builder
     * 
     * @method forContractors()
     */
    public function scopeForContractors($query)
    {
        return $query->forRole(ContractorRole::DEFAULT_SLUG);
    }
    
    /**
     * Supplier discount for users with the "customer" role
     *
     * @param  Builder $query
     * @return Builder
     * 
     * @method forCustomers()
     */
    public function scopeForCustomers($query)
    {
        return $query->forRole(CustomerRole::DEFAULT_SLUG);
    }

}
