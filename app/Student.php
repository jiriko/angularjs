<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Student extends BaseModel
{
    public function subjects()
    {
        return $this->belongsToMany(Subject::class,'enrollments')->withPivot('id');
    }
}
