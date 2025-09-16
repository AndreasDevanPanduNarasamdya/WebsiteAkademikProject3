@extends('layouts.app')

@section('title', 'My Courses')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Available Courses</h2>
</div>

<div class="row">
    @forelse($courses as $course)
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $course->course_name }}</h5>
                    <p class="card-text">
                        <strong>Code:</strong> {{ $course->course_code }}<br>
                        <strong>Credits:</strong> {{ $course->credits }}<br>
                        @if($course->description)
                            <strong>Description:</strong> {{ $course->description }}
                        @endif
                    </p>
                    
                    @if(in_array($course->course_id, $enrolledCourses))
                        <button class="btn btn-success disabled">
                            <i class="bi bi-check-circle"></i> Enrolled
                        </button>
                        <small class="text-muted d-block mt-1">You are enrolled in this course</small>
                    @else
                        <form method="POST" action="{{ route('student.enroll', $course) }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary" onclick="return confirm('Enroll in this course?')">
                                <i class="bi bi-plus-circle"></i> Enroll
                            </button>
                        </form>
                        <small class="text-muted d-block mt-1">Click to enroll in this course</small>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                <h5>No Courses Available</h5>
                <p>There are currently no courses available for enrollment.</p>
            </div>
        </div>
    @endforelse
</div>

<!-- Enrolled Courses Section -->
@if(!empty($enrolledCourses))
<div class="mt-5">
    <h3>My Enrolled Courses</h3>
    <div class="card">
        <div class="card-body">
            <div class="row">
                @foreach($courses->whereIn('course_id', $enrolledCourses) as $enrolledCourse)
                    <div class="col-md-4 mb-3">
                        <div class="card border-success">
                            <div class="card-body">
                                <h6 class="card-title">{{ $enrolledCourse->course_name }}</h6>
                                <p class="card-text">
                                    <small class="text-muted">{{ $enrolledCourse->course_code }} • {{ $enrolledCourse->credits }} Credits</small>
                                </p>
                                <span class="badge bg-success">Active</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif
@endsection