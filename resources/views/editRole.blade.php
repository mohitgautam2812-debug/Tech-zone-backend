<x-app-layout>

 <div class="dashboard-header">
        <h4>Welcome back, {{ auth()->user()->name }}</h4>

        <div class="bg-white px-3 py-2 rounded shadow">
            Hi {{ auth()->user()->name }}
        </div>
    </div>


                <div class="p-3 text-white"
                    style="background: linear-gradient(135deg,#f59e0b,#d97706);">
                    <h5 class="mb-0">✏️ Edit Role</h5>
                </div>

                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <p class="mb-0">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('roles.update', $role->id) }}">
                        @csrf

                        <div class="mb-3">
                            <label class="fw-semibold">Role Name</label>
                            <input type="text" name="name" value="{{ $role->name }}"
                                class="form-control">
                        </div>

                        <label class="fw-semibold mb-2">Permissions</label>

                        <div class="row" style="max-height:400px; overflow-y:auto;">

                            @foreach($permissions as $perm)
                                <div class="col-md-4 col-sm-6 mb-2">

                                    <label class="d-flex align-items-center gap-2 p-2 border rounded-3 w-100">

                                        <input type="checkbox"
                                            name="permissions[]"
                                            value="{{ $perm->name }}"
                                            {{ $role->hasPermissionTo($perm->name) ? 'checked' : '' }}>

                                        <span>
                                            {{ ucwords(str_replace('_', ' ', $perm->name)) }}
                                        </span>

                                    </label>

                                </div>
                            @endforeach

                        </div>

                        <div class="mt-4 d-flex gap-2">
                            <button class="btn btn-warning w-100">Update Role</button>
                            <a href="{{ route('roles.index') }}" class="btn btn-secondary w-100">Back</a>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</x-app-layout>