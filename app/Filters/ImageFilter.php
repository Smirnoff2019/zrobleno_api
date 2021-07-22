<?php

namespace App\Filters;

use App\Schemes\Image\ImageSchema;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class ImageFilter extends QueryFilter implements ImageSchema
{

    /**
     * @param int $value
     */
    public function groupId($value)
    {
        $this->query->where(self::COLUMN_IMAGES_GROUP_ID, $value);
    }

    /**
     * @param int $value
     */
    public function statusId($value)
    {
        $this->query->where(self::COLUMN_STATUS_ID, $value);
    }

    /**
     * @param int $value
     */
    public function parentId($value)
    {
        $this->query->where(self::COLUMN_PARENT_ID, $value);
    }

    /**
     * @param string $sortable
     */
    public function sortBy(string $sortable)
    {
        switch ($sortable) {
            case 'latest':
                $this->query->latest();
                break;
                
            case 'oldest':
                $this->query->oldest();
                break;
            
            default:
                $this->query->latest();
                break;
        }
    }

}