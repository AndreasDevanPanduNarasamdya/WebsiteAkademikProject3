<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Course::create([
            'course_code' => 'TI101',
            'course_name' => 'Programming Fundamentals',
            'description' => 'Basic programming concepts',
            'credits' => 3,
        ]);

        Course::create([
            'course_code' => 'TI201',
            'course_name' => 'Database Systems',
            'description' => 'Database design and implementation',
            'credits' => 3,
        ]);
    }
}
