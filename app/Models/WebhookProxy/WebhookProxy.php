<?php

namespace App\Models\WebhookProxy;

use App\Models\WebhookProxyRequest\WebhookProxyRequest;
use App\Schemes\WebhookProxy\WebhookProxySchema;
use App\Traits\Eloquent\BelongsTo\BelongsToStatus;
use Illuminate\Database\Eloquent\Model;

class WebhookProxy extends Model implements WebhookProxySchema
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
        self::COLUMN_GROUP,
        self::COLUMN_DOMAIN,
        self::COLUMN_SSL,
        self::COLUMN_STATUS_ID,
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        self::COLUMN_SSL        => true,
        self::COLUMN_STATUS_ID  => true,
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        self::COLUMN_SSL => 'boolean',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        //
    ];

    /**
     * Get the webhook requests history
     *
     * @return HasOne \App\Models\WebhookProxyRequest\WebhookProxyRequest
     */
    public function requests()
    {
        return $this->hasMany(WebhookProxyRequest::class);
    }

    /**
     * Scope a query to only include proxies with incoming `status_id`
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  bool $status
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeActive($query, int $status = 1)
    {
        return $query->where(
            self::COLUMN_STATUS_ID,
            $status
        );
    }

    /**
     * Scope a query to only include proxies where `group` incoming value
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  bool $group
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeGroup($query, string $group)
    {
        return $query->where(
            self::COLUMN_GROUP,
            $group
        );
    }

    /**
     * Scope a query to only include proxies where `group` incoming value
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  bool $group
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeTelegramGroup($query, string $group = 'telegram')
    {
        return $query->where(
            self::COLUMN_GROUP,
            $group
        );
    }

}
