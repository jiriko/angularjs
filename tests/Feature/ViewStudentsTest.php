<?php

namespace Tests\Feature;

use App\Enrollment;
use App\Student;
use App\Subject;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewStudentsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_can_fetch_all_students()
    {
        $student1 = create(Student::class);
        $student2 = create(Student::class);
        $subject = create(Subject::class, ['name' => 'Math 5']);
        Enrollment::create(['student_id' => $student1->id, 'subject_id' => $subject->id]);

        $response = $this->getJson('/api/students');

        $this->assertCount(2, $response->json()['data']);
        $this->assertCount(1, $response->json()['data'][0]['subjects']);
    }

    /** @test */
    function a_user_can_fetch_pagination_meta()
    {
        $student1 = create(Student::class);
        $student2 = create(Student::class);


        $this->getJson('/api/students')
            ->assertJsonStructure([
                'links' => [
                    'first',
                    'last',
                    'prev',
                    'next',
                ],
                'meta' => [
                    'current_page',
                    'from',
                    'last_page',
                    'path',
                    'per_page'
                ]
            ]);
    }
}
