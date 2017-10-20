<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('subjects', function (Builder $builder) {
            $builder->with('subjects');
        });
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class,'enrollments');
    }
}
