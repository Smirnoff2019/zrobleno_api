<?php

namespace App\Models\NotificationGroup;

use App\Models\NotificationTemplate\NotificationTemplate;
use App\Schemes\NotificationGroup\NotificationGroupSchema;
use App\Schemes\NotificationTemplate\NotificationTemplateSchema;
use Illuminate\Database\Eloquent\Model;

class NotificationGroup extends Model implements NotificationGroupSchema
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
        self::COLUMN_DESCRIPTION,
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

    public function templates()
    {
        return $this->hasMany(
            NotificationTemplate::class,
            NotificationTemplateSchema::COLUMN_GROUP_SLUG,
            self::COLUMN_SLUG
        );
    }

}
