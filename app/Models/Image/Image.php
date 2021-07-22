<?php


namespace App\Models\Image;

use App\Schemes\Image\ImageSchema;
use App\Traits\Eloquent\BelongsTo\BelongsToFile;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Eloquent\BelongsTo\BelongsToParent;
use App\Traits\Eloquent\BelongsTo\BelongsToStatus;
use App\Models\NotificationMedia\NotificationMedia;
use App\Traits\Eloquent\BelongsTo\BelongsToImagesGroup;
use App\Traits\Filters\Filterable;

class Image extends Model implements ImageSchema
{
    use BelongsToParent,
        BelongsToStatus,
        BelongsToFile,
        BelongsToImagesGroup,
        Filterable;

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
        self::COLUMN_FILE_ID,
        self::COLUMN_PARENT_ID,
        self::COLUMN_IMAGES_GROUP_ID,
        self::COLUMN_STATUS_ID,
    ];


    /**
     * Get the notification media.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne|\App\Models\NotificationMedia\NotificationMedia
     */
    public function notificationTemplateMedia()
    {
        return $this->morphOne(NotificationMedia::class, 'media');
    }

    /**
     * Get the image url.
     *
     * @param  string  $value
     * @return string|null
     */
    public function getUrlAttribute($value)
    {
        return $this->file->url ?? null;
    }

    /**
     * Get the image url.
     *
     * @param  string  $value
     * @return void
     */
    public function setUrlAttribute($value)
    {
        $this->file->url = (string) $value;
    }

    /**
     * Get the image uri.
     *
     * @param  string  $value
     * @return string|null
     */
    public function getUriAttribute($value)
    {
        return $this->file->uri ?? null;
    }

    /**
     * Get the image uri.
     *
     * @param  string  $value
     * @return void
     */
    public function setUriAttribute($value)
    {
        $this->file->uri = (string) $value;
    }

    /**
     * Get the image path.
     *
     * @param  string  $value
     * @return string|null
     */
    public function getPathAttribute($value)
    {
        return $this->file->path ?? null;
    }

    /**
     * Get the image path.
     *
     * @param  string  $value
     * @return void
     */
    public function setPathAttribute($value)
    {
        $this->file->path = (string) $value;
    }

    /**
     * Get the image name.
     *
     * @param  string  $value
     * @return string|null
     */
    public function getNameAttribute($value)
    {
        return $this->file->name ?? null;
    }

    /**
     * Get the image name.
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        $this->file->name = (string) $value;
    }

    /**
     * Get the image title.
     *
     * @param  string  $value
     * @return string|null
     */
    public function getTitleAttribute($value)
    {
        return $this->file->title ?? null;
    }

    /**
     * Get the image title.
     *
     * @param  string  $value
     * @return void
     */
    public function setTitleAttribute($value)
    {
        $this->file->title = (string) $value;
    }

    /**
     * Get the image description.
     *
     * @param  string  $value
     * @return string|null
     */
    public function getDescriptionAttribute($value)
    {
        return $this->file->description ?? null;
    }

    /**
     * Get the image description.
     *
     * @param  string  $value
     * @return void
     */
    public function setDescriptionAttribute($value)
    {
        $this->file->description = (string) $value;
    }

    /**
     * Get the image sort.
     *
     * @param  string  $value
     * @return string|null
     */
    public function getSortAttribute($value)
    {
        return $this->file->sort ?? null;
    }

    /**
     * Get the image sort.
     *
     * @param  string  $value
     * @return void
     */
    public function setSortAttribute($value)
    {
        $this->file->sort = (string) $value;
    }

    /**
     * Get the image format.
     *
     * @param  string  $value
     * @return string|null
     */
    public function getFormatAttribute($value)
    {
        return $this->file->format ?? null;
    }

    /**
     * Get the image format.
     *
     * @param  string  $value
     * @return void
     */
    public function setFormatAttribute($value)
    {
        $this->file->format = (string) $value;
    }

    /**
     * Get the image size.
     *
     * @param  string  $value
     * @return string|null
     */
    public function getSizeAttribute($value)
    {
        return $this->file->size ?? null;
    }

    /**
     * Get the image size.
     *
     * @param  string  $value
     * @return void
     */
    public function setSizeAttribute($value)
    {
        $this->file->size = (string) $value;
    }

    /**
     * Get the image room.id
     *
     * @param  string  $value
     * @return string|null
     */
    public function getRoomIdAttribute($value)
    {
        return $this->file->id ?? null;
    }

}