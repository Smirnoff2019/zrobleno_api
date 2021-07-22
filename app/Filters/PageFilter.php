<?php

namespace App\Filters;

use App\Schemes\Post\PostSchema;
use Illuminate\Database\Eloquent\Builder;

class PageFilter extends QueryFilter implements PostSchema
{

    /**
     * @param int $value
     */
    public function statusId($value)
    {
        $this->query->where(self::COLUMN_STATUS_ID, $value);
    }

    /**
     * @param string $value
     */
    public function title(string $value)
    {
        $words = array_filter(explode(' ', $value));

        $this->query->where(function (Builder $query) use ($words) {
            foreach ($words as $word) {
                $query->where(self::COLUMN_TITLE, 'like', "%$word%");
            }
        });
    }

    /**
     * @param string $value
     */
    public function sortBy(string $value)
    {
        switch ($value) {
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