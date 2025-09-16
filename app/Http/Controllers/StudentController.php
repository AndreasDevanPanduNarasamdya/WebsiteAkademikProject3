<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Takes;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function courses()
    {
        $courses = Course::all();
        $enrolledCourses = Takes::where('student_id', auth()->user()->student->student_id)
                               ->pluck('course_id')->toArray();
        
        return view('student.courses', compact('courses', 'enrolledCourses'));
    }

    public function enroll(Course $course)
    {
        Takes::create([
            'student_id' => auth()->user()->student->student_id,
            'course_id' => $course->course_id,
            'enroll_date' => now(),
            'status' => 'active'
        ]);

        return redirect()->back()->with('success', 'Enrolled successfully!');
    }
}