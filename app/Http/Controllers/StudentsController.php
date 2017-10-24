<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use App\Filters\StudentFilters;
use App\Http\Resources\Student as StudentResource;

class StudentsController extends Controller
{
    public function index(StudentFilters $filters)
    {
        return StudentResource::collection(
            Student::fetch($filters)
        );
    }

    public function store()
    {
        $student = Student::create(
            request()->validate([
                'name' => 'required',
                'email' => 'required|email|unique:students'
            ])
        );

        return new StudentResource($student);
    }

    public function update(Student $student)
    {
        $student->update(request()->validate([
            'email' => 'required|email|unique:students,email,' . $student->id,
            'name' => 'required'
        ]));

        return response([]);
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return response([]);
    }
}
