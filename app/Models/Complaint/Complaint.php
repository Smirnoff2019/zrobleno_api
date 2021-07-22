<?php

namespace App\Models\Complaint;

use App\Models\ComplaintRecipient\ComplaintRecipient;
use App\Models\ComplaintResponse\ComplaintResponse;
use App\Models\User\User;
use App\Schemes\Complaint\ComplaintSchema;
use App\Traits\Eloquent\BelongsTo\BelongsToStatus;
use App\Traits\Eloquent\BelongsTo\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Complaint extends Model implements ComplaintSchema
{

    use BelongsToUser,
        BelongsToStatus;

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
        self::COLUMN_SUBJECT,
        self::COLUMN_MESSAGE,
        self::COLUMN_USER_ID,
        self::COLUMN_STATUS_ID,
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
    * The responses later for complaint
    *
    * @return belongsToMany static
    */
    public function responses()
    {
        return $this->belongsToMany(
            static::class,
            ComplaintResponse::class,
            ComplaintResponse::COLUMN_COMPLAINT_ID,
            ComplaintResponse::COLUMN_RESPONSE_ID
        );
    }

    /**
    * The responses later for complaint
    *
    * @return belongsToMany static
    */
    public function complaint()
    {
        return $this->hasOneThrough(
            static::class,
            ComplaintResponse::class,
            ComplaintResponse::COLUMN_RESPONSE_ID,
            ComplaintResponse::COLUMN_ID,
            ComplaintResponse::COLUMN_ID,
            ComplaintResponse::COLUMN_COMPLAINT_ID,
        );
    }

    /**
     * The responses later for complaint
     *
     * @return hasOneThrough static
     */
    public function recipient()
    {
        return $this->hasOneThrough(
            User::class,
            ComplaintRecipient::class,
            ComplaintRecipient::COLUMN_COMPLAINT_ID,
            User::COLUMN_ID,
            ComplaintRecipient::COLUMN_ID,
            ComplaintRecipient::COLUMN_USER_ID
        );
    }

}
