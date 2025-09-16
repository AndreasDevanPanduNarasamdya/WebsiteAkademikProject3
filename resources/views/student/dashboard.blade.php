@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <h2>Student Dashboard</h2>
        <p class="text-muted">Welcome, {{ auth()->user()->full_name }}</p>
        
        @if(auth()->user()->student)
            <div class="alert alert-info">
                <strong>Student ID:</strong> {{ auth()->user()->student->student_number }}<br>
                <strong>Entry Year:</strong> {{ auth()->user()->student->entry_year }}
            </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body text-center">
                <h5 class="card-title">Course Enrollment</h5>
                <p class="card-text">View available courses and enroll in new ones</p>
                <a href="{{ url('/student/courses') }}" class="btn btn-primary">View Courses</a>
            </div>
        </div>
    </div>
</div>
@endsection