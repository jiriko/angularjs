<?php

use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Student::class, 20)->create()->each(function ($student) {
            \App\Enrollment::create([
                'student_id' => $student->id,
                'subject_id' => 1
            ]);

            \App\Enrollment::create([
                'student_id' => $student->id,
                'subject_id' => 2
            ]);

            \App\Enrollment::create([
                'student_id' => $student->id,
                'subject_id' => 3
            ]);

            \App\Enrollment::create([
                'student_id' => $student->id,
                'subject_id' => 4
            ]);
        });
    }
}
