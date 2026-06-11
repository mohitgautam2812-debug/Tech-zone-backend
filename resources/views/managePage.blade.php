<x-app-layout>

    <style>
        .tz-page-card {
            background: #fff;
            border-radius: 20px;
            border: 1.5px solid #f0f0f6;
            padding: 28px;
            display: flex;
            flex-direction: column;
            height: 100%;
            transition: transform .28s ease, box-shadow .28s ease, border-color .28s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .04);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .tz-page-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(13, 110, 253, .03), transparent 60%);
            opacity: 0;
            transition: opacity .28s;
            pointer-events: none;
        }

        .tz-page-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 50px rgba(13, 110, 253, .12);
            border-color: rgba(13, 110, 253, .2);
        }

        .tz-page-card:hover::before {
            opacity: 1;
        }

        /* Icon */
        .tz-page-icon {
            width: 60px;
            height: 60px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        /* Purple custom (Bootstrap doesn't have it) */
        .bg-purple-subtle {
            background: #ede9fe !important;
        }

        .text-purple {
            color: #6d28d9 !important;
        }

        /* Status pill */
        .tz-live-badge {
            background: #dcfce7;
            color: #15803d;
            border: 1px solid #86efac;
            font-size: 10.5px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 50px;
            letter-spacing: .04em;
        }

        /* Tags */
        .tz-tag {
            background: #f3f4f6;
            color: #374151;
            border-radius: 50px;
            padding: 5px 13px;
            font-size: 11px;
            font-weight: 600;
        }

        /* Manage button */
        .tz-manage-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 12px;
            border-radius: 14px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            background: linear-gradient(135deg, #1e293b, #334155);
            color: #fff !important;
            border: none;
            transition: opacity .2s, transform .2s;
            position: relative;
            z-index: 5;
        }

        .tz-manage-btn:hover {
            opacity: .88;
            transform: translateY(-1px);
            color: #fff;
        }

        /* Hero */
        .tz-hero {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            border-radius: 24px;
            padding: 40px 44px;
            color: #fff;
            margin-bottom: 32px;
            position: relative;
            overflow: hidden;
        }

        .tz-hero::after {
            content: '';
            position: absolute;
            top: -80px;
            right: -80px;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            background: radial-gradient(rgba(255, 255, 255, .07), transparent 70%);
        }

        .tz-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, .1);
            border: 1px solid rgba(255, 255, 255, .14);
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .08em;
            margin-bottom: 16px;
        }

        /* Stat cards */
        .tz-stat {
            background: #fff;
            border-radius: 18px;
            padding: 22px 24px;
            border: 1px solid #f0f0f6;
            box-shadow: 0 4px 16px rgba(0, 0, 0, .04);
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .tz-stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .tz-stat h3 {
            font-size: 28px;
            font-weight: 800;
            margin: 0;
        }

        .tz-stat p {
            font-size: 12px;
            color: #6b7280;
            margin: 0;
        }

        /* Section header */
        .tz-section-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .tz-section-title {
            font-size: 16px;
            font-weight: 800;
            color: #111827;
        }

        @media(max-width: 768px) {
            .tz-hero {
                padding: 28px 24px;
            }

            .tz-hero h1 {
                font-size: 28px !important;
            }
        }
    </style>

    <div class="container-fluid py-4 px-4">

        {{-- ── HERO ── --}}
        <div class="tz-hero">
            <div class="row align-items-center g-3">
                <div class="col-lg-8">
                    <span class="tz-hero-badge">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                        WEBSITE CMS
                    </span>
                    <h1 style="font-size:clamp(24px,4vw,44px); font-weight:800; margin:0 0 10px;">
                        Manage Website Pages
                    </h1>
                    <p style="color:rgba(255,255,255,.7); font-size:14px; line-height:1.75; max-width:560px; margin:0;">
                        Control all frontend pages, dynamic sections, banners, products,
                        layouts and content from one central place.
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <div
                        style="background:rgba(255,255,255,.08); border:1px solid rgba(255,255,255,.14); border-radius:16px; padding:16px 20px; display:inline-block;">
                        <div
                            style="font-size:11px; color:rgba(255,255,255,.5); margin-bottom:4px; letter-spacing:.06em; text-transform:uppercase;">
                            Total Pages</div>
                        <div style="font-size:40px; font-weight:900; line-height:1; color:#fff;">{{ $stats['total'] }}
                        </div>
                        <div style="font-size:11px; color:rgba(255,255,255,.45); margin-top:4px;">{{ $stats['live'] }}
                            live · {{ $stats['sections'] }} sections</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── STAT CARDS ── --}}
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-4">
                <div class="tz-stat">
                    <div class="tz-stat-icon" style="background:#eff6ff; color:#1d4ed8;">
                        <i class="fa-solid fa-file-lines"></i>
                    </div>
                    <div>
                        <h3>{{ $stats['total'] }}</h3>
                        <p>Total Pages</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="tz-stat">
                    <div class="tz-stat-icon" style="background:#f0fdf4; color:#15803d;">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div>
                        <h3>{{ $stats['live'] }}</h3>
                        <p>Live Pages</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="tz-stat">
                    <div class="tz-stat-icon" style="background:#fefce8; color:#a16207;">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <div>
                        <h3>{{ $stats['sections'] }}+</h3>
                        <p>Dynamic Sections</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── PAGE GRID ── --}}
        <div class="tz-section-head">
            <span class="tz-section-title">
                <i class="fa-solid fa-grid-2 me-2 text-primary"></i>All Pages
            </span>
            <span class="badge rounded-pill px-3 py-2"
                style="background:#eff6ff; color:#1d4ed8; font-size:11px; font-weight:700;">
                {{ $stats['total'] }} pages
            </span>
        </div>

        <div class="row g-4">
            @foreach($pages as $page)
                <div class="col-md-6 col-xl-4">
                    <div class="tz-page-card">

                        {{-- Top row --}}
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div
                                class="tz-page-icon bg-{{ $page['color'] == 'purple' ? 'purple' : $page['color'] }}-subtle text-{{ $page['color'] == 'purple' ? 'purple' : $page['color'] }}">
                                <i class="{{ $page['icon'] }}"></i>
                            </div>
                            <span class="tz-live-badge">
                                <i class="fa-solid fa-circle" style="font-size:6px;"></i>
                                {{ $page['status'] }}
                            </span>
                        </div>

                        {{-- Title + desc --}}
                        <h5 class="fw-800 mb-2" style="font-size:18px; font-weight:800; color:#111827;">
                            {{ $page['title'] }}
                        </h5>
                        <p class="text-muted mb-3" style="font-size:13px; line-height:1.7;">
                            {{ $page['desc'] }}
                        </p>

                        {{-- Tags --}}
                        <div class="d-flex flex-wrap gap-2 mb-4">
                            @foreach($page['tags'] as $tag)
                                <span class="tz-tag">{{ $tag }}</span>
                            @endforeach
                        </div>

                        {{-- Button --}}
                        <div class="mt-auto">
                            <a href="{{ $page['route'] }}" class="tz-manage-btn">
                                <i class="fa-solid fa-pen-to-square"></i>
                                Manage Content
                            </a>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

    </div>

</x-app-layout>