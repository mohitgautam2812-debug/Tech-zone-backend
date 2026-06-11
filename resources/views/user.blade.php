<x-app-layout>
    <div class="dashboard-header">
        <h4>Welcome back, {{ auth()->user()->name }}</h4>

        <div class="bg-white px-3 py-2 rounded shadow">
            Hi {{ auth()->user()->name }}
        </div>
    </div>


    <div class="flex-grow-1 p-4">

        <h4 class="mb-3">⭐ Agents Dashboard</h4>

        <div class="card shadow rounded-4 border-0">

            <!-- HEADER --> 
            <div class="p-3 text-white" style="background: linear-gradient(135deg,#4f46e5,#7c3aed);">
                <h5 class="mb-0">All Agents</h5>
            </div>

            <!-- TABLE -->
            <div class="card-body p-2">

                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $user)


                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td class="fw-semibold">{{ $user->name }}</td>

                                    <td>{{ $user->email }}</td>

                                    <!-- STATUS -->
                                    <td>
                                        <span class="badge {{ $user->is_approved ? 'bg-success' : 'bg-warning text-dark' }}">
                                            {{ $user->is_approved ? 'Approved' : 'Pending' }}
                                        </span>
                                    </td>

                                    <td>{{ $user->created_at->format('d M Y') }}</td>

                                    <!-- ACTION -->
                                    <td>

                                        @if(auth()->user()->hasRole('admin'))

                                            <form action="{{ route('users.status', $user->id) }}" method="POST" class="d-inline">
                                                @csrf

                                                @if(!$user->is_approved)
                                                    <button class="btn btn-sm btn-success">
                                                        ✔ Approve
                                                    </button>
                                                @else
                                                    <button class="btn btn-sm btn-warning">
                                                        Unapprove
                                                    </button>
                                                @endif
                                            </form>

                                       
                                        <button class="btn btn-sm btn-primary" onclick="openEditModal(
                                                                                {{ $user->id }},
                                                                                '{{ $user->name }}',
                                                                                '{{ $user->email }}',
                                                                                '{{ $user->phone }}',
                                                                                {{ $user->is_approved }}
                                                                            )">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            @endif

                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>

    </div>
    </div>
    <!-- EDIT MODAL -->
    <div class="modal fade" id="editUserModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" id="editUserForm">
                @csrf
                @method('PUT')

                <div class="modal-content rounded-4">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <!-- Name -->
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" id="edit_name" class="form-control">
                        </div>

                        <!-- Email (READ ONLY) -->
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" id="edit_email" class="form-control" readonly>
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label>Phone</label>
                            <input type="text" name="phone" id="edit_phone" class="form-control">
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label>Status</label>
                            <select name="is_approved" id="edit_status" class="form-select">
                                <option value="1">Approved</option>
                                <option value="0">Pending</option>
                                <option value="0">Unapproved</option>
                            </select>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label>New Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-success">Update</button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, name, email, phone, status) {

            document.getElementById('edit_name').value = name;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_phone').value = phone ?? '';
            document.getElementById('edit_status').value = status;

            document.getElementById('editUserForm').action = `/users/${id}`;

            new bootstrap.Modal(document.getElementById('editUserModal')).show();
        }
    </script>
</x-app-layout>