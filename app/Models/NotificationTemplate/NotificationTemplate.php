<?php

namespace App\Models\NotificationTemplate;

use App\Models\NotificationGroup\NotificationGroup;
use App\Models\NotificationMedia\NotificationMedia;
use App\Models\NotificationType\NotificationType;
use App\Schemes\NotificationTemplate\NotificationTemplateSchema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class NotificationTemplate extends Model implements NotificationTemplateSchema
{

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
        self::COLUMN_CONTENT,
        self::COLUMN_GROUP_SLUG,
        self::COLUMN_NOTIFICATION_NAME,
        self::COLUMN_COVER_ID,
        self::COLUMN_STATUS_SLUG
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        //
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
        //
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
     * Get the notification template type.
     *
     * @return BelongsTo \App\Models\NotificationType\NotificationType
     */
    public function type()
    {
        return $this->belongsTo(
            NotificationType::class,
            self::COLUMN_TYPE_SLUG,
            NotificationType::COLUMN_SLUG
        );
    }

    /**
     * Get the notification template group.
     *
     * @return BelongsTo \App\Models\NotificationGroup\NotificationGroup
     */
    public function group()
    {
        return $this->belongsTo(
            NotificationGroup::class,
            self::COLUMN_GROUP_SLUG,
            NotificationGroup::COLUMN_SLUG
        );
    }

    /**
     * Get the notification template media.
     *
     * @return HasMany \App\Models\NotificationMedia\NotificationMedia
     */
    public function media()
    {
        return $this->hasMany(
            NotificationMedia::class,
            NotificationMedia::COLUMN_TEMPLATE_ID
        );
    }

    /**
     * Scope a query to include all relations
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeWithAllRelations($query)
    {
        return $query->with([
            'type',
            'group',
            'media.mediable'
        ]);
    }

    /**
     * Scope a query to include records at has specified `slug`
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string $slug
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeSlug($query, string $slug)
    {
        return $query->where(self::COLUMN_SLUG, $slug);
    }

    public function scopeStatusSlug($query, string $status)
    {
        return $query->where(self::COLUMN_STATUS_SLUG, $status);

    }

    /**
     * Scope a query to include records at has specified `group`
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string $group
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeGroupName($query, string $group)
    {
        return $query->where(self::COLUMN_GROUP_SLUG, $group);
    }

    /**
     * Scope a query to include records at has specified `type`
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string $type
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeTypeName($query, string $type)
    {
        return $query->where(self::COLUMN_TYPE_SLUG, $type);
    }

    public function scopeTemplate ($query, string $notification_name, string $status_slug)
    {
        return $query->where(self::COLUMN_STATUS_SLUG, $status_slug)
            ->where(self::COLUMN_NOTIFICATION_NAME, $notification_name);
    }


}
