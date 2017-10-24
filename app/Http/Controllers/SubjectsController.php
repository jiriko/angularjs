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

    public function store()
    {
        $subject = Subject::create(
            request()->validate([
                'name' => 'required|unique:subjects'
            ])
        );

        return new SubjectResource($subject);
    }

    public function update(Subject $subject)
    {
        $subject->update(request()->validate([
            'name' => 'required|unique:subjects,name,' . $subject->id,
        ]));

        return response([]);
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return response([]);
    }
}
