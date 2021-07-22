<?php

namespace App\Filters;

use Illuminate\Support\Str;
use App\Schemes\Tender\TenderSchema;
use Illuminate\Database\Eloquent\Builder;

class TenderFilter extends QueryFilter implements TenderSchema
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
    public function userId($value)
    {
        $this->query->where(self::COLUMN_USER_ID, $value);
    }

    /**
     * @param int $status
     */
    public function uid($value)
    {
        $uid = intval((string) Str::of($value)->replace('#', ''));
        $this->query->uidLike(self::COLUMN_UID, '%like%', $uid);
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