<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Filters\SubjectFilters;
use App\Http\Resources\Subject as SubjectResource;

class SubjectsController extends Controller
{
    public function index(SubjectFilters $filters)
    {
        return SubjectResource::collection(
            Subject::filter($filters)->paginate(15)
        );
    }
}
