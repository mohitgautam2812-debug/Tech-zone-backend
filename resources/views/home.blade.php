<x-app-layout>

    <div class="container-fluid py-4 tz-admin-page">



        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h2 class="fw-bold mb-1" style="font-size: 1.6rem;">Homepage Content Manager</h2>
                <p class="text-muted small mb-0">Manage all homepage sections from one place</p>
            </div>
            <span class="badge bg-primary rounded-pill px-3 py-2" style="font-size: 0.75rem;">
                Home Page
            </span>
        </div>



        <div class="tz-section-card mb-4">
            <div class="tz-section-header">
                <div class="tz-section-label">
                    <span class="tz-section-icon bg-blue-soft text-primary">&#9733;</span>
                    <div>
                        <h5 class="fw-bold mb-0">Hero Section</h5>
                        <p class="text-muted small mb-0">Main banner — heading, buttons, trust stats</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <form action="{{ url('admin/home/hero/update') }}" method="POST">
                    @csrf
                   

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="tz-label">Badge Text</label>
                            <input type="text" name="hero_badge" class="form-control tz-input"
                                placeholder="e.g. Powered by TechZone AI"
                                value="{{ old('hero_badge', $pageData['hero']['badge'] ?? '') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="tz-label">Hero Heading</label>
                            <input type="text" name="hero_heading" class="form-control tz-input"
                                placeholder="e.g. Unlock the"
                                value="{{ old('hero_heading', $pageData['hero']['heading'] ?? '') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="tz-label">Highlighted Word <span class="text-muted fw-normal">(colored part in
                                    heading)</span></label>
                            <input type="text" name="hero_highlight" class="form-control tz-input"
                                placeholder="e.g. Future"
                                value="{{ old('hero_highlight', $pageData['hero']['highlight'] ?? '') }}">
                        </div>

                        <div class="col-6">
                            <label class="tz-label">Hero Description</label>
                            <textarea name="hero_description" rows="3" class="form-control tz-input"
                                placeholder="Discover AI-curated smart electronics...">{{ old('hero_description', $pageData['hero']['description'] ?? '') }}</textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="tz-label">Primary Button Text</label>
                            <input type="text" name="hero_btn_1_text" class="form-control tz-input"
                                placeholder="e.g. Shop Now"
                                value="{{ old('hero_btn_1_text', $pageData['hero']['button1_text'] ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="tz-label">Primary Button Link</label>
                            <input type="text" name="hero_btn_1_link" class="form-control tz-input"
                                placeholder="/products"
                                value="{{ old('hero_btn_1_link', $pageData['hero']['button1_link'] ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="tz-label">Secondary Button Text</label>
                            <input type="text" name="hero_btn_2_text" class="form-control tz-input"
                                placeholder="e.g. Browse Categories"
                                value="{{ old('hero_btn_2_text', $pageData['hero']['button2_text'] ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="tz-label">Secondary Button Link</label>
                            <input type="text" name="hero_btn_2_link" class="form-control tz-input"
                                placeholder="/categories"
                                value="{{ old('hero_btn_2_link', $pageData['hero']['button2_link'] ?? '') }}">
                        </div>
                    </div>


                    <div class="tz-sub-section mt-4">
                        <h6 class="fw-semibold text-muted small text-uppercase mb-3" style="letter-spacing: 0.6px;">
                            Trust Stats (bottom of hero)
                        </h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="tz-label">Stat 1 — Number</label>
                                <input type="text" name="hero_stat1_number" class="form-control tz-input"
                                    placeholder="e.g. 2M+"
                                    value="{{ old('hero_stat1_number', $pageData['hero']['stat1_number'] ?? '') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="tz-label">Stat 1 — Label</label>
                                <input type="text" name="hero_stat1_label" class="form-control tz-input"
                                    placeholder="e.g. Happy Customers"
                                    value="{{ old('hero_stat1_label', $pageData['hero']['stat1_label'] ?? '') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="tz-label">Stat 2 — Number</label>
                                <input type="text" name="hero_stat2_number" class="form-control tz-input"
                                    placeholder="e.g. 4.9"
                                    value="{{ old('hero_stat2_number', $pageData['hero']['stat2_number'] ?? '') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="tz-label">Stat 2 — Label</label>
                                <input type="text" name="hero_stat2_label" class="form-control tz-input"
                                    placeholder="e.g. Avg Rating"
                                    value="{{ old('hero_stat2_label', $pageData['hero']['stat2_label'] ?? '') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="tz-label">Stat 3 — Number</label>
                                <input type="text" name="hero_stat3_number" class="form-control tz-input"
                                    placeholder="e.g. 98%"
                                    value="{{ old('hero_stat3_number', $pageData['hero']['stat3_number'] ?? '') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="tz-label">Stat 3 — Label</label>
                                <input type="text" name="hero_stat3_label" class="form-control tz-input"
                                    placeholder="e.g. On-Time Delivery"
                                    value="{{ old('hero_stat3_label', $pageData['hero']['stat3_label'] ?? '') }}">
                            </div>
                        </div>
                    </div>

                    <div class="tz-form-footer">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            Save Hero Section
                        </button>
                    </div>
                </form>
            </div>
        </div>



        <div class="tz-section-card mb-4">
            <div class="tz-section-header">
                <div class="tz-section-label">
                    <span class="tz-section-icon bg-success-soft text-success">&#10003;</span>
                    <div>
                        <h5 class="fw-bold mb-0">Trust Badges Bar</h5>
                        <p class="text-muted small mb-0">5 badge items below hero (icon class, heading, subtext)</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <form action="{{ url('/admin/home/badges/update') }}" method="POST">
                    @csrf
                   

                    @for ($i = 1; $i <= 5; $i++)
                        <div class="row g-3 mb-3 align-items-end">
                            <div class="col-auto d-flex align-items-center" style="padding-top: 28px;">
                                <span class="tz-step-badge">{{ $i }}</span>
                            </div>
                            <div class="col-md-3">
                                <label class="tz-label">Icon Class</label>
                                <input type="text" name="badge_{{ $i }}_icon" class="form-control tz-input"
                                    placeholder="e.g. fa-truck"
                                    value="{{ old('badge_' . $i . '_icon', $pageData['badges'][$i - 1]['icon'] ?? '') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="tz-label">Heading</label>
                                <input type="text" name="badge_{{ $i }}_heading" class="form-control tz-input"
                                    placeholder="e.g. Free Shipping"
                                    value="{{ old('badge_' . $i . '_heading', $pageData['badges'][$i - 1]['heading'] ?? '') }}">
                            </div>
                            <div class="col">
                                <label class="tz-label">Sub Text</label>
                                <input type="text" name="badge_{{ $i }}_subtext" class="form-control tz-input"
                                    placeholder="e.g. On orders over &#8377;999"
                                    value="{{ old('badge_' . $i . '_subtext', $pageData['badges'][$i - 1]['subtext'] ?? '') }}">
                            </div>
                        </div>
                        @if($i < 5)
                            <hr class="tz-divider">
                        @endif
                    @endfor

                    <div class="tz-form-footer">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            Save Badges
                        </button>
                    </div>
                </form>
            </div>
        </div>



        <div class="tz-section-card mb-4">
            <div class="tz-section-header d-flex justify-content-between align-items-center">
                <div class="tz-section-label">
                    <span class="tz-section-icon bg-warning-soft text-warning">&#9632;</span>
                    <div>
                        <h5 class="fw-bold mb-0">Category Section</h5>
                        <p class="text-muted small mb-0">Section badge, heading, button — category cards come from DB
                        </p>
                    </div>
                </div>
                <a href="{{ url('admin/categories/create') }}" class="btn btn-dark rounded-pill px-4">
                    + Add Category
                </a>
            </div>

            <div class="card-body p-4">
                <form action="{{ url('admin/home/categories/update') }}" method="POST">
                    @csrf
                   

                    <div class="row g-3 mb-4">
                        <div class="col-md-3">
                            <label class="tz-label">Badge Text</label>
                            <input type="text" name="categories_badge" class="form-control tz-input"
                                placeholder="e.g. EXPLORE"
                                value="{{ old('categories_badge', $pageData['categories_section']['badge'] ?? '') }}">
                        </div>
                        <div class="col-md-5">
                            <label class="tz-label">Section Heading</label>
                            <input type="text" name="categories_heading" class="form-control tz-input"
                                placeholder="e.g. Shop by category"
                                value="{{ old('categories_heading', $pageData['categories_section']['heading'] ?? '') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="tz-label">Button Text</label>
                            <input type="text" name="categories_btn_text" class="form-control tz-input"
                                placeholder="e.g. View all"
                                value="{{ old('categories_btn_text', $pageData['categories_section']['btn_text'] ?? '') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="tz-label">Button Link</label>
                            <input type="text" name="categories_btn_link" class="form-control tz-input"
                                placeholder="/categories"
                                value="{{ old('categories_btn_link', $pageData['categories_section']['btn_link'] ?? '') }}">
                        </div>
                    </div>

                    <div class="tz-form-footer">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            Save Category Section
                        </button>
                    </div>
                </form>


                @if(count($categories) > 0)
                    <hr class="tz-divider mt-4">
                    <p class="text-muted small fw-semibold mb-3">Existing Categories (edit image / name)</p>
                    <div class="row g-3">
                        @foreach($categories as $category)
                            <div class="col-md-3">
                                <div class="tz-preview-card">
                                    <img src="{{ asset('storage/' . $category->image) }}" class="tz-preview-img rounded-3 mb-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="fw-semibold small mb-0">{{ $category->name }}</p>
                                            <p class="text-muted mb-0" style="font-size: 0.75rem;">
                                                {{ $category->products_count }} Products
                                            </p>
                                        </div>
                                        <div class="d-flex gap-1">
                                            <a href="{{ url('admin/categories/' . $category->id . '/edit') }}"
                                                class="btn btn-sm btn-outline-primary rounded-pill px-2">Edit</a>
                                            <form action="{{ url('admin/categories/' . $category->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-2"
                                                    onclick="return confirm('Delete this category?')">Del</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>



        <div class="tz-section-card mb-4">
            <div class="tz-section-header">
                <div class="tz-section-label">
                    <span class="tz-section-icon bg-danger-soft text-danger">&#9889;</span>
                    <div>
                        <h5 class="fw-bold mb-0">Flash Sale Section</h5>
                        <p class="text-muted small mb-0">Left side content — right side auto-shows top discounted
                            products from DB</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <form action="{{ url('admin/home/flash/update') }}" method="POST">
                    @csrf
                   

                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="tz-label">Badge Text</label>
                            <input type="text" name="flash_badge" class="form-control tz-input"
                                placeholder="e.g. FLASH DEAL"
                                value="{{ old('flash_badge', $pageData['flash_sale']['badge'] ?? '') }}">
                        </div>
                        <div class="col-md-9">
                            <label class="tz-label">Heading</label>
                            <input type="text" name="flash_heading" class="form-control tz-input"
                                placeholder="e.g. Up to 40% off premium audio"
                                value="{{ old('flash_heading', $pageData['flash_sale']['heading'] ?? '') }}">
                        </div>
                        <div class="col-12">
                            <label class="tz-label">Description</label>
                            <textarea name="flash_description" rows="3" class="form-control tz-input"
                                placeholder="Studio-grade sound for every space...">{{ old('flash_description', $pageData['flash_sale']['description'] ?? '') }}</textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="tz-label">Button Text</label>
                            <input type="text" name="flash_btn_text" class="form-control tz-input"
                                placeholder="e.g. Shop the sale"
                                value="{{ old('flash_btn_text', $pageData['flash_sale']['btn_text'] ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="tz-label">Button Link</label>
                            <input type="text" name="flash_btn_link" class="form-control tz-input" placeholder="/sale"
                                value="{{ old('flash_btn_link', $pageData['flash_sale']['btn_link'] ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="tz-label">Minimum Discount % to Show</label>
                            <input type="number" name="flash_min_discount" class="form-control tz-input"
                                placeholder="e.g. 40" min="1" max="100"
                                value="{{ old('flash_min_discount', $pageData['flash_sale']['min_discount'] ?? 40) }}">
                        </div>
                    </div>

                    <div class="tz-form-footer">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            Save Flash Sale
                        </button>
                    </div>
                </form>
            </div>
        </div>



        <div class="tz-section-card mb-4">
            <div class="tz-section-header">
                <div class="tz-section-label">
                    <span class="tz-section-icon bg-purple-soft text-purple">&#9670;</span>
                    <div>
                        <h5 class="fw-bold mb-0">AI Picks Section</h5>
                        <p class="text-muted small mb-0">Badge, heading, description and "See all" button</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <form action="{{ url('admin/home/aipicks/update') }}" method="POST">
                    @csrf
                   

                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="tz-label">Badge Text</label>
                            <input type="text" name="aipicks_badge" class="form-control tz-input"
                                placeholder="e.g. AI PICKS FOR YOU"
                                value="{{ old('aipicks_badge', $pageData['ai_picks']['badge'] ?? '') }}">
                        </div>
                        <div class="col-md-5">
                            <label class="tz-label">Heading</label>
                            <input type="text" name="aipicks_heading" class="form-control tz-input"
                                placeholder="e.g. Personally curated"
                                value="{{ old('aipicks_heading', $pageData['ai_picks']['heading'] ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="tz-label">Description</label>
                            <input type="text" name="aipicks_description" class="form-control tz-input"
                                placeholder="e.g. Our neural engine matches devices..."
                                value="{{ old('aipicks_description', $pageData['ai_picks']['description'] ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="tz-label">Button Text</label>
                            <input type="text" name="aipicks_btn_text" class="form-control tz-input"
                                placeholder="e.g. See all"
                                value="{{ old('aipicks_btn_text', $pageData['ai_picks']['btn_text'] ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="tz-label">Button Link</label>
                            <input type="text" name="aipicks_btn_link" class="form-control tz-input"
                                placeholder="/ai-picks"
                                value="{{ old('aipicks_btn_link', $pageData['ai_picks']['btn_link'] ?? '') }}">
                        </div>
                    </div>

                    <div class="tz-form-footer">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            Save AI Picks Section
                        </button>
                    </div>
                </form>
            </div>
        </div>



        <div class="tz-section-card mb-4">
            <div class="tz-section-header d-flex justify-content-between align-items-center">
                <div class="tz-section-label">
                    <span class="tz-section-icon bg-info-soft text-info">&#9651;</span>
                    <div>
                        <h5 class="fw-bold mb-0">AI Features Cards</h5>
                        <p class="text-muted small mb-0">Section heading + feature cards from DB (icon, title,
                            description)</p>
                    </div>
                </div>
                <a href="{{ url('admin/ai-features/create') }}" class="btn btn-dark rounded-pill px-4">
                    + Add Feature Card
                </a>
            </div>

            <div class="card-body p-4">


                <form action="{{ url('admin/home/aifeatures/update') }}" method="POST" class="mb-4">
                    @csrf
                   

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="tz-label">Section Heading</label>
                            <input type="text" name="aifeatures_heading" class="form-control tz-input"
                                placeholder="e.g. Smarter Shopping"
                                value="{{ old('aifeatures_heading', $pageData['ai_features']['heading'] ?? '') }}">
                        </div>
                        <div class="col-md-8">
                            <label class="tz-label">Section Description</label>
                            <input type="text" name="aifeatures_description" class="form-control tz-input"
                                placeholder="e.g. Powered by cutting-edge AI technology"
                                value="{{ old('aifeatures_description', $pageData['ai_features']['description'] ?? '') }}">
                        </div>
                    </div>

                    <div class="tz-form-footer">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            Save Section Header
                        </button>
                    </div>
                </form>


                @if(count($aiFeatures) > 0)
                    <hr class="tz-divider">
                    <p class="text-muted small fw-semibold mb-3">Existing Feature Cards</p>
                    <div class="row g-3">
                        @foreach($aiFeatures as $feature)
                            <div class="col-md-4">
                                <div class="tz-preview-card">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <div class="tz-icon-preview">
                                            <i class="{{ $feature->icon }}"></i>
                                        </div>
                                        <span class="fw-semibold small">{{ $feature->title }}</span>
                                    </div>
                                    <p class="text-muted small mb-3" style="font-size: 0.78rem;">
                                        {{ Str::limit($feature->description, 80) }}
                                    </p>
                                    <div class="d-flex gap-2">
                                        <a href="{{ url('admin/ai-features/' . $feature->id . '/edit') }}"
                                            class="btn btn-sm btn-outline-primary rounded-pill px-3">Edit</a>
                                        <form action="{{ url('admin/ai-features/' . $feature->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                onclick="return confirm('Delete this feature?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>



        <div class="tz-section-card mb-4">
            <div class="tz-section-header d-flex justify-content-between align-items-center">
                <div class="tz-section-label">
                    <span class="tz-section-icon bg-warning-soft text-warning">&#9733;</span>
                    <div>
                        <h5 class="fw-bold mb-0">Reviews Section</h5>
                        <p class="text-muted small mb-0">Badge, heading, overall rating — review cards come from DB</p>
                    </div>
                </div>
                <a href="{{ url('admin/reviews/create') }}" class="btn btn-dark rounded-pill px-4">
                    + Add Review
                </a>
            </div>

            <div class="card-body p-4">
                <form action="{{ url('admin/home/reviews/update') }}" method="POST">
                    @csrf
                   

                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="tz-label">Badge Text</label>
                            <input type="text" name="reviews_badge" class="form-control tz-input"
                                placeholder="e.g. LOVED WORLDWIDE"
                                value="{{ old('reviews_badge', $pageData['reviews_section']['badge'] ?? '') }}">
                        </div>
                        <div class="col-md-5">
                            <label class="tz-label">Heading</label>
                            <input type="text" name="reviews_heading" class="form-control tz-input"
                                placeholder="e.g. 2M+ shoppers can't be wrong"
                                value="{{ old('reviews_heading', $pageData['reviews_section']['heading'] ?? '') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="tz-label">Overall Rating</label>
                            <input type="text" name="reviews_rating" class="form-control tz-input"
                                placeholder="e.g. 4.9"
                                value="{{ old('reviews_rating', $pageData['reviews_section']['rating'] ?? '') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="tz-label">Rating Subtext</label>
                            <input type="text" name="reviews_rating_sub" class="form-control tz-input"
                                placeholder="e.g. / 5.0 average rating"
                                value="{{ old('reviews_rating_sub', $pageData['reviews_section']['rating_sub'] ?? '') }}">
                        </div>
                    </div>

                    <div class="tz-form-footer">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            Save Reviews Header
                        </button>
                    </div>
                </form>


                @if(count($reviews) > 0)
                    <hr class="tz-divider mt-4">
                    <p class="text-muted small fw-semibold mb-3">Existing Reviews</p>
                    <div class="row g-3">
                        @foreach($reviews as $review)
                            <div class="col-md-4">
                                <div class="tz-preview-card">
                                    <div class="text-warning mb-1" style="font-size: 0.85rem;">
                                        &#9733;&#9733;&#9733;&#9733;&#9733;</div>
                                    <p class="small text-muted mb-2" style="font-size: 0.78rem;">
                                        {{ Str::limit($review->review, 90) }}
                                    </p>
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <img src="{{ asset('storage/' . $review->image) }}" class="rounded-circle" width="36"
                                            height="36" style="object-fit:cover;">
                                        <div>
                                            <p class="fw-semibold small mb-0" style="font-size: 0.8rem;">{{ $review->name }}</p>
                                            <p class="text-muted mb-0" style="font-size: 0.7rem;">{{ $review->city }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <a href="{{ url('admin/reviews/' . $review->id . '/edit') }}"
                                            class="btn btn-sm btn-outline-primary rounded-pill px-3">Edit</a>
                                        <form action="{{ url('admin/reviews/' . $review->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                onclick="return confirm('Delete this review?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>



        <div class="tz-section-card mb-4">
            <div class="tz-section-header">
                <div class="tz-section-label">
                    <span class="tz-section-icon bg-success-soft text-success">&#9432;</span>
                    <div>
                        <h5 class="fw-bold mb-0">About Section</h5>
                        <p class="text-muted small mb-0">Badge, heading, paragraphs, bullet list, stats, buttons</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <form action="{{ url('admin/home/about/update') }}" method="POST">
                    @csrf
                   

                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="tz-label">Badge Text</label>
                            <input type="text" name="about_badge" class="form-control tz-input"
                                placeholder="e.g. ABOUT US"
                                value="{{ old('about_badge', $pageData['about']['badge'] ?? '') }}">
                        </div>
                        <div class="col-md-9">
                            <label class="tz-label">Heading</label>
                            <input type="text" name="about_heading" class="form-control tz-input"
                                placeholder="e.g. Designed for You, Freshly Made by Us"
                                value="{{ old('about_heading', $pageData['about']['heading'] ?? '') }}">
                        </div>
                        <div class="col-12">
                            <label class="tz-label">Paragraph 1</label>
                            <textarea name="about_para1" rows="3" class="form-control tz-input"
                                placeholder="At TechZone, we are revolutionising...">{{ old('about_para1', $pageData['about']['para1'] ?? '') }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="tz-label">Paragraph 2</label>
                            <textarea name="about_para2" rows="3" class="form-control tz-input"
                                placeholder="Our curated collection features...">{{ old('about_para2', $pageData['about']['para2'] ?? '') }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="tz-label">Left Panel — Title</label>
                            <input type="text" name="about_panel_title" class="form-control tz-input"
                                placeholder="e.g. AI-Powered Recommendations"
                                value="{{ old('about_panel_title', $pageData['about']['panel_title'] ?? '') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="tz-label">Left Panel — Subtitle</label>
                            <input type="text" name="about_panel_subtitle" class="form-control tz-input"
                                placeholder="e.g. Smart tech matching just for you"
                                value="{{ old('about_panel_subtitle', $pageData['about']['panel_subtitle'] ?? '') }}">
                        </div>

                        <div class="col-12">
                            <label class="tz-label">
                                Bullet Points
                                <span class="text-muted fw-normal">(one bullet per line)</span>
                            </label>
                            <textarea name="about_bullets" rows="6" class="form-control tz-input"
                                placeholder="Personalised product recommendations based on your usage&#10;Compare specs of 1000+ devices instantly&#10;EMI plans starting from &#8377;999/month on all products&#10;Expert advice from certified tech specialists&#10;Same-day delivery available in 50+ cities">{{ old('about_bullets', $pageData['about']['bullets'] ?? '') }}</textarea>
                        </div>

                        {{-- Stats --}}
                        <div class="col-12">
                            <div class="tz-sub-section">
                                <h6 class="fw-semibold text-muted small text-uppercase mb-3"
                                    style="letter-spacing: 0.6px;">
                                    Stats (shown inside left panel)
                                </h6>
                                <div class="row g-3">
                                    <div class="col-md-2">
                                        <label class="tz-label">Stat 1 Number</label>
                                        <input type="text" name="about_stat1_number" class="form-control tz-input"
                                            placeholder="e.g. 50K+"
                                            value="{{ old('about_stat1_number', $pageData['about']['stat1_number'] ?? '') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="tz-label">Stat 1 Label</label>
                                        <input type="text" name="about_stat1_label" class="form-control tz-input"
                                            placeholder="e.g. Products"
                                            value="{{ old('about_stat1_label', $pageData['about']['stat1_label'] ?? '') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="tz-label">Stat 2 Number</label>
                                        <input type="text" name="about_stat2_number" class="form-control tz-input"
                                            placeholder="e.g. 150+"
                                            value="{{ old('about_stat2_number', $pageData['about']['stat2_number'] ?? '') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="tz-label">Stat 2 Label</label>
                                        <input type="text" name="about_stat2_label" class="form-control tz-input"
                                            placeholder="e.g. Brands"
                                            value="{{ old('about_stat2_label', $pageData['about']['stat2_label'] ?? '') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="tz-label">Stat 3 Number</label>
                                        <input type="text" name="about_stat3_number" class="form-control tz-input"
                                            placeholder="e.g. 2M+"
                                            value="{{ old('about_stat3_number', $pageData['about']['stat3_number'] ?? '') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="tz-label">Stat 3 Label</label>
                                        <input type="text" name="about_stat3_label" class="form-control tz-input"
                                            placeholder="e.g. Customers"
                                            value="{{ old('about_stat3_label', $pageData['about']['stat3_label'] ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <label class="tz-label">Primary Button Text</label>
                            <input type="text" name="about_btn1_text" class="form-control tz-input"
                                placeholder="e.g. Shop Now"
                                value="{{ old('about_btn1_text', $pageData['about']['btn1_text'] ?? '') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="tz-label">Primary Button Link</label>
                            <input type="text" name="about_btn1_link" class="form-control tz-input"
                                placeholder="/products"
                                value="{{ old('about_btn1_link', $pageData['about']['btn1_link'] ?? '') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="tz-label">Secondary Button Text</label>
                            <input type="text" name="about_btn2_text" class="form-control tz-input"
                                placeholder="e.g. Get Expert Advice"
                                value="{{ old('about_btn2_text', $pageData['about']['btn2_text'] ?? '') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="tz-label">Secondary Button Link</label>
                            <input type="text" name="about_btn2_link" class="form-control tz-input"
                                placeholder="/contact"
                                value="{{ old('about_btn2_link', $pageData['about']['btn2_link'] ?? '') }}">
                        </div>
                    </div>

                    <div class="tz-form-footer">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            Save About Section
                        </button>
                    </div>
                </form>
            </div>
        </div>



        <div class="tz-section-card mb-4">
            <div class="tz-section-header d-flex justify-content-between align-items-center">
                <div class="tz-section-label">
                    <span class="tz-section-icon bg-blue-soft text-primary">&#9312;</span>
                    <div>
                        <h5 class="fw-bold mb-0">How It Works</h5>
                        <p class="text-muted small mb-0">Section header + step cards from DB (icon, step no., title,
                            description)</p>
                    </div>
                </div>
                <a href="{{ url('admin/steps/create') }}" class="btn btn-dark rounded-pill px-4">
                    + Add Step
                </a>
            </div>

            <div class="card-body p-4">
                <form action="{{ url('admin/home/how-it-works/update') }}" method="POST" class="mb-4">
                    @csrf
                   

                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="tz-label">Badge Text</label>
                            <input type="text" name="hiw_badge" class="form-control tz-input"
                                placeholder="e.g. HOW IT WORKS"
                                value="{{ old('hiw_badge', $pageData['how_it_works']['badge'] ?? '') }}">
                        </div>
                        <div class="col-md-5">
                            <label class="tz-label">Section Heading</label>
                            <input type="text" name="hiw_heading" class="form-control tz-input"
                                placeholder="e.g. Shopping Made Simple"
                                value="{{ old('hiw_heading', $pageData['how_it_works']['heading'] ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="tz-label">Section Subheading</label>
                            <input type="text" name="hiw_subheading" class="form-control tz-input"
                                placeholder="e.g. Three easy steps to your perfect tech"
                                value="{{ old('hiw_subheading', $pageData['how_it_works']['subheading'] ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="tz-label">Bottom Button Text</label>
                            <input type="text" name="hiw_btn_text" class="form-control tz-input"
                                placeholder="e.g. Start Shopping"
                                value="{{ old('hiw_btn_text', $pageData['how_it_works']['btn_text'] ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="tz-label">Bottom Button Link</label>
                            <input type="text" name="hiw_btn_link" class="form-control tz-input" placeholder="/products"
                                value="{{ old('hiw_btn_link', $pageData['how_it_works']['btn_link'] ?? '') }}">
                        </div>
                    </div>

                    <div class="tz-form-footer">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            Save Section Header
                        </button>
                    </div>
                </form>


                @if(count($steps) > 0)
                    <hr class="tz-divider">
                    <p class="text-muted small fw-semibold mb-3">Existing Steps</p>
                    <div class="row g-3">
                        @foreach($steps as $step)
                            <div class="col-md-4">
                                <div class="tz-preview-card text-center">
                                    <div class="tz-icon-preview mx-auto mb-2">
                                        <i class="{{ $step->icon }}"></i>
                                    </div>
                                    <span class="badge bg-primary rounded-pill px-3 mb-2" style="font-size: 0.7rem;">
                                        STEP {{ $step->step }}
                                    </span>
                                    <p class="fw-semibold small mb-1">{{ $step->title }}</p>
                                    <p class="text-muted mb-2" style="font-size: 0.75rem;">
                                        {{ Str::limit($step->description, 70) }}
                                    </p>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="{{ url('admin/steps/' . $step->id . '/edit') }}"
                                            class="btn btn-sm btn-outline-primary rounded-pill px-3">Edit</a>
                                        <form action="{{ url('admin/steps/' . $step->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                onclick="return confirm('Delete this step?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>



        <div class="tz-section-card mb-4">
            <div class="tz-section-header">
                <div class="tz-section-label">
                    <span class="tz-section-icon bg-danger-soft text-danger">&#9993;</span>
                    <div>
                        <h5 class="fw-bold mb-0">Newsletter Section</h5>
                        <p class="text-muted small mb-0">Badge, heading, subheading, subscribe button text</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <form action="{{ url('admin/home/newsletter/update') }}" method="POST">
                    @csrf
                   

                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="tz-label">Badge Text</label>
                            <input type="text" name="newsletter_badge" class="form-control tz-input"
                                placeholder="e.g. STAY AHEAD"
                                value="{{ old('newsletter_badge', $pageData['newsletter']['badge'] ?? '') }}">
                        </div>
                        <div class="col-md-9">
                            <label class="tz-label">Heading</label>
                            <input type="text" name="newsletter_heading" class="form-control tz-input"
                                placeholder="e.g. Get drops, deals and AI-picks first"
                                value="{{ old('newsletter_heading', $pageData['newsletter']['heading'] ?? '') }}">
                        </div>
                        <div class="col-12">
                            <label class="tz-label">Subheading</label>
                            <input type="text" name="newsletter_subheading" class="form-control tz-input"
                                placeholder="e.g. Join 250,000+ insiders. No spam. Just the future, weekly."
                                value="{{ old('newsletter_subheading', $pageData['newsletter']['subheading'] ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="tz-label">Email Input Placeholder</label>
                            <input type="text" name="newsletter_placeholder" class="form-control tz-input"
                                placeholder="e.g. you@futuremail.com"
                                value="{{ old('newsletter_placeholder', $pageData['newsletter']['placeholder'] ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="tz-label">Subscribe Button Text</label>
                            <input type="text" name="newsletter_btn_text" class="form-control tz-input"
                                placeholder="e.g. Subscribe"
                                value="{{ old('newsletter_btn_text', $pageData['newsletter']['btn_text'] ?? '') }}">
                        </div>
                    </div>

                    <div class="tz-form-footer">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            Save Newsletter
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>


    <style>
        .tz-admin-page {
            background: #f4f6fb;
            min-height: 100vh;
        }

        .tz-section-card {
            background: #fff;
            border-radius: 20px;
            border: 1px solid #eaecf4;
            overflow: hidden;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
        }

        .tz-section-header {
            padding: 20px 24px;
            border-bottom: 1px solid #f0f2f8;
            background: #fcfcff;
        }

        .tz-section-label {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .tz-section-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .bg-blue-soft {
            background: #e8f0fe;
        }

        .bg-success-soft {
            background: #e6f7ee;
        }

        .bg-warning-soft {
            background: #fff8e1;
        }

        .bg-danger-soft {
            background: #fce8e8;
        }

        .bg-purple-soft {
            background: #f0ebff;
        }

        .bg-info-soft {
            background: #e3f6fd;
        }

        .text-purple {
            color: #6f42c1 !important;
        }

        .tz-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: #4b5568;
            margin-bottom: 6px;
            letter-spacing: 0.1px;
        }

        .tz-input {
            border-radius: 12px;
            border: 1.5px solid #e5e8f0;
            padding: 10px 14px;
            font-size: 0.875rem;
            color: #1a202c;
            transition: border-color 0.2s, box-shadow 0.2s;
            box-shadow: none !important;
            background: #fff;
        }

        .tz-input:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.08) !important;
        }

        .tz-input::placeholder {
            color: #a0aec0;
        }

        .tz-sub-section {
            background: #f9faff;
            border-radius: 14px;
            padding: 16px 20px;
            border: 1px solid #eaecf4;
        }

        .tz-form-footer {
            margin-top: 20px;
            padding-top: 16px;
            border-top: 1px solid #f0f2f8;
            display: flex;
            justify-content: flex-end;
        }

        .tz-divider {
            border-color: #f0f2f8;
            margin: 16px 0;
        }

        .tz-step-badge {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #eef2ff;
            color: #4f46e5;
            font-weight: 700;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .tz-preview-card {
            background: #f8f9fc;
            border: 1.5px solid #eaecf4;
            border-radius: 16px;
            padding: 16px;
        }

        .tz-preview-img {
            width: 100%;
            height: 120px;
            object-fit: cover;
        }

        .tz-icon-preview {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: #eff6ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0d6efd;
            font-size: 1.2rem;
        }
    </style>


</x-app-layout>

