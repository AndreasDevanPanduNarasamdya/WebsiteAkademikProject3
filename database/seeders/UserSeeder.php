<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create admin user
        $adminUser = User::create([
            'username' => 'admin',
            'full_name' => 'Administrator',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create student user
        $studentUser = User::create([
            'username' => 'Raihanaaaz',
            'full_name' => 'Raihana Aisha Az-Zahra',
            'password' => Hash::make('raihana123'),
            'role' => 'student',
        ]);

        // Create student record
        Student::create([
            'user_id' => $studentUser->user_id,
            'student_number' => '241511056',
            'entry_year' => 2024,
        ]);
    }
}
