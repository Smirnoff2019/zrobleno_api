<?php

namespace App\Filters;

use App\Schemes\Option\OptionSchema;
use App\Schemes\OptionsGroup\OptionsGroupSchema;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class OptionsGroupFilter extends QueryFilter implements OptionsGroupSchema
{

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
    public function roomId($value)
    {
        $this->query->where(self::COLUMN_ROOM_ID, $value);
    }

    /**
     * @param string $value
     */
    public function name(string $value)
    {
        $this->query->where(self::COLUMN_NAME, 'like', "%$value%");
    }

    /**
     * @param string $value
     */
    public function slug(string $value)
    {
        $this->query->where(self::COLUMN_SLUG, 'like', "%$value%");
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