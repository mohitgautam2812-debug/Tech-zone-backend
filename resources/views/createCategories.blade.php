<x-app-layout>

    <div class="container-fluid py-4">

        <!-- PAGE HEADER -->

        <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-4">

            <div class="p-3 text-white" style="background: linear-gradient(135deg,#4f46e5,#7c3aed);">

                <div class="d-flex justify-content-between align-items-center flex-wrap">

                    <div>

                        <h1 class="fw-bold mb-2">

                            <i class="fa-solid fa-layer-group me-2"></i>

                            Categories Management

                        </h1>

                        <p class="mb-0 opacity-75">

                            Manage your categories professionally

                        </p>

                    </div>

                    <div class="bg-white text-dark px-4 py-2 rounded-4 shadow-sm">

                        <h3 class="mb-0 fw-bold">

                            {{ $categories->count() }}

                        </h3>

                        <small>Total Categories</small>

                    </div>

                </div>

            </div>

        </div>



        <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-4">



            <div class="p-3 text-white" style="background: linear-gradient(135deg,#0ea5e9,#2563eb);">

                <h4 class="mb-0 fw-bold">

                    <i class="fa-solid fa-plus me-2"></i>

                    {{ isset($editCategory) ? 'Edit Category' : 'Add New Category' }}

                </h4>

            </div>



            <div class="card-body p-4">

                @if(session('success'))

                    <div class="alert alert-success rounded-4">

                        {{ session('success') }}

                    </div>

                @endif

                @if ($errors->any())

                    <div class="alert alert-danger rounded-4">

                        @foreach ($errors->all() as $error)

                            <p class="mb-0">{{ $error }}</p>

                        @endforeach

                    </div>

                @endif

                <form method="POST" enctype="multipart/form-data"
                    action="{{ isset($editCategory) ? route('categories.update', $editCategory->id) : route('categories.store') }}">
                    @csrf

                    @if(isset($editCategory))
                        @method('PUT')
                    @endif

                    <div class="row align-items-end">



                        <div class="row align-items-end">

                            <!-- CATEGORY NAME -->

                            <div class="col-lg-6 mb-3">

                                <label class="fw-semibold mb-2">
                                    Category Name
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light">
                                        <i class="fa-solid fa-tag"></i>
                                    </span>

                                    <input type="text" name="name" class="form-control py-3"
                                        placeholder="Enter category name"
                                        value="{{ isset($editCategory) ? $editCategory->name : '' }}">

                                </div>

                            </div>

                            <!-- CATEGORY IMAGE -->

                            <div class="col-lg-6 mb-3">

                                <label class="fw-semibold mb-2">
                                    Category Image
                                </label>

                                <input type="file" name="image" class="form-control py-3">

                                @if(isset($editCategory) && $editCategory->image)

                                    <img src="{{ asset('storage/' . $editCategory->image) }}" alt=""
                                        class="mt-3 rounded-3 border" style="width:80px;height:80px;object-fit:cover;">

                                @endif

                            </div>


                            <div class="col-lg-3 mb-3">

                                <button class="btn btn-primary w-100 py-3 rounded-3 fw-semibold shadow-sm">

                                    <i class="fa-solid fa-floppy-disk me-2"></i>

                                    Save

                                </button>

                            </div>

                        </div>





                    </div>

                </form>

            </div>

        </div>

        <!-- TABLE CARD -->

        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

            <!-- TABLE HEADER -->

            <div class="p-3 text-white d-flex justify-content-between align-items-center"
                style="background: linear-gradient(135deg,#10b981,#059669);">

                <h4 class="mb-0 fw-bold">

                    <i class="fa-solid fa-list me-2"></i>

                    Categories List

                </h4>

                <span class="badge bg-light text-dark px-3 py-2 rounded-pill">

                    {{ $categories->count() }} Records

                </span>

            </div>

            <!-- TABLE BODY -->

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th class="ps-4">#</th>

                                <th>Name</th>
                                <th>Image</th>


                                <th class="text-center">Actions</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($categories as $category)

                                <tr>

                                    <td class="ps-4 fw-bold">

                                        {{ $category->id }}

                                    </td>

                                    <td>

                                        <div class="d-flex align-items-center gap-2">

                                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                                style="width:40px;height:40px;">

                                                <i class="fa-solid fa-folder"></i>

                                            </div>

                                            <div class="fw-semibold">

                                                {{ $category->name }}

                                            </div>

                                        </div>

                                    </td>

                                    <td>



                                        @if($category->image)

                                            <img src="{{ asset('storage/' . $category->image) }}" alt="" class="rounded-3"
                                                style="width:60px;height:60px;object-fit:cover;">

                                        @else

                                            <div class="bg-light rounded-3 d-flex align-items-center justify-content-center"
                                                style="width:60px;height:60px;">

                                                <i class="fa-solid fa-image text-muted"></i>

                                            </div>

                                        @endif



                                    </td>

                                    <td>

                                        <div class="d-flex justify-content-center gap-2">



                                            <a href="{{ route('categories.edit', $category->id) }}"
                                                class="btn btn-warning btn-sm rounded-3 shadow-sm">

                                                <i class="fa-solid fa-pen-to-square"></i>

                                            </a>



                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">

                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-danger btn-sm rounded-3 shadow-sm"
                                                    onclick="return confirm('Delete this category?')">

                                                    <i class="fa-solid fa-trash"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4" class="text-center py-5">

                                        <div class="text-muted">

                                            <i class="fa-solid fa-box-open fa-3x mb-3"></i>

                                            <h5>No Categories Found</h5>

                                            <p class="mb-0">

                                                Start by adding your first category

                                            </p>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>