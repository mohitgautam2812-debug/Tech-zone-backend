<x-app-layout>

    <div class="flex-grow-1 p-4">








        <h3 class="fw-bold mb-4 text-danger">
            <i class="bi bi-plus-circle me-2"></i> Add New Blog
        </h3>

        <div class="card shadow-lg border-0 rounded-4 mb-5">

            <div class="p-3 text-white" style="background: linear-gradient(135deg,#dc2626,#ef4444);">
                <h5 class="mb-0">
                    <i class="bi bi-pencil-square me-2"></i>New Blog Post
                </h5>
            </div>

            <div class="card-body p-4">

                <form method="POST"
                    action="{{ isset($editBlog) ? route('admin.blogs.update', $editBlog->id) : route('admin.blogs.store') }}"
                    enctype="multipart/form-data">
                    @if($errors->any())
                        <div class="alert alert-danger rounded-3 mb-4">
                            <ul class="mb-0">
                                @foreach($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @csrf

                    @if(isset($editBlog))
                        @method('PUT')
                    @endif

                    @if(session('success'))
                        <div
                            style="background:#e8f5e9; color:#2e7d32; padding:15px; border-radius:8px; margin-bottom:20px;">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div
                            style="background:#ffebee; color:#c62828; padding:15px; border-radius:8px; margin-bottom:20px;">
                            <ul style="margin:0; padding-left:20px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row g-4">


                        <div class="col-lg-8">


                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Title <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="title" value="{{ old('title', $editBlog->title ?? '') }}"
                                    class="form-control rounded-3 @error('title') is-invalid @enderror"
                                    placeholder="Enter blog title…" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Excerpt <span class="text-danger">*</span>
                                </label>
                                <textarea name="excerpt" rows="2"
                                    class="form-control rounded-3 @error('excerpt') is-invalid @enderror"
                                    placeholder="Short description shown on blog cards…"
                                    required>{{ old('excerpt', $editBlog->excerpt ?? '') }}</textarea>
                                @error('excerpt')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Content <span class="text-danger">*</span>
                                </label>
                                <textarea name="content" id="blog-content" rows="10"
                                    class="form-control rounded-3 @error('content') is-invalid @enderror"
                                    placeholder="Full blog content…"
                                    required>{{ old('content', $editBlog->content ?? '') }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>


                        <div class="col-lg-4">


                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Category <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="category"
                                    value="{{ old('category', $editBlog->category ?? '') }}" list="cat-list"
                                    class="form-control rounded-3 @error('category') is-invalid @enderror"
                                    placeholder="Reviews, Guides…" required>
                                <datalist id="cat-list">
                                    <option value="Reviews">
                                    <option value="Comparisons">
                                    <option value="Guides">
                                    <option value="Insights">
                                    <option value="Cameras">
                                    <option value="Audio">
                                    <option value="News">
                                </datalist>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Author <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="author"
                                    value="{{ old('author', $editBlog->author ?? auth()->user()->name) }}"
                                    class="form-control rounded-3 @error('author') is-invalid @enderror" required>
                                @error('author')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label class="form-label fw-semibold">Thumbnail Image</label>
                                <div class="border-2 border-dashed rounded-3 p-3 text-center"
                                    style="border: 2px dashed #dee2e6; cursor: pointer;"
                                    onclick="document.getElementById('thumb-input').click()">
                                    <img id="thumb-preview" class="rounded-3 mb-2 d-none"
                                        style="max-height: 120px; max-width: 100%; object-fit: cover;">
                                    <div id="thumb-placeholder">
                                        <i class="bi bi-image text-muted display-6"></i>
                                        <p class="text-muted small mb-0">Click to upload (max 5MB)</p>
                                    </div>
                                </div>
                                <input type="file" id="thumb-input" name="thumbnail" accept="image/*" class="d-none"
                                    onchange="previewThumb(this)">
                                @error('thumbnail')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_published"
                                        id="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="is_published">
                                        Publish immediately
                                    </label>
                                </div>
                            </div>


                            <button type="submit" class="btn w-100 text-white fw-bold rounded-3"
                                style="background: linear-gradient(135deg,#dc2626,#ef4444)">

                                <i class="bi bi-check-circle me-2"></i>

                                {{ isset($editBlog) ? 'Update Blog' : 'Publish Blog' }}

                            </button>

                        </div>

                    </div>

                </form>
            </div>
        </div>



        <h3 class="fw-bold mb-4 text-danger">
            <i class="bi bi-journal-richtext me-2"></i>All Blogs
        </h3>

        <div class="card shadow-lg border-0 rounded-4">

            <div class="p-3 text-white d-flex align-items-center justify-content-between"
                style="background: linear-gradient(135deg,#dc2626,#ef4444);">
                <h5 class="mb-0">Manage Blog Posts</h5>
                <span class="badge bg-white text-danger fw-bold">
                    {{ $blogs->total() }} Total
                </span>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($blogs as $blog)
                            <tr>

                                <td>{{ $loop->iteration }}</td>


                                <td>
                                    @if($blog->thumbnail)
                                        <img src="{{ Str::startsWith($blog->thumbnail, 'http') ? $blog->thumbnail : asset('storage/' . $blog->thumbnail) }}"
                                            width="60" height="45" class="rounded-3" style="object-fit:cover;">
                                    @else
                                        <div class="rounded-3 bg-light d-flex align-items-center justify-content-center"
                                            style="width:60px;height:45px;">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>


                                <td style="max-width: 240px;">
                                    <p class="fw-semibold mb-0 text-truncate">{{ $blog->title }}</p>
                                    <small class="text-muted text-truncate d-block">{{ $blog->excerpt }}</small>
                                </td>


                                <td>
                                    <span class="badge"
                                        style="background:#f0f0f0;color:#555;font-size:11px;border-radius:6px;">
                                        {{ $blog->category }}
                                    </span>
                                </td>


                                <td>{{ $blog->author }}</td>


                                <td>
                                    <form method="POST" action="{{ route('admin.blogs.toggle', $blog->id) }}">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-sm" style="border-radius:20px;font-size:11px;
                                                                                                       background: {{ $blog->is_published ? '#d1fae5' : '#f3f4f6' }};
                                                                                                       color: {{ $blog->is_published ? '#065f46' : '#6b7280' }};
                                                                                                       border: none;">
                                          
                                            {{ $blog->is_published ? 'Published' : 'Draft' }}
                                        </button>
                                    </form>
                                </td>


                                <td class="text-muted" style="font-size:12px;white-space:nowrap;">
                                    {{ ($blog->published_at ?? $blog->created_at)->format('d M Y') }}
                                </td>

                                <td class="d-flex gap-2">

                                    <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-pencil-square"></i>Edit
                                    </a>

                                    <form method="POST" action="{{ route('admin.blogs.delete', $blog->id) }}"
                                        onsubmit="return confirm('Delete \'{{ addslashes($blog->title) }}\'?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash3"></i>
                                            Delete</button>



                                    </form>

                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-5">
                                    <i class="bi bi-journal-x display-4 d-block mb-2"></i>
                                    No blog posts yet
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>


            @if($blogs->hasPages())
                <div class="px-4 pb-3">
                    {{ $blogs->links() }}
                </div>
            @endif

        </div>

    </div>




    <script>



        function previewThumb(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    document.getElementById('thumb-preview').src = e.target.result;
                    document.getElementById('thumb-preview').classList.remove('d-none');
                    document.getElementById('thumb-placeholder').classList.add('d-none');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</x-app-layout>