<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Akademika')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Akademika</a>
            
            @auth
                <div class="navbar-nav ms-auto">
                    @if(auth()->user()->role === 'admin')
                        <a class="nav-link" href="{{ url('/admin/courses') }}">Courses</a>
                        <a class="nav-link" href="{{ url('/admin/users') }}">Users</a>
                    @else
                        <a class="nav-link" href="{{ url('/student/courses') }}">My Courses</a>
                    @endif
                    
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            {{ auth()->user()->full_name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" onclick="document.getElementById('logout-form').submit();">Logout</a></li>
                        </ul>
                    </div>
                </div>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endauth
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <!-- Success Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>