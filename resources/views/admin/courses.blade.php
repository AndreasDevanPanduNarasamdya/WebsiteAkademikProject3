@extends('layouts.app')

@section('title', 'Manage Courses')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manage Courses</h2>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCourseModal">Add Course</button>
</div>

<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Credits</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($courses as $course)
                <tr>
                    <td>{{ $course->course_code }}</td>
                    <td>{{ $course->course_name }}</td>
                    <td>{{ $course->credits }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="editCourse({{ $course->course_id }}, '{{ $course->course_code }}', '{{ $course->course_name }}', '{{ $course->description }}', {{ $course->credits }})">Edit</button>
                        <form method="POST" action="{{ route('courses.destroy', $course) }}" class="d-inline" onsubmit="return confirm('Delete this course?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">No courses found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Add Course Modal -->
<div class="modal fade" id="addCourseModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('courses.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Course Code</label>
                        <input type="text" class="form-control" name="course_code" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Course Name</label>
                        <input type="text" class="form-control" name="course_name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Credits</label>
                        <input type="number" class="form-control" name="credits" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Add Course</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Course Modal -->
<div class="modal fade" id="editCourseModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="editCourseForm">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Course Code</label>
                        <input type="text" class="form-control" name="course_code" id="edit_course_code" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Course Name</label>
                        <input type="text" class="form-control" name="course_name" id="edit_course_name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="edit_description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Credits</label>
                        <input type="number" class="form-control" name="credits" id="edit_credits" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Course</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editCourse(id, code, name, description, credits) {
    document.getElementById('editCourseForm').action = `/admin/courses/${id}`;
    document.getElementById('edit_course_code').value = code;
    document.getElementById('edit_course_name').value = name;
    document.getElementById('edit_description').value = description;
    document.getElementById('edit_credits').value = credits;
    new bootstrap.Modal(document.getElementById('editCourseModal')).show();
}
</script>
@endsection