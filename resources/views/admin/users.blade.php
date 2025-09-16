@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manage Users</h2>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>
</div>

<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Role</th>
                    <th>Student Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->full_name }}</td>
                    <td>
                        <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : 'primary' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td>{{ $user->student->student_number ?? '-' }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="editUser({{ $user->user_id }}, '{{ $user->username }}', '{{ $user->full_name }}', '{{ $user->role }}', '{{ $user->student->student_number ?? '' }}', '{{ $user->student->entry_year ?? '' }}')">Edit</button>
                        <form method="POST" action="{{ route('users.destroy', $user) }}" class="d-inline" onsubmit="return confirm('Delete this user?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No users found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="full_name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select class="form-select" name="role" id="add_role" onchange="toggleStudentFields('add')" required>
                            <option value="">Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="student">Student</option>
                        </select>
                    </div>
                    <div id="add_student_fields" style="display: none;">
                        <div class="mb-3">
                            <label class="form-label">Student Number</label>
                            <input type="text" class="form-control" name="student_number">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Entry Year</label>
                            <input type="number" class="form-control" name="entry_year" min="2000" max="{{ date('Y') }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="editUserForm">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="edit_username" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="full_name" id="edit_full_name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select class="form-select" name="role" id="edit_role" onchange="toggleStudentFields('edit')" required>
                            <option value="admin">Admin</option>
                            <option value="student">Student</option>
                        </select>
                    </div>
                    <div id="edit_student_fields">
                        <div class="mb-3">
                            <label class="form-label">Student Number</label>
                            <input type="text" class="form-control" name="student_number" id="edit_student_number">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Entry Year</label>
                            <input type="number" class="form-control" name="entry_year" id="edit_entry_year" min="2000" max="{{ date('Y') }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Password (leave blank to keep current)</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleStudentFields(prefix) {
    const role = document.getElementById(prefix + '_role').value;
    const studentFields = document.getElementById(prefix + '_student_fields');
    studentFields.style.display = role === 'student' ? 'block' : 'none';
}

function editUser(id, username, fullName, role, studentNumber, entryYear) {
    document.getElementById('editUserForm').action = `/admin/users/${id}`;
    document.getElementById('edit_username').value = username;
    document.getElementById('edit_full_name').value = fullName;
    document.getElementById('edit_role').value = role;
    document.getElementById('edit_student_number').value = studentNumber;
    document.getElementById('edit_entry_year').value = entryYear;
    toggleStudentFields('edit');
    new bootstrap.Modal(document.getElementById('editUserModal')).show();
}
</script>
@endsection