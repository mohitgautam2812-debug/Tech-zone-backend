<x-app-layout>

    <div class="container-fluid p-2">

        <!-- HEADER -->

        <div class="rounded-2 overflow-hidden  mb-4">

            <div class="p-2 text-white" style="background: linear-gradient(135deg,#0f172a,#1e293b,#334155);">

                <h1 class="fw-medium display-4 fs-5 mb-2 text-center">

                    <i class="fa-solid fa-layer-group me-1"></i>

                    Manage Categories

                </h1>

                <p class="mb-0 fs-5 opacity-75 text-center">

                    Create and manage categories professionally

                </p>

            </div>

        </div>

        <!-- FORM -->

        <div class="card border-0 shadow-sm rounded-5 mb-4">

            <div class="card-body p-4 bg-white">

                @if(session('success'))

                    <div class="alert alert-success border-0 rounded-4">

                        <i class="fa-solid fa-circle-check me-2"></i>

                        {{ session('success') }}

                    </div>

                @endif

                @if ($errors->any())

                    <div class="alert alert-danger border-0 rounded-4">

                        @foreach ($errors->all() as $error)

                            <div>

                                <i class="fa-solid fa-circle-exclamation me-2"></i>

                                {{ $error }}

                            </div>

                        @endforeach

                    </div>

                @endif

                <form method="POST" enctype="multipart/form-data"
                    action="{{ isset($editCategory) ? route('categories.update', $editCategory->id) : route('categories.store') }}">
                    @csrf

                    @if(isset($editCategory))
                        @method('PUT')
                    @endif

                    <div class="row align-items-end g-3">

                        <!-- CATEGORY NAME -->

                        <div class="col-lg-6">

                            <label class="fw-semibold mb-2">
                                Category Name
                            </label>

                            <input type="text" name="name"
                                value="{{ isset($editCategory) ? old('name', $editCategory->name) : old('name') }}"
                                class="form-control rounded-4 border-0 shadow-sm py-3 px-4"
                                placeholder="Enter category name">

                        </div>

                        <!-- CATEGORY IMAGE -->

                        <div class="col-lg-4">

                            <label class="fw-semibold mb-2">
                                Category Image
                            </label>

                            <input type="file" name="image" class="form-control rounded-4 border-0 shadow-sm py-3 px-4">

                            @if(isset($editCategory) && $editCategory->image)

                                <img src="{{ asset('storage/' . $editCategory->image) }}" alt=""
                                    class="mt-3 rounded-4 border shadow-sm"
                                    style="width:80px;height:80px;object-fit:cover;">

                            @endif

                        </div>

                       
                        <div class="col-lg-2">

                            <button class="btn btn-dark w-100 py-3 rounded-4 fw-semibold shadow-sm">

                                <i class="fa-solid fa-floppy-disk me-2"></i>

                                {{ isset($editCategory) ? 'Update' : 'Save' }}

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>



    </div>

</x-app-layout>