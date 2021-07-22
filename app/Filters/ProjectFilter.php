<?php

namespace App\Filters;

use App\Schemes\Project\ProjectSchema;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class ProjectFilter extends QueryFilter implements ProjectSchema
{

    /**
     * @param int $value
     */
    public function statusId($value)
    {
        $this->query->where(self::COLUMN_STATUS_ID, $value);
    }

    /**
     * @param mixed $value
     */
    public function userId($value)
    {
        $this->query->where(self::COLUMN_USER_ID, $value);
    }

    /**
     * @param mixed $value
     */
    public function regionId($value)
    {
        $this->query->where(self::COLUMN_REGION_ID, $value);
    }

    /**
     * @param mixed $value
     */
    public function ceilingHeightId($value)
    {
        $this->query->where(self::COLUMN_CEILING_HEIGHT_ID, $value);
    }

    /**
     * @param mixed $value
     */
    public function wallsConditionId($value)
    {
        $this->query->where(self::COLUMN_WALLS_CONDITION_ID, $value);
    }

    /**
     * @param mixed $value
     */
    public function propertyConditionId($value)
    {
        $this->query->where(self::COLUMN_PROPERTY_CONDITION_ID, $value);
    }

    /**
     * @param mixed $value
     */
    public function uid($value)
    {
        $uid = intval((string) Str::of($value)->replace('#', ''));
        $this->query->where(self::COLUMN_ID, 'like', "%$uid%");
    }

    /**
     * @param string $value
     */
    public function city(string $value)
    {
        $this->query->where(self::COLUMN_CITY, 'like', "%$value%");
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
