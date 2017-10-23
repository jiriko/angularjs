<?php

namespace App;

use App\Filters\Filters;
use Illuminate\Database\Eloquent\Model;

class Subject extends BaseModel
{
    /**
     * Apply all relevant thread filters.
     *
     * @param  Builder       $query
     * @param  ThreadFilters $filters
     * @return Builder
     */
    public function scopeFilter($query, Filters $filters)
    {
        return $filters->apply($query);
    }
}
