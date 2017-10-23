<?php

namespace Tests\Feature;

use App\Subject;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_can_fetch_all_subjects()
    {
        $subject = create(Subject::class, ['name' => 'Math 5']);
        $subject2 = create(Subject::class, ['name' => 'Math 3']);
        $subject3 = create(Subject::class, ['name' => 'Math 2']);

        $response = $this->getJson('/api/subjects');

        $this->assertCount(3, $response->json()['data']);
        $this->assertEquals(
            [
                'id' => $subject->id,
                'name' => $subject->name
            ],
            $response->json()['data'][0]
        );
    }

    /** @test */
    function a_user_can_filter_for_subjects()
    {
        $subject = create(Subject::class, ['name' => 'Math 5']);
        $subject2 = create(Subject::class, ['name' => 'English 3']);
        $subject3 = create(Subject::class, ['name' => 'Mapeh 2']);

        $response = $this->getJson('/api/subjects?name=Ma');
        $this->assertCount(2, $response->json()['data']);

        $this->assertNotContains(
            [
                'id' => $subject2->id,
                'name' => $subject2->name
            ],
            $response->json()['data']);

        $this->assertContains(
            [
                'id' => $subject3->id,
                'name' => $subject3->name
            ],
            $response->json()['data']
        );

        $this->assertContains(
            [
                'id' => $subject->id,
                'name' => $subject->name
            ],
            $response->json()['data']
        );
    }
}
