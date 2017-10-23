<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Resources\Student as StudentResource;

class StudentsController extends Controller
{
    public function index()
    {
        return StudentResource::collection(
            Student::with('subjects')->paginate(5)
        );
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
