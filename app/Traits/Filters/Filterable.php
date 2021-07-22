<?php 

namespace App\Traits\Filters;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{

    /**
     * @param Builder $query
     * @param QueryFilter $filter
     */
    public function scopeFilter(Builder $query, QueryFilter $filter)
    {
        $filter->apply($query);
    }

}
