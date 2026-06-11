<x-app-layout>

    @section('title', 'Contact Inquiries')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        /* ── Google Font ───────────────────────────────────────────── */
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap');

        /* ── CSS Variables ─────────────────────────────────────────── */
        :root {
            --ci-bg: #f5f6fa;
            --ci-surface: #ffffff;
            --ci-surface-2: #f9fafb;
            --ci-border: #e8eaef;
            --ci-border-2: #d1d5e0;
            --ci-text: #1a1d2e;
            --ci-text-2: #4b5068;
            --ci-muted: #9197b3;
            --ci-accent: #4f6ef7;
            --ci-accent-soft: rgba(79, 110, 247, .08);
            --ci-unread: #f59e0b;
            --ci-unread-soft: rgba(245, 158, 11, .08);
            --ci-read: #10b981;
            --ci-read-soft: rgba(16, 185, 129, .08);
            --ci-danger: #ef4444;
            --ci-danger-soft: rgba(239, 68, 68, .08);
            --ci-shadow: 0 1px 4px rgba(26, 29, 46, .06), 0 4px 16px rgba(26, 29, 46, .06);
            --ci-shadow-lg: 0 8px 40px rgba(26, 29, 46, .12);
            --ci-radius: 14px;
            --ci-radius-sm: 8px;
            --ci-font: 'DM Sans', sans-serif;
            --ci-mono: 'DM Mono', monospace;
        }

        * {
            box-sizing: border-box;
        }

        body,
        .ci-page {
            font-family: var(--ci-font);
            color: var(--ci-text);
            background: var(--ci-bg);
        }

        /* ── Page ──────────────────────────────────────────────────── */
        .ci-page {
            padding: 28px 0 60px;
            min-height: 100vh;
        }

        /* ── Title ─────────────────────────────────────────────────── */
        .ci-title {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -.03em;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--ci-text);
        }

        .ci-title-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--ci-accent);
            flex-shrink: 0;
            box-shadow: 0 0 0 3px var(--ci-accent-soft);
        }

        .ci-subtitle {
            color: var(--ci-muted);
            font-size: .875rem;
            margin-top: 4px;
        }

        /* ── Alerts ─────────────────────────────────────────────────── */
        .ci-alert {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border-radius: var(--ci-radius-sm);
            font-size: .875rem;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .ci-alert-success {
            background: var(--ci-read-soft);
            border: 1px solid rgba(16, 185, 129, .25);
            color: var(--ci-read);
        }

        .ci-alert-error {
            background: var(--ci-danger-soft);
            border: 1px solid rgba(239, 68, 68, .25);
            color: var(--ci-danger);
        }

        /* ── Stat cards ─────────────────────────────────────────────── */
        .ci-stat-card {
            background: var(--ci-surface);
            border: 1px solid var(--ci-border);
            border-radius: var(--ci-radius);
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: var(--ci-shadow);
            transition: box-shadow .2s;
        }

        .ci-stat-card:hover {
            box-shadow: var(--ci-shadow-lg);
        }

        .ci-stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 1.2rem;
        }

        .ci-stat-val {
            font-size: 1.6rem;
            font-weight: 700;
            line-height: 1;
            color: var(--ci-text);
        }

        .ci-stat-label {
            font-size: .78rem;
            color: var(--ci-muted);
            margin-top: 4px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        /* ── Toolbar ────────────────────────────────────────────────── */
        .ci-toolbar {
            background: var(--ci-surface);
            border: 1px solid var(--ci-border);
            border-radius: var(--ci-radius);
            padding: 16px 20px;
            margin-bottom: 20px;
            box-shadow: var(--ci-shadow);
        }

        .ci-search-wrap {
            position: relative;
        }

        .ci-search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--ci-muted);
            font-size: .9rem;
            pointer-events: none;
        }

        .ci-input {
            width: 100%;
            padding: 9px 12px 9px 36px;
            background: var(--ci-surface-2);
            border: 1px solid var(--ci-border);
            border-radius: var(--ci-radius-sm);
            font-size: .875rem;
            color: var(--ci-text);
            font-family: var(--ci-font);
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }

        .ci-input:focus {
            border-color: var(--ci-accent);
            box-shadow: 0 0 0 3px var(--ci-accent-soft);
        }

        .ci-select {
            padding: 9px 12px;
            background: var(--ci-surface-2);
            border: 1px solid var(--ci-border);
            border-radius: var(--ci-radius-sm);
            font-size: .875rem;
            color: var(--ci-text);
            font-family: var(--ci-font);
            outline: none;
            cursor: pointer;
            transition: border-color .2s;
        }

        .ci-select:focus {
            border-color: var(--ci-accent);
            box-shadow: 0 0 0 3px var(--ci-accent-soft);
        }

        .ci-btn-filter {
            padding: 9px 18px;
            background: var(--ci-accent);
            color: #fff;
            border: none;
            border-radius: var(--ci-radius-sm);
            font-size: .875rem;
            font-weight: 600;
            cursor: pointer;
            font-family: var(--ci-font);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: opacity .15s, box-shadow .2s;
        }

        .ci-btn-filter:hover {
            opacity: .88;
            box-shadow: 0 4px 16px rgba(79, 110, 247, .3);
        }

        .ci-btn-clear {
            padding: 9px 14px;
            background: var(--ci-surface-2);
            color: var(--ci-text-2);
            border: 1px solid var(--ci-border);
            border-radius: var(--ci-radius-sm);
            font-size: .875rem;
            font-weight: 500;
            cursor: pointer;
            font-family: var(--ci-font);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            text-decoration: none;
            transition: background .15s;
        }

        .ci-btn-clear:hover {
            background: var(--ci-border);
            color: var(--ci-text);
        }

        /* ── Table panel ────────────────────────────────────────────── */
        .ci-panel {
            background: var(--ci-surface);
            border: 1px solid var(--ci-border);
            border-radius: var(--ci-radius);
            overflow: hidden;
            box-shadow: var(--ci-shadow);
        }

        .ci-panel-head {
            padding: 16px 20px;
            border-bottom: 1px solid var(--ci-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .ci-panel-title {
            font-weight: 700;
            font-size: .95rem;
            color: var(--ci-text);
        }

        .ci-panel-count {
            font-size: .78rem;
            font-weight: 600;
            color: var(--ci-accent);
            background: var(--ci-accent-soft);
            border-radius: 20px;
            padding: 3px 10px;
        }

        /* ── Table ──────────────────────────────────────────────────── */
        .ci-table {
            width: 100%;
            border-collapse: collapse;
            font-size: .875rem;
        }

        .ci-table thead tr {
            background: var(--ci-surface-2);
        }

        .ci-table th {
            padding: 11px 14px;
            text-align: left;
            font-weight: 600;
            font-size: .75rem;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: var(--ci-muted);
            border-bottom: 1px solid var(--ci-border);
            white-space: nowrap;
        }

        .ci-table td {
            padding: 13px 14px;
            border-bottom: 1px solid var(--ci-border);
            vertical-align: middle;
        }

        .ci-table tbody tr:last-child td {
            border-bottom: none;
        }

        .ci-table tbody tr {
            transition: background .15s;
        }

        .ci-table tbody tr:hover {
            background: var(--ci-surface-2);
        }

        .unread-row {
            background: rgba(245, 158, 11, .03);
        }

        .unread-row .ci-name {
            font-weight: 700;
        }

        .ci-id {
            font-size: .75rem;
            color: var(--ci-muted);
            font-family: var(--ci-mono);
        }

        .ci-name {
            font-weight: 600;
            color: var(--ci-text);
        }

        .ci-email {
            font-size: .78rem;
            color: var(--ci-muted);
            margin-top: 2px;
        }

        .ci-phone {
            font-size: .78rem;
            color: var(--ci-muted);
        }

        .ci-subject {
            font-weight: 500;
            color: var(--ci-text-2);
            font-size: .85rem;
            max-width: 180px;
        }

        .ci-msg-preview {
            color: var(--ci-muted);
            font-size: .82rem;
            max-width: 240px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.5;
        }

        .ci-date {
            font-size: .8rem;
            color: var(--ci-text-2);
            white-space: nowrap;
        }

        .ci-date-time {
            font-size: .72rem;
            color: var(--ci-muted);
        }

        /* ── Badges ─────────────────────────────────────────────────── */
        .ci-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: .75rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .ci-badge-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .ci-badge-unread {
            background: var(--ci-unread-soft);
            color: var(--ci-unread);
            border: 1px solid rgba(245, 158, 11, .2);
        }

        .ci-badge-unread .ci-badge-dot {
            background: var(--ci-unread);
        }

        .ci-badge-read {
            background: var(--ci-read-soft);
            color: var(--ci-read);
            border: 1px solid rgba(16, 185, 129, .2);
        }

        .ci-badge-read .ci-badge-dot {
            background: var(--ci-read);
        }

        /* ── Action buttons ─────────────────────────────────────────── */
        .ci-actions {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .ci-btn-icon {
            width: 32px;
            height: 32px;
            border: 1px solid var(--ci-border);
            border-radius: var(--ci-radius-sm);
            background: var(--ci-surface-2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .85rem;
            cursor: pointer;
            transition: all .15s;
            color: var(--ci-text-2);
        }

        .ci-btn-view:hover {
            background: var(--ci-accent-soft);
            border-color: rgba(79, 110, 247, .3);
            color: var(--ci-accent);
        }

        .ci-btn-read:hover {
            background: var(--ci-read-soft);
            border-color: rgba(16, 185, 129, .3);
            color: var(--ci-read);
        }

        .ci-btn-unread:hover {
            background: var(--ci-unread-soft);
            border-color: rgba(245, 158, 11, .3);
            color: var(--ci-unread);
        }

        .ci-btn-delete:hover {
            background: var(--ci-danger-soft);
            border-color: rgba(239, 68, 68, .3);
            color: var(--ci-danger);
        }

        /* ── Pagination ─────────────────────────────────────────────── */
        .ci-pagination {
            padding: 14px 20px;
            border-top: 1px solid var(--ci-border);
            background: var(--ci-surface-2);
        }

        .ci-pagination .pagination .page-link {
            border-radius: var(--ci-radius-sm) !important;
            margin: 0 2px;
            border: 1px solid var(--ci-border);
            color: var(--ci-text-2);
            font-size: .8rem;
            padding: 5px 11px;
            background: var(--ci-surface);
        }

        .ci-pagination .pagination .page-item.active .page-link {
            background: var(--ci-accent);
            border-color: var(--ci-accent);
            color: #fff;
        }

        /* ── Empty state ────────────────────────────────────────────── */
        .ci-empty {
            padding: 60px 20px;
            text-align: center;
            color: var(--ci-muted);
        }

        .ci-empty-icon {
            font-size: 2.5rem;
            margin-bottom: 12px;
            opacity: .4;
        }

        /* ── Modal ──────────────────────────────────────────────────── */
        .ci-modal .modal-content {
            border: 1px solid var(--ci-border);
            border-radius: var(--ci-radius);
            background: var(--ci-surface);
            box-shadow: var(--ci-shadow-lg);
        }

        .ci-modal .modal-header {
            border-bottom: 1px solid var(--ci-border);
            padding: 18px 24px;
            background: var(--ci-surface-2);
            border-radius: var(--ci-radius) var(--ci-radius) 0 0;
        }

        .ci-modal .modal-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--ci-text);
        }

        .ci-modal .modal-body {
            padding: 24px;
        }

        .ci-modal .modal-footer {
            border-top: 1px solid var(--ci-border);
            padding: 14px 24px;
            background: var(--ci-surface-2);
            border-radius: 0 0 var(--ci-radius) var(--ci-radius);
        }

        .ci-modal .btn-close {
            filter: none;
            opacity: .5;
        }

        .ci-modal .btn-close:hover {
            opacity: 1;
        }

        .ci-detail-row {
            margin-bottom: 4px;
        }

        .ci-detail-label {
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .07em;
            color: var(--ci-muted);
            margin-bottom: 4px;
        }

        .ci-detail-val {
            font-size: .9rem;
            color: var(--ci-text);
            font-weight: 500;
            background: var(--ci-surface-2);
            border: 1px solid var(--ci-border);
            border-radius: var(--ci-radius-sm);
            padding: 9px 12px;
            min-height: 38px;
        }

        .ci-detail-val.message {
            white-space: pre-wrap;
            line-height: 1.6;
            min-height: 80px;
        }

        /* Reply textarea & buttons */
        .ci-modal textarea {
            width: 100%;
            padding: 10px 14px;
            background: var(--ci-surface-2);
            border: 1px solid var(--ci-border);
            border-radius: var(--ci-radius-sm);
            font-size: .875rem;
            color: var(--ci-text);
            font-family: var(--ci-font);
            outline: none;
            resize: vertical;
            transition: border-color .2s, box-shadow .2s;
        }

        .ci-modal textarea:focus {
            border-color: var(--ci-accent);
            box-shadow: 0 0 0 3px var(--ci-accent-soft);
        }

        .ci-btn-primary {
            padding: 10px 20px;
            background: var(--ci-accent);
            color: #fff;
            border: none;
            border-radius: var(--ci-radius-sm);
            font-size: .875rem;
            font-weight: 600;
            cursor: pointer;
            font-family: var(--ci-font);
            display: inline-flex;
            align-items: center;
            gap: 7px;
            transition: opacity .15s, box-shadow .2s;
        }

        .ci-btn-primary:hover {
            opacity: .88;
            box-shadow: 0 4px 16px rgba(79, 110, 247, .3);
        }

        .ci-btn-ghost {
            padding: 9px 18px;
            background: transparent;
            color: var(--ci-text-2);
            border: 1px solid var(--ci-border);
            border-radius: var(--ci-radius-sm);
            font-size: .875rem;
            font-weight: 500;
            cursor: pointer;
            font-family: var(--ci-font);
            transition: background .15s;
        }

        .ci-btn-ghost:hover {
            background: var(--ci-surface-2);
        }

        .ci-btn-del-modal {
            padding: 9px 18px;
            background: var(--ci-danger-soft);
            color: var(--ci-danger);
            border: 1px solid rgba(239, 68, 68, .25);
            border-radius: var(--ci-radius-sm);
            font-size: .875rem;
            font-weight: 600;
            cursor: pointer;
            font-family: var(--ci-font);
            display: inline-flex;
            align-items: center;
            gap: 7px;
            transition: background .15s;
        }

        .ci-btn-del-modal:hover {
            background: rgba(239, 68, 68, .14);
        }

        /* ── Toast ──────────────────────────────────────────────────── */
        @keyframes ciSlideIn {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ── Responsive ─────────────────────────────────────────────── */
        @media (max-width: 767px) {
            .ci-table thead {
                display: none;
            }

            .ci-table tr {
                display: block;
                border-bottom: 1px solid var(--ci-border);
                padding: 12px 0;
            }

            .ci-table td {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                padding: 5px 16px;
                border: none;
            }

            .ci-table td::before {
                content: attr(data-label);
                font-size: .72rem;
                font-weight: 700;
                color: var(--ci-muted);
                text-transform: uppercase;
                letter-spacing: .05em;
                flex-shrink: 0;
                margin-right: 10px;
                margin-top: 2px;
            }

            .ci-subject {
                max-width: none;
            }

            .ci-msg-preview {
                max-width: none;
            }
        }
    </style>

    <div class="ci-page">
        <div class="container-fluid px-4">

            {{-- Header --}}
            <div class="d-flex align-items-start justify-content-between flex-wrap gap-3 mb-4">
                <div>
                    <div class="ci-title">
                        <div class="ci-title-dot"></div>
                        Contact Inquiries
                    </div>
                    <div class="ci-subtitle">Manage and respond to customer messages</div>
                </div>
            </div>

            {{-- Alerts --}}
            @if(session('success'))
                <div class="ci-alert ci-alert-success">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="ci-alert ci-alert-error">
                    <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
                </div>
            @endif

            {{-- Stat Cards --}}
            <div class="row g-3 mb-4">
                <div class="col-6 col-md-4">
                    <div class="ci-stat-card">
                        <div class="ci-stat-icon" style="background:var(--ci-accent-soft)">
                            <i class="bi bi-envelope-fill" style="color:var(--ci-accent)"></i>
                        </div>
                        <div>
                            <div class="ci-stat-val">{{ $totalCount }}</div>
                            <div class="ci-stat-label">Total</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="ci-stat-card">
                        <div class="ci-stat-icon" style="background:var(--ci-unread-soft)">
                            <i class="bi bi-envelope-exclamation-fill" style="color:var(--ci-unread)"></i>
                        </div>
                        <div>
                            <div class="ci-stat-val">{{ $unreadCount }}</div>
                            <div class="ci-stat-label">Unread</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="ci-stat-card">
                        <div class="ci-stat-icon" style="background:var(--ci-read-soft)">
                            <i class="bi bi-envelope-check-fill" style="color:var(--ci-read)"></i>
                        </div>
                        <div>
                            <div class="ci-stat-val">{{ $readCount }}</div>
                            <div class="ci-stat-label">Read</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Toolbar --}}
            <div class="ci-toolbar">
                <div class="row g-2 align-items-center">
                    <div class="col-12 col-md-5">
                        <div class="ci-search-wrap">
                            <i class="bi bi-search ci-search-icon"></i>
                            <input type="text" id="searchInput" class="ci-input"
                                placeholder="Search by name, email, subject, phone..."
                                value="{{ request('search') }}" />
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <select id="statusSelect" class="ci-select w-100">
                            <option value="">All Status</option>
                            <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>Unread</option>
                            <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Read</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <button type="button" class="ci-btn-filter w-100" onclick="applyFilter()">
                            <i class="bi bi-funnel-fill"></i> Filter
                        </button>
                    </div>
                    @if(request('search') || request('status'))
                        <div class="col-12 col-md-2">
                            <a href="{{ route('contact.inquiries') }}" class="ci-btn-clear text-decoration-none w-100">
                                <i class="bi bi-x-lg"></i> Clear
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Table --}}
            <div class="ci-panel">
                <div class="ci-panel-head">
                    <span class="ci-panel-title">All Inquiries</span>
                    <span class="ci-panel-count">{{ $inquiries->total() }} records</span>
                </div>

                @if($inquiries->count() > 0)
                    <div class="table-responsive">
                        <table class="ci-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inquiries as $inquiry)
                                    <tr class="{{ $inquiry->status === 'unread' ? 'unread-row' : '' }}"
                                        id="row-{{ $inquiry->id }}">

                                        <td data-label="#">
                                            <span class="ci-id">#{{ $inquiry->id }}</span>
                                        </td>

                                        <td data-label="Customer">
                                            <div class="ci-name">{{ $inquiry->name }}</div>
                                            <div class="ci-email">{{ $inquiry->email }}</div>
                                            @if($inquiry->phone)
                                                <div class="ci-phone">
                                                    <i class="bi bi-telephone me-1"></i>{{ $inquiry->phone }}
                                                </div>
                                            @endif
                                        </td>

                                        <td data-label="Subject">
                                            <span class="ci-subject">{{ $inquiry->subject }}</span>
                                        </td>

                                        <td data-label="Message">
                                            <span class="ci-msg-preview">{{ $inquiry->message }}</span>
                                        </td>

                                        <td data-label="Status">
                                            <span class="ci-badge ci-badge-{{ $inquiry->status }}"
                                                id="badge-{{ $inquiry->id }}">
                                                <span class="ci-badge-dot"></span>
                                                {{ ucfirst($inquiry->status) }}
                                            </span>
                                        </td>

                                        <td data-label="Date">
                                            <span class="ci-date">{{ $inquiry->created_at->format('d M Y') }}</span><br>
                                            <span class="ci-date-time">{{ $inquiry->created_at->format('h:i A') }}</span>
                                        </td>

                                        <td data-label="Actions">
                                            <div class="ci-actions">
                                                {{-- View --}}
                                                <button type="button" class="ci-btn-icon ci-btn-view" title="View" onclick="openModal(
                                                                {{ $inquiry->id }},
                                                                '{{ addslashes($inquiry->name) }}',
                                                                '{{ addslashes($inquiry->email) }}',
                                                                '{{ addslashes($inquiry->phone ?? '') }}',
                                                                '{{ addslashes($inquiry->subject) }}',
                                                                '{{ addslashes($inquiry->message) }}',
                                                                '{{ $inquiry->status }}',
                                                                '{{ $inquiry->created_at->format('d M Y, h:i A') }}'
                                                            )">
                                                    <i class="bi bi-eye"></i>
                                                </button>

                                                {{-- Mark as Read / Unread --}}
                                                @if($inquiry->status === 'unread')
                                                    <button type="button" class="ci-btn-icon ci-btn-read" title="Mark as Read"
                                                        onclick="updateStatus({{ $inquiry->id }}, 'read')">
                                                        <i class="bi bi-check2-all"></i>
                                                    </button>
                                                @else
                                                    <button type="button" class="ci-btn-icon ci-btn-unread" title="Mark as Unread"
                                                        onclick="updateStatus({{ $inquiry->id }}, 'unread')">
                                                        <i class="bi bi-arrow-counterclockwise"></i>
                                                    </button>
                                                @endif

                                                {{-- Delete --}}
                                                <button type="button" class="ci-btn-icon ci-btn-delete" title="Delete"
                                                    onclick="deleteInquiry({{ $inquiry->id }})">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($inquiries->hasPages())
                        <div class="ci-pagination d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <span style="color:var(--ci-muted);font-size:.8rem">
                                Showing {{ $inquiries->firstItem() }}–{{ $inquiries->lastItem() }}
                                of {{ $inquiries->total() }}
                            </span>
                            {{ $inquiries->links() }}
                        </div>
                    @endif

                @else
                    <div class="ci-empty">
                        <div class="ci-empty-icon"><i class="bi bi-inbox"></i></div>
                        <div>
                            @if(request('search') || request('status'))
                                No inquiries match your filter.
                                <a href="{{ route('contact.inquiries') }}" style="color:var(--ci-accent)">Clear filters</a>
                            @else
                                No inquiries yet.
                            @endif
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>

    {{-- ── Modal (outside main layout div, no <form> tags inside) ── --}}
        <div class="modal fade ci-modal" id="inquiryModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="bi bi-envelope-open-fill me-2" style="color:var(--ci-accent)"></i>
                            Inquiry Details
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="ci-detail-row">
                                    <div class="ci-detail-label">Customer Name</div>
                                    <div class="ci-detail-val" id="modal-name"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="ci-detail-row">
                                    <div class="ci-detail-label">Email Address</div>
                                    <div class="ci-detail-val" id="modal-email"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="ci-detail-row">
                                    <div class="ci-detail-label">Phone Number</div>
                                    <div class="ci-detail-val" id="modal-phone"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="ci-detail-row">
                                    <div class="ci-detail-label">Date Submitted</div>
                                    <div class="ci-detail-val" id="modal-date"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="ci-detail-row">
                                    <div class="ci-detail-label">Subject</div>
                                    <div class="ci-detail-val" id="modal-subject"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="ci-detail-row">
                                    <div class="ci-detail-label">Message</div>
                                    <div class="ci-detail-val message" id="modal-message"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="ci-detail-label mb-2">Status</div>
                                <span class="ci-badge" id="modal-status-badge"></span>
                            </div>
                        </div>

                        <hr style="border-color:var(--ci-border);margin:24px 0">

                        {{-- Reply section — plain div, NOT a <form> --}}
                            <div>
                                <div class="ci-detail-label mb-2">Send Reply</div>
                                <textarea id="modal-reply-text" rows="4"
                                    placeholder="Type your reply to the customer..."></textarea>
                                <button type="button" class="ci-btn-primary mt-3" onclick="sendReply()">
                                    <i class="bi bi-send-fill"></i> Send Reply &amp; Mark as Read
                                </button>
                            </div>
                    </div>

                    <div class="modal-footer gap-2">
                        <button type="button" class="ci-btn-ghost" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="ci-btn-del-modal" onclick="deleteFromModal()">
                            <i class="bi bi-trash3"></i> Delete
                        </button>
                    </div>

                </div>
            </div>
        </div>

        @push('scripts')
            <script>
              
                let currentInquiryId = null;

             
                function applyFilter() {
                    const search = document.getElementById('searchInput').value;
                    const status = document.getElementById('statusSelect').value;
                    const url = new URL('{{ route('contact.inquiries') }}', window.location.origin);
                    if (search) url.searchParams.set('search', search);
                    if (status) url.searchParams.set('status', status);
                    window.location.href = url.toString();
                }

                document.getElementById('searchInput').addEventListener('keydown', function (e) {
                    if (e.key === 'Enter') applyFilter();
                });

                // ── Open modal ────────────────────────────────────────────────────────
                function openModal(id, name, email, phone, subject, message, status, date) {
                    currentInquiryId = id;

                    document.getElementById('modal-name').textContent = name;
                    document.getElementById('modal-email').textContent = email;
                    document.getElementById('modal-phone').textContent = phone || '—';
                    document.getElementById('modal-subject').textContent = subject;
                    document.getElementById('modal-message').textContent = message;
                    document.getElementById('modal-date').textContent = date;
                    document.getElementById('modal-reply-text').value = '';

                    const badge = document.getElementById('modal-status-badge');
                    badge.className = 'ci-badge ci-badge-' + status;
                    badge.innerHTML = '<span class="ci-badge-dot"></span>'
                        + status.charAt(0).toUpperCase() + status.slice(1);

                    // Auto-mark as read when opened
                    if (status === 'unread') {
                        updateStatus(id, 'read', true);
                    }

                    new bootstrap.Modal(document.getElementById('inquiryModal')).show();
                }

                // ── Update status (AJAX) ──────────────────────────────────────────────
                function updateStatus(id, status, silent = false) {
                    fetch('/contact-inquiries/' + id + '/status', {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: JSON.stringify({ status }),
                    })
                        .then(r => r.json())
                        .then(data => {
                            if (!data.success) return;

                            // Update table row highlight
                            const row = document.getElementById('row-' + id);
                            if (row) {
                                row.classList.toggle('unread-row', status === 'unread');
                            }

                            // Update table badge
                            const badge = document.getElementById('badge-' + id);
                            if (badge) {
                                badge.className = 'ci-badge ci-badge-' + status;
                                badge.innerHTML = '<span class="ci-badge-dot"></span>'
                                    + status.charAt(0).toUpperCase() + status.slice(1);
                            }

                            // Update modal badge
                            const modalBadge = document.getElementById('modal-status-badge');
                            if (modalBadge) {
                                modalBadge.className = 'ci-badge ci-badge-' + status;
                                modalBadge.innerHTML = '<span class="ci-badge-dot"></span>'
                                    + status.charAt(0).toUpperCase() + status.slice(1);
                            }

                            // Update table row mark-as button (swap icon)
                            const actionCell = row ? row.querySelector('.ci-actions') : null;
                            if (actionCell) {
                                const readBtn = actionCell.querySelector('.ci-btn-read');
                                const unreadBtn = actionCell.querySelector('.ci-btn-unread');
                                if (status === 'read' && readBtn) {
                                    readBtn.className = 'ci-btn-icon ci-btn-unread';
                                    readBtn.title = 'Mark as Unread';
                                    readBtn.querySelector('i').className = 'bi bi-arrow-counterclockwise';
                                    readBtn.setAttribute('onclick', `updateStatus(${id}, 'unread')`);
                                } else if (status === 'unread' && unreadBtn) {
                                    unreadBtn.className = 'ci-btn-icon ci-btn-read';
                                    unreadBtn.title = 'Mark as Read';
                                    unreadBtn.querySelector('i').className = 'bi bi-check2-all';
                                    unreadBtn.setAttribute('onclick', `updateStatus(${id}, 'read')`);
                                }
                            }

                            if (!silent) showToast(status === 'read' ? 'Marked as Read' : 'Marked as Unread', 'success');
                        })
                        .catch(() => showToast('Failed to update status', 'error'));
                }

                // ── Delete ────────────────────────────────────────────────────────────
                function deleteInquiry(id) {
                    if (!confirm('Delete this inquiry? This cannot be undone.')) return;

                    fetch('/contact-inquiries/' + id, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                    })
                        .then(r => r.json())
                        .then(data => {
                            if (!data.success) return;
                            const row = document.getElementById('row-' + id);
                            if (row) row.remove();
                            showToast('Inquiry deleted', 'success');
                        })
                        .catch(() => showToast('Failed to delete', 'error'));
                }

                function deleteFromModal() {
                    if (!currentInquiryId) return;
                    bootstrap.Modal.getInstance(document.getElementById('inquiryModal')).hide();
                    deleteInquiry(currentInquiryId);
                }

                // ── Send reply ────────────────────────────────────────────────────────
                function sendReply() {
                    const reply = document.getElementById('modal-reply-text').value.trim();
                    if (!reply) {
                        showToast('Please type a reply message', 'error');
                        return;
                    }

                    fetch('/contact-inquiries/' + currentInquiryId + '/reply', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: JSON.stringify({ reply }),
                    })
                        .then(r => r.json())
                        .then(data => {
                            if (!data.success) {
                                showToast(data.message || 'Failed to send reply', 'error');
                                return;
                            }
                            showToast('Reply sent and marked as read', 'success');
                            updateStatus(currentInquiryId, 'read', true);
                            document.getElementById('modal-reply-text').value = '';
                        })
                        .catch(() => showToast('Failed to send reply', 'error'));
                }

                // ── Toast ─────────────────────────────────────────────────────────────
                function showToast(msg, type) {
                    const old = document.getElementById('ci-toast');
                    if (old) old.remove();

                    const isSuccess = type === 'success';
                    const t = document.createElement('div');
                    t.id = 'ci-toast';
                    Object.assign(t.style, {
                        position: 'fixed',
                        bottom: '24px',
                        right: '24px',
                        zIndex: '9999',
                        background: isSuccess ? 'rgba(16,185,129,.08)' : 'rgba(239,68,68,.08)',
                        border: '1px solid ' + (isSuccess ? 'rgba(16,185,129,.25)' : 'rgba(239,68,68,.25)'),
                        borderRadius: '12px',
                        padding: '12px 18px',
                        color: isSuccess ? '#10b981' : '#ef4444',
                        fontSize: '.875rem',
                        fontWeight: '500',
                        display: 'flex',
                        alignItems: 'center',
                        gap: '8px',
                        boxShadow: '0 8px 30px rgba(26,29,46,.12)',
                        animation: 'ciSlideIn .3s ease',
                        maxWidth: '320px',
                        fontFamily: 'var(--ci-font)',
                    });
                    t.innerHTML = `<i class="bi ${isSuccess ? 'bi-check-circle-fill' : 'bi-exclamation-circle-fill'}"></i>${msg}`;
                    document.body.appendChild(t);

                    setTimeout(() => {
                        t.style.animation = 'ciSlideIn .3s ease reverse';
                        setTimeout(() => t.remove(), 280);
                    }, 3000);
                }
            </script>
        @endpush

</x-app-layout>