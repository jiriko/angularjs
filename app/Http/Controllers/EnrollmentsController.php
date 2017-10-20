<?php

namespace App\Http\Controllers;

use App\Enrollment;
use Illuminate\Http\Request;

class EnrollmentsController extends Controller
{
    public function store()
    {
        Enrollment::create(
            request()->validate(
                [
                    'student_id' => 'required',
                    'subject_id' => 'required'
                ]
            )
        );

        return response([]);
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();

        return response([]);
    }
}
