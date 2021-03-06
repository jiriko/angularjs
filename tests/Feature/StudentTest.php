<?php

namespace Tests\Feature;

use App\Enrollment;
use App\Student;
use App\Subject;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_can_create_a_student()
    {
        $student = [
            'name' => 'Jiriko Lapa',
            'email' => 'jiriko@yahoo.com'
        ];

        $this->post('/api/students', $student)->assertStatus(201);

        $this->assertDatabaseHas('students', $student);
    }

    /** @test */
    function a_user_can_update_a_student()
    {
        $student = create(Student::class);
        $newName = 'New Name';

        $this->json('PUT', '/api/students/' . $student->id, [
            'name' => $newName,
            'email' => $student->email
        ])->assertStatus(200);

        $this->assertEquals($newName, $student->fresh()->name);
    }

    /** @test */
    function a_user_can_delete_a_student()
    {
        $student = create(Student::class);

        $this->json('DELETE', '/api/students/' . $student->id)
            ->assertStatus(200);

        $this->assertDatabaseMissing('students',
            [
                'id' => $student->id
            ]);
    }

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
