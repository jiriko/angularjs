<?php

use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = [
            'Math',
            'Science',
            'English',
            'Filipino',
            'Mapeh',
            'Geography',
            'Biology',
        ];

        foreach ($subjects as $subject) {
            \App\Subject::create(['name' => $subject]);
        }
    }
}
