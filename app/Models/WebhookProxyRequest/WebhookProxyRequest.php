<?php

namespace App\Models\WebhookProxyRequest;

use Illuminate\Database\Eloquent\Model;
use App\Models\WebhookProxy\WebhookProxy;
use App\Schemes\WebhookProxy\WebhookProxySchema;
use App\Traits\Eloquent\BelongsTo\BelongsToStatus;
use App\Schemes\WebhookProxyRequest\WebhookProxyRequestSchema;

class WebhookProxyRequest extends Model implements WebhookProxyRequestSchema
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
        self::COLUMN_WEBHOOK_PROXY_ID,
        self::COLUMN_DATA,
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        self::COLUMN_DATA => 'array',
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
     * Get the webhook proxy data for request
     *
     * @return HasOne \App\Models\WebhookProxy\WebhookProxy
     */
    public function proxy()
    {
        return $this->belongsTo(WebhookProxy::class);
    }

}
