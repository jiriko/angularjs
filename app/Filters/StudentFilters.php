<?php

namespace App\Filters;

use App\User;

class StudentFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['query'];

    /**
     * Filter the query by a given name.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function query($query)
    {
        return $this->builder->where('name','like', "$query%")
                ->orWhere('email', 'like', "$query%");
    }

}