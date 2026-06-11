<x-app-layout>

  <div class="dashboard-header">
        <h4>Welcome back, {{ auth()->user()->name }}</h4>

        <div class="bg-white px-3 py-2 rounded shadow">
            Hi {{ auth()->user()->name }}
        </div>
    </div>


                <!-- HEADER -->
                <div class="p-3 text-white" style="background: linear-gradient(135deg,#4f46e5,#7c3aed);">
                    <h5 class="mb-0">➕ Add New User</h5>
                </div>

                <!-- BODY -->
                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{  route('users.store') }}">
                        @csrf

                        <div class="row g-3">

                            <!-- NAME -->
                            <div class="col-md-6">
                                <label class="fw-semibold">Full Name</label>
                                <input type="text" name="name" class="form-control rounded-3 shadow-sm"
                                    placeholder="Enter full name" required>
                            </div>

                            <!-- EMAIL -->
                            <div class="col-md-6">
                                <label class="fw-semibold">Email Address</label>
                                <input type="email" name="email" class="form-control rounded-3 shadow-sm"
                                    placeholder="Enter email" required>
                            </div>

                            <!-- PHONE -->
                            <div class="col-md-6">
                                <label class="fw-semibold">Phone</label>
                                <input type="text" name="phone" maxlength="10" class="form-control rounded-3 shadow-sm"
                                    placeholder="Enter phone number"
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,10);">
                            </div>

                            <!-- ROLE -->
                            <div class="col-md-6">
                                <label class="fw-semibold">Assign Role</label>
                                <select name="role" class="form-select rounded-3 shadow-sm">

                                    @foreach(\Spatie\Permission\Models\Role::all() as $role)
                                        <option value="{{ $role->name }}">
                                            {{ ucfirst($role->name) }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                            <!-- PASSWORD -->
                            <div class="col-md-6">
                                <label class="fw-semibold">Password</label>
                                <input type="password" name="password" class="form-control rounded-3 shadow-sm"
                                    placeholder="Enter password">
                            </div>


                            <div class="col-md-6">
                                <label class="fw-semibold">Confirm Password</label>
                                <input type="password" name="password_confirmation"
                                    class="form-control rounded-3 shadow-sm" placeholder="Confirm password">
                            </div>


                            <div class="col-12 mt-3">
                                <button class="btn btn-primary w-100 rounded-3 shadow">
                                    Create User
                                </button>
                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>