@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <h2>Admin Dashboard</h2>
        <p class="text-muted">Welcome, {{ auth()->user()->full_name }}</p>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body text-center">
                <h5 class="card-title">Manage Courses</h5>
                <p class="card-text">Create, edit, and delete courses</p>
                <a href="{{ url('/admin/courses') }}" class="btn btn-primary">Go to Courses</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body text-center">
                <h5 class="card-title">Manage Users</h5>
                <p class="card-text">Create, edit, and delete users</p>
                <a href="{{ url('/admin/users') }}" class="btn btn-primary">Go to Users</a>
            </div>
        </div>
    </div>
</div>
@endsection