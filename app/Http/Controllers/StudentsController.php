<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Resources\Student as StudentResource;

class StudentsController extends Controller
{
    public function index()
    {
        return StudentResource::collection(Student::paginate(10));
    }
}
