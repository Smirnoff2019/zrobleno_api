<?php

namespace App\Models\NotificationButton;

use App\Models\NotificationMedia\NotificationMedia;
use App\Models\NotificationTemplate\NotificationTemplate;
use App\Schemes\NotificationButton\NotificationButtonSchema;
use Illuminate\Database\Eloquent\Model;

class NotificationButton extends Model implements NotificationButtonSchema
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
        self::COLUMN_URL,
        self::COLUMN_TYPE,
        self::COLUMN_SERVICE,
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
     * Scope a query to only include buttons whose attribute type value matches the specified (one of 'text', 'url', 'callback')
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string|array $type
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeType($query, $type)
    {   
        return $query->where(
            self::COLUMN_TYPE,
            $type
        );
    }
    
    /**
     * Scope a query to only include buttons whose attribute type value matches the 'text'
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string[:'text'] $type
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeTypeText($query, string $type = 'text')
    {   
        return $query->where(
            self::COLUMN_TYPE,
            $type
        );
    }
    
    /**
     * Scope a query to only include buttons whose attribute type value matches the 'url'
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string[:'url'] $type
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeTypeUrl($query, string $type = 'url')
    {   
        return $query->where(
            self::COLUMN_TYPE,
            $type
        );
    }
    
    /**
     * Scope a query to only include buttons whose attribute type value matches the 'callback'
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string[:'callback'] $type
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeTypeCallback($query, string $type = 'callback')
    {   
        return $query->where(
            self::COLUMN_TYPE,
            $type
        );
    }
     
    /**
     * Scope a query to only include buttons whose attribute service value matches the specified (one of 'telegram', 'mail', 'database')
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string|array $service
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeService($query, $service)
    {   
        return $query->where(
            self::COLUMN_SERVICE,
            $service
        );
    }
     
    /**
     * Scope a query to only include buttons whose attribute service value matches the 'telegram'
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string[:telegram] $service
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeServiceTelegram($query, string $service = 'telegram')
    {   
        return $query->where(
            self::COLUMN_SERVICE,
            $service
        );
    }
     
    /**
     * Scope a query to only include buttons whose attribute service value matches the 'mail'
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string[:mail] $service
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeServiceMail($query, string $service = 'mail')
    {   
        return $query->where(
            self::COLUMN_SERVICE,
            $service
        );
    }
     
    /**
     * Scope a query to only include buttons whose attribute service value matches the 'database'
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string[:database] $service
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeServiceDatabase($query, string $service = 'database')
    {   
        return $query->where(
            self::COLUMN_SERVICE,
            $service
        );
    }

    /**
     * Get the notification media.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne|\App\Models\NotificationMedia\NotificationMedia
     */
    public function templateMedia()
    {
        return $this->morphOne(NotificationMedia::class, 'media');
    }

}
