<x-app-layout>

    <style>
        body {
            background: #f5f7fb;
        }

        .page-title {
            font-size: 30px;
            font-weight: 700;
            color: #111827;
        }

        .main-card {
            border: none;
            border-radius: 28px;
            overflow: hidden;
            background: #fff;

            box-shadow:
                0 10px 40px rgba(0, 0, 0, 0.06);
        }

        .main-card .card-body {
            padding: 35px;
        }

        .gradient-header {
            background: linear-gradient(135deg,
                    #2563eb,
                    #7c3aed);

            border-radius: 24px;
            padding: 28px;
            margin-bottom: 30px;
            color: #fff;
        }

        .gradient-header h3 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .gradient-header p {
            margin: 0;
            opacity: 0.9;
        }

        .modern-label {
            font-size: 13px;
            font-weight: 700;
            color: #374151;
            margin-bottom: 8px;
            display: block;
        }

        .modern-input,
        .modern-select,
        .modern-textarea {

            border: 1px solid #e5e7eb !important;
            border-radius: 16px !important;
            padding: 14px 16px !important;
            background: #f9fafb !important;
            transition: 0.3s ease;
            box-shadow: none !important;
        }

        .modern-input:focus,
        .modern-select:focus,
        .modern-textarea:focus {

            background: #fff !important;

            border-color: #2563eb !important;

            box-shadow:
                0 0 0 4px rgba(37, 99, 235, 0.10) !important;
        }

        .modern-textarea {
            resize: none;
        }

        .field-box {

            background: #fff;
            border: 1px solid #f1f5f9;
            border-radius: 22px;
            padding: 20px;
            transition: 0.25s ease;
            height: 100%;
        }

        .field-box:hover {

            transform: translateY(-2px);

            box-shadow:
                0 10px 20px rgba(0, 0, 0, 0.05);
        }

        .side-card {

            background: #fff;
            border-radius: 24px;
            padding: 24px;
            border: 1px solid #eef2f7;

            box-shadow:
                0 10px 25px rgba(0, 0, 0, 0.05);
        }

        .save-btn {

            background: linear-gradient(135deg,
                    #2563eb,
                    #7c3aed);

            border: none;
            color: #fff;
            padding: 14px 34px;
            border-radius: 16px;
            font-weight: 700;
            font-size: 15px;
            transition: 0.3s ease;
        }

        .save-btn:hover {

            transform: translateY(-2px);

            box-shadow:
                0 10px 20px rgba(37, 99, 235, 0.25);
        }

        .back-btn {
            border-radius: 14px;
            padding: 10px 20px;
            font-weight: 600;
        }

        .preview-box {
            background: #f9fafb;
            border-radius: 20px;
            padding: 20px;
            text-align: center;
            border: 2px dashed #d1d5db;
        }

        .preview-box img {
            max-height: 180px;
            border-radius: 18px;
            object-fit: cover;
        }

        .success-alert {

            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #10b981;
            padding: 16px 20px;
            border-radius: 18px;
            margin-bottom: 24px;
            font-weight: 600;
        }
    </style>

    <div class="container py-4">

        <!-- SUCCESS MESSAGE -->
        @if(session('success'))

            <div class="success-alert">
                ✅ {{ session('success') }}
            </div>

        @endif

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="page-title">
                    Add New Product
                </h2>
            </div>

            <a href="{{ route('products.index') }}" class="btn btn-secondary back-btn">

                ← Back

            </a>

        </div>

        <div class="card main-card">

            <div class="card-body">

                <div class="gradient-header">

                    <h3>
                        Product Management
                    </h3>

                    <p>
                        Add professional product details for your ecommerce website
                    </p>

                </div>

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="row g-4">

                        <!-- LEFT SIDE -->
                        <div class="col-lg-8">

                            <div class="row g-4">

                                <!-- PRODUCT NAME -->
                                <div class="col-12">
                                    <div class="field-box">

                                        <label class="modern-label">
                                            Product Name
                                        </label>

                                        <input type="text" name="name" class="form-control modern-input"
                                            placeholder="Enter Product Name">

                                    </div>
                                </div>

                                <!-- PRICE -->
                                <div class="col-md-6">
                                    <div class="field-box">

                                        <label class="modern-label">
                                            Price
                                        </label>

                                        <input type="number" name="price" class="form-control modern-input"
                                            placeholder="₹ Enter Price">

                                    </div>
                                </div>

                                <!-- DISCOUNT PRICE -->
                                <div class="col-md-6">
                                    <div class="field-box">

                                        <label class="modern-label">
                                            Discount Price
                                        </label>

                                        <input type="number" name="discount_price" class="form-control modern-input"
                                            placeholder="₹ Discount Price">

                                    </div>
                                </div>

                                <!-- CATEGORY -->
                                <div class="col-md-6">
                                    <div class="field-box">

                                        <label class="modern-label">
                                            Category
                                        </label>

                                        <select name="category_id" class="form-select modern-select">

                                            <option value="">
                                                Select Category
                                            </option>

                                            @foreach($categories as $cat)

                                                <option value="{{ $cat->id }}">
                                                    {{ $cat->name }}
                                                </option>

                                            @endforeach

                                        </select>

                                    </div>
                                </div>

                                <!-- BRAND -->
                                <div class="col-md-6">
                                    <div class="field-box">

                                        <label class="modern-label">
                                            Brand
                                        </label>

                                        <input type="text" name="brand" class="form-control modern-input"
                                            placeholder="Samsung">

                                    </div>
                                </div>

                                <!-- STORAGE -->
                                <div class="col-md-6">
                                    <div class="field-box">

                                        <label class="modern-label">
                                            Storage
                                        </label>

                                        <input type="text" name="storage" class="form-control modern-input"
                                            placeholder="128GB">

                                    </div>
                                </div>

                                <!-- COLOR -->
                                <div class="col-md-6">
                                    <div class="field-box">

                                        <label class="modern-label">
                                            Color
                                        </label>

                                        <input type="text" name="color" class="form-control modern-input"
                                            placeholder="Black">

                                    </div>
                                </div>

                                <!-- DISPLAY -->
                                <div class="col-md-6">
                                    <div class="field-box">

                                        <label class="modern-label">
                                            Display Size
                                        </label>

                                        <input type="text" name="display_size" class="form-control modern-input"
                                            placeholder="6.7 Inch">

                                    </div>
                                </div>

                                <!-- CONDITION -->
                                <div class="col-md-6">
                                    <div class="field-box">

                                        <label class="modern-label">
                                            Condition
                                        </label>

                                        <select name="condition" class="form-select modern-select">

                                            <option value="New">New</option>
                                            <option value="Used">Used</option>
                                            <option value="Refurbished">Refurbished</option>

                                        </select>

                                    </div>
                                </div>

                                <!-- RATING -->
                                <div class="col-md-6">
                                    <div class="field-box">

                                        <label class="modern-label">
                                            Rating
                                        </label>

                                        <input type="number" step="0.1" min="0" max="5" name="rating"
                                            class="form-control modern-input" placeholder="4.5">

                                    </div>
                                </div>

                                <!-- SKU -->
                                <div class="col-md-6">
                                    <div class="field-box">

                                        <label class="modern-label">
                                            SKU
                                        </label>

                                        <input type="text" name="sku" class="form-control modern-input"
                                            placeholder="SAM-A16-128">

                                    </div>
                                </div>

                                <!-- SHORT TITLE -->
                                <div class="col-md-6">
                                    <div class="field-box">

                                        <label class="modern-label">
                                            Short Title
                                        </label>

                                        <input type="text" name="short_title" class="form-control modern-input"
                                            placeholder="Samsung Galaxy A16">

                                    </div>
                                </div>

                                <!-- WARRANTY -->
                                <div class="col-md-6">
                                    <div class="field-box">

                                        <label class="modern-label">
                                            Warranty
                                        </label>

                                        <input type="text" name="warranty" class="form-control modern-input"
                                            placeholder="1 Year Warranty">

                                    </div>
                                </div>

                                <!-- BOX CONTENTS -->
                                <div class="col-md-6">
                                    <div class="field-box">

                                        <label class="modern-label">
                                            Box Contents
                                        </label>

                                        <input type="text" name="box_contents" class="form-control modern-input"
                                            placeholder="Phone, Cable, Charger">

                                    </div>
                                </div>

                                <!-- FEATURES -->
                                <div class="col-12">
                                    <div class="field-box">

                                        <label class="modern-label">
                                            Key Features
                                        </label>

                                        <textarea name="key_features" rows="4" class="form-control modern-textarea"
                                            placeholder="• 5000mAh Battery&#10;• 50MP Camera&#10;• 120Hz AMOLED Display"></textarea>

                                    </div>
                                </div>

                                <!-- SPECIFICATIONS -->
                                <div class="col-12">
                                    <div class="field-box">

                                        <label class="modern-label">
                                            Specifications
                                        </label>

                                        <textarea name="specifications" rows="5" class="form-control modern-textarea"
                                            placeholder="RAM: 8GB&#10;Storage: 128GB&#10;Battery: 5000mAh"></textarea>

                                    </div>
                                </div>

                                <!-- DESCRIPTION -->
                                <div class="col-12">
                                    <div class="field-box">

                                        <label class="modern-label">
                                            Description
                                        </label>

                                        <textarea name="description" rows="6" class="form-control modern-textarea"
                                            placeholder="Write detailed product description"></textarea>

                                    </div>
                                </div>

                            </div>

                        </div>

                        <!-- RIGHT SIDE -->
                        <div class="col-lg-4">

                            <div class="side-card">

                                <!-- PRODUCT IMAGE -->
                                <div class="mb-4">

                                    <label class="modern-label">
                                        Product Image
                                    </label>

                                    <input type="file" name="image" class="form-control modern-input" id="imageInput">

                                </div>

                                <!-- GALLERY -->
                                <div class="mb-4">

                                    <label class="modern-label">
                                        Product Gallery Images
                                    </label>

                                    <input type="file" name="images[]" multiple class="form-control modern-input">

                                </div>

                                <!-- IMAGE PREVIEW -->
                                <div class="preview-box mb-4">

                                    <img id="preview" src="" style="display:none; width:100%;">

                                </div>

                                <!-- FEATURED -->
                                <div class="form-check mb-3">

                                    <input class="form-check-input" type="checkbox" name="is_featured">

                                    <label class="form-check-label">
                                        Featured Product
                                    </label>

                                </div>

                                <!-- ACTIVE -->
                                <div class="form-check mb-4">

                                    <input class="form-check-input" type="checkbox" name="is_active" checked>

                                    <label class="form-check-label">
                                        Active Product
                                    </label>

                                </div>

                               
                                <div class="mb-4">

                                    <label class="modern-label">
                                        Stock
                                    </label>

                                    <input type="number" name="stock" class="form-control modern-input" value="0">

                                </div>

                                <!-- BUTTON -->
                                <button class="save-btn w-100">

                                    Save Product

                                </button>

                            </div>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

   
    <script>

        document.getElementById('imageInput')
            .addEventListener('change', function (e) {

                let reader = new FileReader();

                reader.onload = function () {

                    let preview = document.getElementById('preview');

                    preview.src = reader.result;

                    preview.style.display = 'block';
                }

                reader.readAsDataURL(e.target.files[0]);

            });

    </script>

</x-app-layout>