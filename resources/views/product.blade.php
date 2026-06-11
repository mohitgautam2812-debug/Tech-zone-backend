<x-app-layout>
    <div class="dashboard-header">
        <h4>Welcome back, {{ auth()->user()->name }}</h4>

        <div class="bg-white px-3 py-2 rounded shadow">
            Hi {{ auth()->user()->name }}
        </div>
    </div>


    <div class="p-3 text-white" style="background: linear-gradient(135deg,#4f46e5,#7c3aed);">
        <h5 class="mb-0">All Products</h5>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0">

            <thead class="bg-light">
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Owner</th>
                    <th>Actions</th>
                    <th>Order</th>
                </tr>
            </thead>

            <tbody>
                @foreach($products as $product)
                    <tr class="hover-row">

                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <img src="{{ asset('storage/' . $product->image) }}" width="50" class="rounded shadow-sm">
                        </td>

                        <td>{{ $product->name }}</td>

                        <td>{{ $product->category->name ?? '-' }}</td>

                        <td class="text-success fw-bold">₹{{ $product->price }}</td>

                        <td>
                            <span
                                class="badge 
                                                                                                                                                    {{ $product->status == 'approved' ? 'bg-success' : 'bg-warning' }}">
                                {{ $product->status }}
                            </span>
                        </td>

                        <td>{{ $product->user->name ?? '-' }}</td>

                        <td>


                            {{-- ADMIN STATUS TOGGLE --}}
                            @if(auth()->user()->hasRole('admin'))

                                @if($product->status == 'unapproved')

                                    <form action="{{ route('products.update', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="approved">
                                        <button class="btn btn-sm btn-outline-success">Approve</button>
                                    </form>

                                @else

                                    <form action="{{ route('products.update', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="unapproved">
                                        <button class="btn btn-sm btn-outline-warning">Unapprove</button>
                                    </form>

                                @endif

                            @endif

                            @if(auth()->user()->hasRole('admin') && $product->user_id == auth()->id())

                                <button class="btn btn-sm btn-outline-primary" onclick="openEditModal(

                                                                            {{ $product->id }},

                                                                            '{{ $product->name }}',

                                                                            '{{ $product->price }}',

                                                                            `{{ $product->description }}`,

                                                                            '{{ $product->category_id }}',

                                                                            '{{ $product->stock }}',

                                                                            '{{ $product->discount_price }}',

                                                                            '{{ $product->is_featured }}',

                                                                            '{{ $product->is_active }}',

                                                                            '{{ $product->image }}',

                                                                            '{{ $product->brand }}',

                                                                            '{{ $product->storage }}',

                                                                            '{{ $product->color }}',

                                                                            '{{ $product->display_size }}',



                                                                                '{{ $product->condition }}',

                                                                            '{{ $product->rating }}',

                                                                            '{{ $product->short_title }}',

                                                                            '{{ $product->sku }}',

                                                                            '{{ $product->warranty }}',

                                                                            `{{ $product->box_contents }}`,

                                                                            `{{ $product->key_features }}`,

                                                                            `{{ $product->specifications }}`

                                                                        )">

                                    Edit

                                </button>

                            @endif


                            @if(
                                    auth()->user()->hasRole('admin') ||
                                    (auth()->user()->hasRole('agent') && $product->user_id == auth()->id())
                                )
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            @endif


                        </td>

                        <td>
                            <form action="{{ route('orders.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">

                                <button class="btn btn-success btn-sm">
                                    🛒 Order Now
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
    </div>

    </div>
    </div>


    <!-- 🔥 EDIT MODAL -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">

            <form method="POST" id="editForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

                    <!-- HEADER -->
                    <div class="modal-header text-white" style="background: linear-gradient(135deg,#4f46e5,#7c3aed);">
                        <h5 class="fw-bold mb-0">✏️ Edit Product</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- BODY -->
                    <div class="modal-body p-4">

                        <div class="row g-3">

                            <!-- NAME -->
                            <div class="col-md-6">
                                <label class="small text-muted">Product Name</label>
                                <input type="text" name="name" id="editName" class="form-control rounded-3 shadow-sm">
                            </div>

                            <!-- PRICE -->
                            <div class="col-md-6">
                                <label class="small text-muted">Price</label>
                                <input type="number" name="price" id="editPrice"
                                    class="form-control rounded-3 shadow-sm">
                            </div>

                            <!-- STOCK -->
                            <div class="col-md-6">
                                <label class="small text-muted">Stock</label>
                                <input type="number" name="stock" id="editStock"
                                    class="form-control rounded-3 shadow-sm">
                            </div>

                            <!-- CATEGORY -->
                            <div class="col-md-6">
                                <label class="small text-muted">Category</label>
                                <select name="category_id" id="editCategory" class="form-select rounded-3 shadow-sm">
                                    @foreach(\App\Models\Category::all() as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- BRAND -->
                            <div class="col-md-6">
                                <label class="small text-muted">Brand</label>
                                <input type="text" name="brand" id="editBrand" class="form-control rounded-3 shadow-sm">
                            </div>

                            <!-- STORAGE -->
                            <div class="col-md-6">
                                <label class="small text-muted">Storage</label>
                                <input type="text" name="storage" id="editStorage"
                                    class="form-control rounded-3 shadow-sm">
                            </div>

                            <!-- COLOR -->
                            <div class="col-md-6">
                                <label class="small text-muted">Color</label>
                                <input type="text" name="color" id="editColor" class="form-control rounded-3 shadow-sm">
                            </div>

                            <!-- DISPLAY SIZE -->
                            <div class="col-md-6">
                                <label class="small text-muted">Display Size</label>
                                <input type="text" name="display_size" id="editDisplay"
                                    class="form-control rounded-3 shadow-sm">
                            </div>

                            <!-- CONDITION -->
                            <div class="col-md-6">
                                <label class="small text-muted">Condition</label>

                                <select name="condition" id="editCondition" class="form-select rounded-3 shadow-sm">

                                    <option value="New">New</option>

                                    <option value="Used">Used</option>

                                    <option value="Refurbished">Refurbished</option>

                                </select>
                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="small text-muted">
                                    Rating
                                </label>

                                <input type="number" step="0.1" min="0" max="5" name="rating" id="editRating"
                                    class="form-control rounded-3 shadow-sm">

                            </div>


                            <!-- SHORT TITLE -->
                            <div class="col-md-6">
                                <label class="small text-muted">
                                    Short Title
                                </label>

                                <input type="text" name="short_title" id="editShortTitle"
                                    class="form-control rounded-3 shadow-sm">
                            </div>

                            <!-- SKU -->
                            <div class="col-md-6">
                                <label class="small text-muted">
                                    SKU
                                </label>

                                <input type="text" name="sku" id="editSku" class="form-control rounded-3 shadow-sm">
                            </div>

                            <!-- WARRANTY -->
                            <div class="col-md-6">
                                <label class="small text-muted">
                                    Warranty
                                </label>

                                <input type="text" name="warranty" id="editWarranty"
                                    class="form-control rounded-3 shadow-sm">
                            </div>

                            <!-- BOX CONTENTS -->
                            <div class="col-md-6">
                                <label class="small text-muted">
                                    Box Contents
                                </label>

                                <input type="text" name="box_contents" id="editBoxContents"
                                    class="form-control rounded-3 shadow-sm">
                            </div>

                            <!-- KEY FEATURES -->
                            <div class="col-12">
                                <label class="small text-muted">
                                    Key Features
                                </label>

                                <textarea name="key_features" id="editKeyFeatures" rows="4"
                                    class="form-control rounded-3 shadow-sm"></textarea>
                            </div>

                            <!-- SPECIFICATIONS -->
                            <div class="col-12">
                                <label class="small text-muted">
                                    Specifications
                                </label>

                                <textarea name="specifications" id="editSpecifications" rows="4"
                                    class="form-control rounded-3 shadow-sm"></textarea>
                            </div>

                            <!-- DESCRIPTION -->
                            <div class="col-12">
                                <label class="small text-muted">Description</label>
                                <textarea name="description" id="editDesc" class="form-control rounded-3 shadow-sm"
                                    rows="3"></textarea>
                            </div>

                            <!-- DISCOUNT -->
                            <div class="col-12">
                                <label class="small text-muted">Discount Price</label>
                                <input type="number" name="discount_price" id="editDiscount"
                                    class="form-control rounded-3 shadow-sm">
                            </div>

                            <!-- CHECKBOXES -->
                            <div class="col-md-6 form-check mt-2">
                                <input type="checkbox" name="is_featured" id="editFeatured" class="form-check-input">
                                <label class="form-check-label">Featured</label>
                            </div>

                            <div class="col-md-6 form-check mt-2">
                                <input type="checkbox" name="is_active" id="editActive" class="form-check-input">
                                <label class="form-check-label">Active</label>
                            </div>

                            <!-- IMAGE PREVIEW -->
                            <div class="col-12 text-center mt-3">
                                <img id="currentImage" src="" class="img-fluid rounded shadow-sm"
                                    style="max-height:140px; cursor:pointer;"
                                    onclick="document.getElementById('editImageInput').click()">


                                <br>
                                <small class="text-muted">Click image to change</small>

                                <div class="mt-3 text-center">

                                    <button type="button" class="btn btn-outline-primary"
                                        onclick="document.getElementById('editGalleryInput').click()">

                                        Change Gallery Images

                                    </button>

                                </div>
                            </div>


                            <!-- FILE INPUT (HIDDEN) -->
                            <input type="file" name="image" id="editImageInput" hidden>

                            <!-- GALLERY IMAGES -->
                            <input type="file" name="images[]" id="editGalleryInput" multiple hidden>

                        </div>

                    </div>

                    <div class="modal-footer border-0">

                        <button type="button" class="btn btn-light border rounded-3 px-4" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button class="btn text-white px-4 rounded-3"
                            style="background: linear-gradient(135deg,#4f46e5,#7c3aed);">
                            💾 Update
                        </button>

                    </div>

                </div>
            </form>

        </div>
    </div>

    <style>
        .hover-row:hover {
            background: #f1f5f9;
            transition: 0.2s;
        }
    </style>

    <script>
        function openEditModal(
            id,
            name,
            price,
            desc,
            category_id,
            stock,
            discount,
            featured,
            active,
            image,
            brand,
            storage,
            color,
            display_size,
            condition,
            rating,
            short_title,
            sku,
            warranty,
            box_contents,
            key_features,
            specifications
        ) {

            document.getElementById('editName').value = name;

            document.getElementById('editPrice').value = price;

            document.getElementById('editDesc').value = desc;

            document.getElementById('editStock').value = stock;

            document.getElementById('editCategory').value = category_id;

            document.getElementById('editDiscount').value = discount ?? '';



            document.getElementById('editBrand').value =
                brand ?? '';

            document.getElementById('editStorage').value =
                storage ?? '';

            document.getElementById('editColor').value =
                color ?? '';

            document.getElementById('editDisplay').value =
                display_size ?? '';

            document.getElementById('editCondition').value =
                condition ?? 'New';


            document.getElementById('editRating').value =
                rating ?? 0;
            document.getElementById('editShortTitle').value =
                short_title ?? '';

            document.getElementById('editSku').value =
                sku ?? '';

            document.getElementById('editWarranty').value =
                warranty ?? '';

            document.getElementById('editBoxContents').value =
                box_contents ?? '';

            document.getElementById('editKeyFeatures').value =
                key_features ?? '';

            document.getElementById('editSpecifications').value =
                specifications ?? '';

            document.getElementById('editFeatured').checked =
                featured == 1;

            document.getElementById('editActive').checked =
                active == 1;



            document.getElementById('currentImage').src =
                `/storage/${image}`;


            document.getElementById('editForm').action =
                `/products/${id}`;



            new bootstrap.Modal(
                document.getElementById('editModal')
            ).show();
        }
    </script>


</x-app-layout>