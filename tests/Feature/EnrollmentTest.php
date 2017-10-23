<?php

namespace Tests\Feature;

use App\Enrollment;
use App\Student;
use App\Subject;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EnrollmentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function students_can_enroll_to_subjects()
    {
        $student = create(Student::class);
        $subject1 = create(Subject::class, ['name' => 'Chemistry']);

        $response = $this->post('api/enrollments', ['student_id' => $student->id, 'subject_id' => $subject1->id]);

        $response->assertStatus(200);
        $this->assertEquals($subject1->id, $student->subjects->first()->id);
    }

    /** @test */
    function students_can_unenroll_a_subject()
    {
        $student = create(Student::class);
        $subject1 = create(Subject::class, ['name' => 'Chemistry']);
        $enrollment = Enrollment::create(['subject_id' => $subject1->id, 'student_id' => $student->id]);

        $this->assertEquals($subject1->id, $student->subjects->first()->id);

        $response = $this->delete('api/enrollments/' . $enrollment->id);

        $response->assertStatus(200);
        $this->assertEmpty($student->fresh()->subjects);
    }
}
