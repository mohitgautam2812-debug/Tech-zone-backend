<x-app-layout>

    <div class="dashboard-header">
        <h4>Welcome back, {{ auth()->user()->name }}</h4>

        <div class="bg-white px-3 py-2 rounded shadow">
            Hi {{ auth()->user()->name }}
        </div>
    </div>



    <div class="card shadow-lg border-0 rounded-4 mb-4">

        <div class="p-4 text-white" style="background: linear-gradient(135deg,#6366f1,#8b5cf6);">

            <div class="d-flex align-items-center justify-content-between">

                <div>
                    <h4 class="mb-1">{{ auth()->user()->name }}</h4>
                    <p class="mb-0 opacity-75">{{ auth()->user()->email }}</p>

                    <span class="badge bg-light text-dark mt-2">
                        {{ auth()->user()->getRoleNames()->first() }}
                    </span>
                </div>

                <div class="text-end">
                    <div class="fs-1">👤</div>
                </div>

            </div>
        </div>

        <div class="p-3 bg-light d-flex justify-content-between">
            <span>📞 {{ auth()->user()->phone ?? 'Not Added' }}</span>


        </div>

    </div>


    <div class="card shadow border-0 rounded-4">

        <div class="p-3 text-white" style="background: linear-gradient(135deg,#4f46e5,#7c3aed);">
            <h5 class="mb-0">✏️ Edit Your Profile</h5>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('settings.update') }}">
                @csrf

                <div class="row g-3">

                    
                    <div class="col-md-6">
                        <label class="fw-semibold">Name</label>
                        <input type="text" name="name" value="{{ auth()->user()->name }}"
                            class="form-control rounded-3">
                    </div>


                    <div class="col-md-6">
                        <label class="fw-semibold">Phone</label>
                        <input type="text" name="phone" value="{{ auth()->user()->phone }}" maxlength="10"
                            class="form-control" oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,10);">
                    </div>


                    <div class="col-md-12">
                        <label class="fw-semibold">Email</label>
                        <input type="email" value="{{ auth()->user()->email }}" class="form-control bg-light" readonly>
                    </div>


                    <div class="col-md-6">
                        <label class="fw-semibold">New Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>


                    <div class="col-md-6">
                        <label class="fw-semibold">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>


                    <div class="col-md-4 mt-3">


                        <button class="btn btn-primary w-100 rounded-3 shadow">
                            💾 Update Profile
                        </button>
                    </div>

                </div>

            </form>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <div class="col-md-4 mt-3">

                    <button type="submit" class="btn btn-danger w-100 rounded-3 shadow-sm no">

                        <i class="fa-solid fa-right-from-bracket me-2"></i>
                        Logout

                    </button>

                </div>

            </form>
        </div>

    </div>

    </div>

    </div>

</x-app-layout>