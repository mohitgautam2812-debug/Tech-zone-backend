<x-app-layout>

    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --ink: #0b0d14;
            --surface: #ffffff;
            --muted: #f4f5f8;
            --border: #e8eaef;
            --border2: #d0d4e0;
            --text1: #111827;
            --text2: #6b7280;
            --text3: #9ca3af;
            --violet: #7c3aed;
            --violet-l: #ede9fe;
            --violet-d: #5b21b6;
            --emerald: #059669;
            --emerald-l: #d1fae5;
            --rose: #dc2626;
            --rose-l: #fee2e2;
            --amber: #d97706;
            --amber-l: #fef3c7;
            --teal: #0d9488;
            --teal-l: #ccfbf1;
            --orange: #ea580c;
            --orange-l: #fff7ed;
            --sky: #0284c7;
            --sky-l: #e0f2fe;
            --sans: 'Outfit', sans-serif;
            --mono: 'JetBrains Mono', monospace;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .rf {
            font-family: var(--sans);
            background: var(--muted);
            min-height: 100vh;
            padding: 28px 24px;
            color: var(--text1);
        }

        /* ── Header ── */
        .rf-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 28px;
        }

        .rf-title {
            font-size: 26px;
            font-weight: 800;
            color: var(--text1);
            letter-spacing: -0.03em;
            line-height: 1;
        }

        .rf-sub {
            font-size: 13px;
            color: var(--text2);
            margin-top: 5px;
        }

        .rf-user-pill {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 999px;
            padding: 8px 16px 8px 8px;
            font-size: 13px;
            font-weight: 600;
            color: var(--text1);
            box-shadow: 0 1px 4px rgba(0, 0, 0, .06);
        }

        .rf-user-av {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--sky);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ── Alert ── */
        .rf-alert-ok {
            background: #f0fdf4;
            border: 1px solid #86efac;
            border-radius: 12px;
            padding: 12px 18px;
            font-size: 13px;
            color: #166534;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .rf-alert-err {
            background: #fff1f2;
            border: 1px solid #fca5a5;
            border-radius: 12px;
            padding: 12px 18px;
            font-size: 13px;
            color: #991b1b;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        /* ── Stats ── */
        .rf-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 14px;
            margin-bottom: 24px;
        }

        .rf-stat {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 18px 18px 14px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .04);
            position: relative;
            overflow: hidden;
        }

        .rf-stat::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            border-radius: 16px 16px 0 0;
        }

        .rf-stat.violet::before {
            background: var(--violet);
        }

        .rf-stat.amber::before {
            background: var(--amber);
        }

        .rf-stat.sky::before {
            background: var(--sky);
        }

        .rf-stat.emerald::before {
            background: var(--emerald);
        }

        .rf-stat.rose::before {
            background: var(--rose);
        }

        .rf-stat-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            margin-bottom: 12px;
        }

        .rf-stat-num {
            font-family: var(--mono);
            font-size: 24px;
            font-weight: 600;
            color: var(--text1);
            line-height: 1;
        }

        .rf-stat-lbl {
            font-size: 11px;
            color: var(--text3);
            margin-top: 4px;
            text-transform: uppercase;
            letter-spacing: .06em;
        }

        /* ── Card ── */
        .rf-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .05);
            margin-bottom: 28px;
        }

        .rf-card-head {
            padding: 18px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .rf-card-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: var(--sky-l);
            color: var(--sky);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
        }

        .rf-card-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--text1);
        }

        .rf-card-sub {
            font-size: 12px;
            color: var(--text2);
            margin-top: 2px;
        }

        /* ── Table ── */
        .rf-table-wrap {
            overflow-x: auto;
        }

        .rf-table-wrap::-webkit-scrollbar {
            height: 4px;
        }

        .rf-table-wrap::-webkit-scrollbar-thumb {
            background: var(--border2);
            border-radius: 4px;
        }

        .rf-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .rf-table thead th {
            background: #fafafa;
            padding: 12px 18px;
            text-align: left;
            font-family: var(--mono);
            font-size: 10px;
            letter-spacing: .1em;
            color: var(--text3);
            text-transform: uppercase;
            border-bottom: 1px solid var(--border);
            font-weight: 400;
            white-space: nowrap;
        }

        .rf-table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background .15s;
        }

        .rf-table tbody tr:last-child {
            border-bottom: none;
        }

        .rf-table tbody tr:hover {
            background: #f9fbff;
        }

        .rf-table td {
            padding: 16px 18px;
            vertical-align: middle;
        }

        /* ── Num badge ── */
        .rf-num {
            font-family: var(--mono);
            font-size: 11px;
            color: var(--sky);
            background: var(--sky-l);
            padding: 4px 10px;
            border-radius: 6px;
            display: inline-block;
        }

        /* ── Amount ── */
        .rf-amount {
            font-family: var(--mono);
            font-size: 14px;
            font-weight: 600;
            color: var(--emerald);
        }

        /* ── Customer ── */
        .rf-av {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--sky-l);
            color: var(--sky);
            font-size: 11px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* ── Method badge ── */
        .rf-method {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .05em;
            text-transform: uppercase;
            background: var(--violet-l);
            color: var(--violet);
            border: 1px solid #ddd6fe;
            padding: 3px 10px;
            border-radius: 6px;
        }

        /* ── Status badges ── */
        .rf-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 13px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .03em;
            white-space: nowrap;
        }

        .rf-badge::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .b-rp {
            background: var(--amber-l);
            color: var(--amber);
            border: 1px solid #fde68a;
        }

        .b-rp::before {
            background: var(--amber);
            box-shadow: 0 0 5px var(--amber);
        }

        .b-rpr {
            background: var(--sky-l);
            color: var(--sky);
            border: 1px solid #bae6fd;
        }

        .b-rpr::before {
            background: var(--sky);
            box-shadow: 0 0 5px var(--sky);
        }

        .b-rco {
            background: var(--emerald-l);
            color: var(--emerald);
            border: 1px solid #6ee7b7;
        }

        .b-rco::before {
            background: var(--emerald);
            box-shadow: 0 0 5px var(--emerald);
        }

        .b-rfa {
            background: var(--rose-l);
            color: var(--rose);
            border: 1px solid #fca5a5;
        }

        .b-rfa::before {
            background: var(--rose);
            box-shadow: 0 0 5px var(--rose);
        }

        /* ── Selects / inputs ── */
        .rf-select {
            font-family: var(--sans);
            font-size: 12px;
            font-weight: 600;
            padding: 8px 32px 8px 12px;
            border-radius: 10px;
            border: 1px solid var(--border2);
            background: var(--surface);
            color: var(--text1);
            min-width: 150px;
            cursor: pointer;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%236b7280' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
        }

        .rf-select:focus {
            border-color: var(--sky);
            box-shadow: 0 0 0 3px rgba(2, 132, 199, .1);
        }

        .rf-input {
            font-family: var(--sans);
            font-size: 12px;
            padding: 8px 12px;
            border-radius: 10px;
            border: 1px solid var(--border2);
            background: var(--surface);
            color: var(--text1);
            outline: none;
            width: 100%;
            transition: border-color .2s;
        }

        .rf-input:focus {
            border-color: var(--sky);
            box-shadow: 0 0 0 3px rgba(2, 132, 199, .1);
        }

        .rf-btn {
            font-family: var(--sans);
            font-size: 12px;
            font-weight: 700;
            padding: 9px 18px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: opacity .2s, transform .1s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .rf-btn:hover {
            opacity: .88;
            transform: translateY(-1px);
        }

        .rf-btn-sky {
            background: var(--sky);
            color: #fff;
        }

        .rf-btn-emerald {
            background: var(--emerald);
            color: #fff;
        }

        .rf-btn-rose {
            background: var(--rose);
            color: #fff;
        }

        /* ── Tx pill ── */
        .rf-tx {
            font-family: var(--mono);
            font-size: 10px;
            color: var(--text2);
            background: var(--muted);
            border: 1px solid var(--border);
            padding: 3px 8px;
            border-radius: 6px;
        }

        /* ── Process refund form panel ── */
        .rf-process-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .05);
            margin-bottom: 28px;
        }

        .rf-process-title {
            font-size: 17px;
            font-weight: 800;
            color: var(--text1);
            margin-bottom: 4px;
        }

        .rf-process-sub {
            font-size: 13px;
            color: var(--text2);
            margin-bottom: 20px;
        }

        .rf-grid2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .rf-field {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .rf-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text2);
        }

        .rf-conditional {
            display: none;
        }

        .rf-conditional.show {
            display: contents;
        }

        /* ── Empty ── */
        .rf-empty {
            padding: 80px 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 14px;
        }

        .rf-empty-icon {
            width: 72px;
            height: 72px;
            border-radius: 20px;
            background: var(--muted);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: var(--text3);
        }

        /* ── Product snippet ── */
        .rf-prod {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 160px;
        }

        .rf-prod-img {
            width: 44px;
            height: 44px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid var(--border);
            flex-shrink: 0;
        }

        .rf-prod-ph {
            width: 44px;
            height: 44px;
            border-radius: 8px;
            background: var(--muted);
            border: 1px dashed var(--border2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text3);
            font-size: 14px;
            flex-shrink: 0;
        }

        .rf-prod-name {
            font-weight: 600;
            font-size: 12px;
            color: var(--text1);
        }

        .rf-prod-date {
            font-size: 10px;
            color: var(--text3);
            font-family: var(--mono);
            margin-top: 2px;
        }

        @media(max-width:640px) {
            .rf {
                padding: 16px 12px;
            }

            .rf-title {
                font-size: 20px;
            }

            .rf-stats {
                grid-template-columns: 1fr 1fr;
            }

            .rf-grid2 {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="rf">

        {{-- HEADER --}}
        <div class="rf-header">
            <div>
                <h1 class="rf-title">Refund Management</h1>
                <p class="rf-sub">Process, track and complete customer refunds</p>
            </div>
            <div class="rf-user-pill">
                <div class="rf-user-av">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                {{ auth()->user()->name }}
            </div>
        </div>

        {{-- ALERTS --}}
        @if(session('success'))
            <div class="rf-alert-ok"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="rf-alert-err"><i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}</div>
        @endif

        {{-- STATS --}}
        @php
            $total = $refunds->count();
            $pending = $refunds->where('status', 'pending')->count();
            $processing = $refunds->where('status', 'processing')->count();
            $completed = $refunds->where('status', 'completed')->count();
            $failed = $refunds->where('status', 'failed')->count();
            $totalAmt = $refunds->where('status', 'completed')->sum('refund_amount');
        @endphp
        <div class="rf-stats">
            <div class="rf-stat violet">
                <div class="rf-stat-icon" style="background:var(--violet-l);color:var(--violet);"><i
                        class="fa-solid fa-money-bill-wave"></i></div>
                <div class="rf-stat-num">{{ $total }}</div>
                <div class="rf-stat-lbl">Total</div>
            </div>
            <div class="rf-stat amber">
                <div class="rf-stat-icon" style="background:var(--amber-l);color:var(--amber);"><i
                        class="fa-solid fa-clock"></i></div>
                <div class="rf-stat-num">{{ $pending }}</div>
                <div class="rf-stat-lbl">Pending</div>
            </div>
            <div class="rf-stat sky">
                <div class="rf-stat-icon" style="background:var(--sky-l);color:var(--sky);"><i
                        class="fa-solid fa-spinner"></i></div>
                <div class="rf-stat-num">{{ $processing }}</div>
                <div class="rf-stat-lbl">Processing</div>
            </div>
            <div class="rf-stat emerald">
                <div class="rf-stat-icon" style="background:var(--emerald-l);color:var(--emerald);"><i
                        class="fa-solid fa-check-double"></i></div>
                <div class="rf-stat-num">{{ $completed }}</div>
                <div class="rf-stat-lbl">Completed</div>
            </div>
            <div class="rf-stat rose">
                <div class="rf-stat-icon" style="background:var(--rose-l);color:var(--rose);"><i
                        class="fa-solid fa-xmark"></i></div>
                <div class="rf-stat-num">{{ $failed }}</div>
                <div class="rf-stat-lbl">Failed</div>
            </div>
            <div class="rf-stat emerald">
                <div class="rf-stat-icon" style="background:var(--emerald-l);color:var(--emerald);"><i
                        class="fa-solid fa-indian-rupee-sign"></i></div>
                <div class="rf-stat-num" style="font-size:18px;">₹{{ number_format($totalAmt, 0) }}</div>
                <div class="rf-stat-lbl">Refunded</div>
            </div>
        </div>

        {{-- ════════════════════════════════════
        INITIATE REFUND from approved returns
        ════════════════════════════════════ --}}
        @php
            $approvedReturns = \App\Models\ReturnRequest::with(['order.product', 'user'])
                ->whereIn('status', ['approved', 'request_approved'])
                ->whereDoesntHave('refund', fn($q) => $q->whereIn('status', ['pending', 'processing', 'completed']))
                ->get();
        @endphp

        @if($approvedReturns->isNotEmpty())
            <div class="rf-process-card">
                <div class="rf-process-title"><i class="fa-solid fa-bolt"
                        style="color:var(--amber);margin-right:8px;"></i>Initiate New Refund</div>
                <div class="rf-process-sub">These return requests are approved and waiting for a refund to be processed.
                </div>

                @foreach($approvedReturns as $ret)
                    <div
                        style="background:var(--muted);border:1px solid var(--border);border-radius:14px;padding:18px;margin-bottom:16px;">

                        {{-- Return summary --}}
                        <div style="display:flex;align-items:center;gap:14px;flex-wrap:wrap;margin-bottom:16px;">
                            @if(optional($ret->order->product)->image)
                                <img src="{{ asset('storage/' . $ret->order->product->image) }}"
                                    style="width:50px;height:50px;border-radius:10px;object-fit:cover;border:1px solid var(--border);">
                            @else
                                <div
                                    style="width:50px;height:50px;border-radius:10px;background:var(--surface);border:1px dashed var(--border2);display:flex;align-items:center;justify-content:center;color:var(--text3);font-size:18px;">
                                    <i class="fa-solid fa-image"></i></div>
                            @endif
                            <div>
                                <div style="font-weight:700;font-size:14px;">
                                    {{ optional($ret->order->product)->name ?? 'Product' }}</div>
                                <div style="font-size:12px;color:var(--text2);">Return #{{ $ret->id }} ·
                                    {{ $ret->user->name ?? '—' }} · <span
                                        style="font-family:var(--mono);">₹{{ number_format($ret->order->total_price ?? 0, 2) }}</span>
                                </div>
                                <div style="font-size:11px;color:var(--text3);margin-top:2px;">Reason: {{ $ret->reason }}</div>
                            </div>
                        </div>

                        {{-- Refund form --}}
                        <form method="POST" action="{{ route('refunds.create') }}" class="refund-form"
                            onsubmit="return validateRefundForm(this)">
                            @csrf
                            <input type="hidden" name="return_id" value="{{ $ret->id }}">
                            <input type="hidden" name="refund_amount" value="{{ $ret->order->total_price ?? 0 }}">

                            <div class="rf-grid2" style="margin-bottom:12px;">
                                <div class="rf-field">
                                    <label class="rf-label">Refund Method</label>
                                    <select name="refund_method" class="rf-select" style="min-width:unset;"
                                        onchange="toggleRefundFields(this)">
                                        <option value="original_payment">💳 Original Payment</option>
                                        <option value="bank_transfer">🏦 Bank Transfer</option>
                                        <option value="upi">📱 UPI</option>
                                        <option value="wallet">👝 Wallet</option>
                                        <option value="cash">💵 Cash</option>
                                    </select>
                                </div>
                                <div class="rf-field">
                                    <label class="rf-label">Admin Notes <span
                                            style="color:var(--text3);">(optional)</span></label>
                                    <input type="text" name="admin_notes" class="rf-input" placeholder="Internal note...">
                                </div>
                            </div>

                            {{-- Bank fields --}}
                            <div class="rf-grid2 bank-fields" style="display:none;margin-bottom:12px;">
                                <div class="rf-field">
                                    <label class="rf-label">Bank Account Number</label>
                                    <input type="text" name="bank_account_number" class="rf-input"
                                        placeholder="e.g. 1234567890">
                                </div>
                                <div class="rf-field">
                                    <label class="rf-label">IFSC Code</label>
                                    <input type="text" name="bank_ifsc" class="rf-input" placeholder="e.g. HDFC0001234">
                                </div>
                            </div>

                            {{-- UPI field --}}
                            <div class="rf-grid2 upi-fields" style="display:none;margin-bottom:12px;">
                                <div class="rf-field">
                                    <label class="rf-label">UPI ID</label>
                                    <input type="text" name="upi_id" class="rf-input" placeholder="e.g. user@upi">
                                </div>
                            </div>

                            <button type="submit" class="rf-btn rf-btn-emerald">
                                <i class="fa-solid fa-paper-plane"></i>
                                Process Refund of ₹{{ number_format($ret->order->total_price ?? 0, 2) }}
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- ════════════════════════════════════
        REFUND TABLE
        ════════════════════════════════════ --}}
        <div class="rf-card">
            <div class="rf-card-head">
                <div class="rf-card-icon"><i class="fa-solid fa-money-bill-wave"></i></div>
                <div>
                    <div class="rf-card-title">All Refunds</div>
                    <div class="rf-card-sub">{{ $total }} total · ₹{{ number_format($totalAmt, 2) }} completed</div>
                </div>
            </div>

            @if($refunds->isEmpty())
                <div class="rf-empty">
                    <div class="rf-empty-icon"><i class="fa-solid fa-money-bill-wave"></i></div>
                    <div style="font-size:16px;font-weight:700;">No refunds yet</div>
                    <div style="font-size:13px;color:var(--text2);">Refunds will appear here once return requests are
                        approved.</div>
                </div>
            @else
                <div class="rf-table-wrap">
                    <table class="rf-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Transaction ID</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($refunds as $refund)
                                <tr>
                                    {{-- ID --}}
                                    <td><span class="rf-num">#{{ $refund->id }}</span></td>

                                    {{-- Product --}}
                                    <td>
                                        @php $product = optional(optional($refund->returnRequest)->order)->product; @endphp
                                        <div class="rf-prod">
                                            @if(optional($product)->image)
                                                <img src="{{ asset('storage/' . $product->image) }}" class="rf-prod-img" alt="">
                                            @else
                                                <div class="rf-prod-ph"><i class="fa-solid fa-image"></i></div>
                                            @endif
                                            <div>
                                                <div class="rf-prod-name">{{ optional($product)->name ?? 'N/A' }}</div>
                                                <div class="rf-prod-date">{{ $refund->created_at->format('d M Y') }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Customer --}}
                                    <td>
                                        @if($refund->user)
                                            <div style="display:flex;align-items:center;gap:10px;">
                                                <div class="rf-av">{{ strtoupper(substr($refund->user->name, 0, 2)) }}</div>
                                                <div>
                                                    <div style="font-size:13px;font-weight:600;">{{ $refund->user->name }}</div>
                                                    <div style="font-size:11px;color:var(--text3);">{{ $refund->user->email }}</div>
                                                </div>
                                            </div>
                                        @else
                                            <span style="color:var(--text3);font-size:12px;">Unknown</span>
                                        @endif
                                    </td>

                                    {{-- Amount --}}
                                    <td><span class="rf-amount">₹{{ number_format($refund->refund_amount, 2) }}</span></td>

                                    {{-- Method --}}
                                    <td>
                                        @php
                                            $methodIcons = [
                                                'original_payment' => 'fa-credit-card',
                                                'bank_transfer' => 'fa-building-columns',
                                                'wallet' => 'fa-wallet',
                                                'upi' => 'fa-mobile-screen-button',
                                                'cash' => 'fa-money-bill',
                                            ];
                                            $methodLabels = [
                                                'original_payment' => 'Original',
                                                'bank_transfer' => 'Bank',
                                                'wallet' => 'Wallet',
                                                'upi' => 'UPI',
                                                'cash' => 'Cash',
                                            ];
                                        @endphp
                                        <span class="rf-method">
                                            <i class="fa-solid {{ $methodIcons[$refund->refund_method] ?? 'fa-circle' }}"></i>
                                            {{ $methodLabels[$refund->refund_method] ?? $refund->refund_method }}
                                        </span>
                                        @if($refund->upi_id)
                                            <div style="font-size:10px;color:var(--text3);margin-top:3px;">{{ $refund->upi_id }}
                                            </div>
                                        @endif
                                        @if($refund->bank_ifsc)
                                            <div style="font-size:10px;color:var(--text3);margin-top:3px;">{{ $refund->bank_ifsc }}
                                            </div>
                                        @endif
                                    </td>

                                    {{-- Transaction ID --}}
                                    <td>
                                        @if($refund->transaction_id)
                                            <span class="rf-tx">{{ $refund->transaction_id }}</span>
                                        @else
                                            <span style="color:var(--text3);font-size:11px;font-style:italic;">Not assigned</span>
                                        @endif
                                    </td>

                                    {{-- Status badge --}}
                                    <td>
                                        @php
                                            $badgeMap = [
                                                'pending' => ['class' => 'b-rp', 'icon' => 'fa-clock', 'label' => 'Pending'],
                                                'processing' => ['class' => 'b-rpr', 'icon' => 'fa-spinner', 'label' => 'Processing'],
                                                'completed' => ['class' => 'b-rco', 'icon' => 'fa-check-double', 'label' => 'Completed'],
                                                'failed' => ['class' => 'b-rfa', 'icon' => 'fa-xmark', 'label' => 'Failed'],
                                            ];
                                            $bm = $badgeMap[$refund->status] ?? $badgeMap['pending'];
                                        @endphp
                                        <span class="rf-badge {{ $bm['class'] }}">
                                            <i class="fa-solid {{ $bm['icon'] }}"></i>
                                            {{ $bm['label'] }}
                                        </span>
                                        @if($refund->completed_at)
                                            <div style="font-size:10px;color:var(--text3);margin-top:3px;font-family:var(--mono);">
                                                {{ $refund->completed_at->format('d M Y') }}</div>
                                        @endif
                                    </td>

                                    {{-- Action --}}
                                    <td>
                                        @if($refund->status !== 'completed' && $refund->status !== 'failed')
                                            <button
                                                onclick="openUpdateModal({{ $refund->id }}, '{{ $refund->status }}', '{{ $refund->transaction_id }}')"
                                                class="rf-btn rf-btn-sky" style="font-size:11px;padding:7px 14px;">
                                                <i class="fa-solid fa-pen"></i> Update
                                            </button>
                                        @else
                                            <span style="font-size:11px;color:var(--text3);">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    {{-- ═══════════════════════════════════
    UPDATE STATUS MODAL
    ═══════════════════════════════════ --}}
    <div id="updateModal"
        style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:9999;align-items:center;justify-content:center;padding:20px;backdrop-filter:blur(4px);">
        <div
            style="background:var(--surface);border-radius:20px;padding:28px;width:100%;max-width:480px;box-shadow:0 24px 60px rgba(0,0,0,.2);">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
                <div style="font-size:17px;font-weight:800;">Update Refund Status</div>
                <button onclick="closeUpdateModal()"
                    style="background:none;border:none;font-size:22px;cursor:pointer;color:var(--text2);">✕</button>
            </div>
            <form id="updateForm" method="POST">
                @csrf @method('PUT')
                <div style="display:flex;flex-direction:column;gap:14px;">
                    <div class="rf-field">
                        <label class="rf-label">Status</label>
                        <select name="status" id="modal-status" class="rf-select" style="min-width:unset;">
                            <option value="pending">⏳ Pending</option>
                            <option value="processing">🔄 Processing</option>
                            <option value="completed">✅ Completed</option>
                            <option value="failed">❌ Failed</option>
                        </select>
                    </div>
                    <div class="rf-field">
                        <label class="rf-label">Transaction ID <span style="color:var(--text3);">(for
                                completed)</span></label>
                        <input type="text" name="transaction_id" id="modal-tx" class="rf-input"
                            placeholder="e.g. TXN123456789">
                    </div>
                    <div class="rf-field" id="modal-fail-wrap" style="display:none;">
                        <label class="rf-label">Failure Reason</label>
                        <input type="text" name="failure_reason" class="rf-input" placeholder="Why did it fail?">
                    </div>
                    <div class="rf-field">
                        <label class="rf-label">Admin Notes <span style="color:var(--text3);">(optional)</span></label>
                        <input type="text" name="admin_notes" class="rf-input" placeholder="Internal note...">
                    </div>
                    <button type="submit" class="rf-btn rf-btn-emerald"
                        style="width:100%;justify-content:center;padding:12px;">
                        <i class="fa-solid fa-floppy-disk"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // ── Toggle bank/upi fields based on refund method ──
        function toggleRefundFields(select) {
            const form = select.closest('form');
            const bankFields = form.querySelector('.bank-fields');
            const upiFields = form.querySelector('.upi-fields');
            bankFields.style.display = select.value === 'bank_transfer' ? 'grid' : 'none';
            upiFields.style.display = select.value === 'upi' ? 'grid' : 'none';
        }

        // ── Basic validation ──
        function validateRefundForm(form) {
            const method = form.querySelector('[name="refund_method"]').value;
            if (method === 'bank_transfer') {
                const acc = form.querySelector('[name="bank_account_number"]').value.trim();
                const ifsc = form.querySelector('[name="bank_ifsc"]').value.trim();
                if (!acc || !ifsc) { alert('Please enter Bank Account Number and IFSC Code.'); return false; }
            }
            if (method === 'upi') {
                const upi = form.querySelector('[name="upi_id"]').value.trim();
                if (!upi) { alert('Please enter UPI ID.'); return false; }
            }
            return true;
        }

        // ── Update modal ──
        function openUpdateModal(id, status, txId) {
            document.getElementById('updateForm').action = '/refunds/' + id;
            document.getElementById('modal-status').value = status;
            document.getElementById('modal-tx').value = txId === 'null' ? '' : txId;
            document.getElementById('modal-fail-wrap').style.display = 'none';
            document.getElementById('modal-status').onchange = function () {
                document.getElementById('modal-fail-wrap').style.display =
                    this.value === 'failed' ? 'flex' : 'none';
            };
            document.getElementById('updateModal').style.display = 'flex';
        }

        function closeUpdateModal() {
            document.getElementById('updateModal').style.display = 'none';
        }

        document.addEventListener('keydown', e => { if (e.key === 'Escape') closeUpdateModal(); });
    </script>

</x-app-layout>