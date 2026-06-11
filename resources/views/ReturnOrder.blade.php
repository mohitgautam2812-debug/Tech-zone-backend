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
            --sans: 'Outfit', sans-serif;
            --mono: 'JetBrains Mono', monospace;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .ow {
            font-family: var(--sans);
            background: var(--muted);
            min-height: 100vh;
            padding: 28px 24px;
            color: var(--text1);
        }

        .ow-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 28px;
        }

        .ow-title {
            font-size: 26px;
            font-weight: 800;
            color: var(--text1);
            letter-spacing: -0.03em;
            line-height: 1;
        }

        .ow-sub {
            font-size: 13px;
            color: var(--text2);
            margin-top: 5px;
        }

        .ow-user-pill {
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
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
        }

        .ow-user-av {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--teal);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* stats */
        .ow-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 14px;
            margin-bottom: 24px;
        }

        .ow-stat {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 18px 18px 14px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
            position: relative;
            overflow: hidden;
        }

        .ow-stat::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            border-radius: 16px 16px 0 0;
        }

        .ow-stat.violet::before {
            background: var(--violet);
        }

        .ow-stat.amber::before {
            background: var(--amber);
        }

        .ow-stat.orange::before {
            background: var(--orange);
        }

        .ow-stat.emerald::before {
            background: var(--emerald);
        }

        .ow-stat.rose::before {
            background: var(--rose);
        }

        .ow-stat.teal::before {
            background: var(--teal);
        }

        .ow-stat-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            margin-bottom: 12px;
        }

        .ow-stat-num {
            font-family: var(--mono);
            font-size: 24px;
            font-weight: 600;
            color: var(--text1);
            line-height: 1;
        }

        .ow-stat-lbl {
            font-size: 11px;
            color: var(--text3);
            margin-top: 4px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        
        .ow-alert {
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

        /* card */
        .ow-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
        }

        .ow-card-head {
            padding: 18px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .ow-card-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: var(--teal-l);
            color: var(--teal);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
        }

        .ow-card-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--text1);
        }

        .ow-card-sub {
            font-size: 12px;
            color: var(--text2);
            margin-top: 2px;
        }

        /* table */
        .ow-table-wrap {
            overflow-x: auto;
        }

        .ow-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .ow-table thead th {
            background: #fafafa;
            padding: 12px 18px;
            text-align: left;
            font-family: var(--mono);
            font-size: 10px;
            letter-spacing: 0.1em;
            color: var(--text3);
            text-transform: uppercase;
            border-bottom: 1px solid var(--border);
            font-weight: 400;
            white-space: nowrap;
        }

        .ow-table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.15s;
        }

        .ow-table tbody tr:last-child {
            border-bottom: none;
        }

        .ow-table tbody tr:hover {
            background: #f9fbff;
        }

        .ow-table td {
            padding: 16px 18px;
            vertical-align: middle;
        }

        .ow-num {
            font-family: var(--mono);
            font-size: 11px;
            color: var(--teal);
            background: var(--teal-l);
            padding: 4px 10px;
            border-radius: 6px;
            display: inline-block;
        }

        .ow-product {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 180px;
        }

        .ow-prod-img {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            object-fit: cover;
            border: 1px solid var(--border);
            flex-shrink: 0;
        }

        .ow-prod-ph {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            background: var(--muted);
            border: 1px dashed var(--border2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text3);
            font-size: 16px;
            flex-shrink: 0;
        }

        .ow-prod-name {
            font-weight: 600;
            font-size: 13px;
            color: var(--text1);
        }

        .ow-prod-date {
            font-size: 11px;
            color: var(--text3);
            margin-top: 2px;
            font-family: var(--mono);
        }

        .ow-av {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--teal-l);
            color: var(--teal);
            font-size: 11px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .ow-reason-tag {
            display: inline-block;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            background: var(--amber-l);
            color: var(--amber);
            border: 1px solid #fde68a;
            padding: 3px 10px;
            border-radius: 6px;
            margin-bottom: 5px;
        }

        .ow-reason-desc {
            font-size: 11px;
            color: var(--text2);
            line-height: 1.5;
            max-width: 180px;
        }

        .ow-proof-img {
            width: 52px;
            height: 52px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid var(--border2);
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .ow-proof-img:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .ow-no-proof {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            color: var(--text3);
            font-style: italic;
        }

        /* status badges */
        .ow-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 13px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.03em;
            white-space: nowrap;
        }

        .ow-badge::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .b-pending {
            background: var(--amber-l);
            color: var(--amber);
            border: 1px solid #fde68a;
        }

        .b-pending::before {
            background: var(--amber);
            box-shadow: 0 0 5px var(--amber);
        }

        .b-request_approved {
            background: var(--orange-l);
            color: var(--orange);
            border: 1px solid #fed7aa;
        }

        .b-request_approved::before {
            background: var(--orange);
            box-shadow: 0 0 5px var(--orange);
        }

        .b-approved {
            background: var(--emerald-l);
            color: var(--emerald);
            border: 1px solid #6ee7b7;
        }

        .b-approved::before {
            background: var(--emerald);
            box-shadow: 0 0 5px var(--emerald);
        }

        .b-rejected {
            background: var(--rose-l);
            color: var(--rose);
            border: 1px solid #fca5a5;
        }

        .b-rejected::before {
            background: var(--rose);
            box-shadow: 0 0 5px var(--rose);
        }

        .b-refunded {
            background: var(--teal-l);
            color: var(--teal);
            border: 1px solid #99f6e4;
        }

        .b-refunded::before {
            background: var(--teal);
            box-shadow: 0 0 5px var(--teal);
        }

        /* select */
        .ow-select {
            font-family: var(--sans);
            font-size: 12px;
            font-weight: 600;
            padding: 8px 32px 8px 12px;
            border-radius: 10px;
            border: 1px solid var(--border2);
            background: var(--surface);
            color: var(--text1);
            min-width: 170px;
            cursor: pointer;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%236b7280' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
        }

        .ow-select:hover,
        .ow-select:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.1);
        }

        /* empty */
        .ow-empty {
            padding: 80px 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 14px;
        }

        .ow-empty-icon {
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

        /* lightbox */
        .ow-lightbox {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.85);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            padding: 24px;
            backdrop-filter: blur(6px);
        }

        .ow-lightbox.open {
            display: flex;
        }

        .ow-lightbox img {
            max-width: 90vw;
            max-height: 85vh;
            border-radius: 16px;
            box-shadow: 0 32px 80px rgba(0, 0, 0, 0.6);
        }

        .ow-lightbox-close {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.12);
            border: none;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }

        .ow-lightbox-close:hover {
            background: rgba(255, 255, 255, 0.22);
        }

        .ow-table-wrap::-webkit-scrollbar {
            height: 4px;
        }

        .ow-table-wrap::-webkit-scrollbar-track {
            background: transparent;
        }

        .ow-table-wrap::-webkit-scrollbar-thumb {
            background: var(--border2);
            border-radius: 4px;
        }

        @media(max-width:640px) {
            .ow {
                padding: 16px 12px;
            }

            .ow-title {
                font-size: 20px;
            }

            .ow-stats {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>

    <div class="ow">

       
        <div class="ow-header">
            <div>
                <h1 class="ow-title">Return Requests</h1>
                <p class="ow-sub">Review, approve, or reject customer return and refund requests</p>
            </div>
            <div class="ow-user-pill">
                <div class="ow-user-av">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                {{ auth()->user()->name }}
            </div>
        </div>

        {{-- ALERT --}}
        @if(session('success'))
            <div class="ow-alert"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
        @endif

        {{-- STATS --}}
        @php
            $total = $returns->count();
            $pending = $returns->where('status', 'pending')->count();
            $reqApproved = $returns->where('status', 'request_approved')->count();
            $approved = $returns->where('status', 'approved')->count();
            $rejected = $returns->where('status', 'rejected')->count();
            $refunded = $returns->where('status', 'refunded')->count();
        @endphp
        <div class="ow-stats">
            <div class="ow-stat violet">
                <div class="ow-stat-icon" style="background:var(--violet-l);color:var(--violet);"><i
                        class="fa-solid fa-rotate-left"></i></div>
                <div class="ow-stat-num">{{ $total }}</div>
                <div class="ow-stat-lbl">Total</div>
            </div>
            <div class="ow-stat amber">
                <div class="ow-stat-icon" style="background:var(--amber-l);color:var(--amber);"><i
                        class="fa-solid fa-clock"></i></div>
                <div class="ow-stat-num">{{ $pending }}</div>
                <div class="ow-stat-lbl">Pending</div>
            </div>
            <div class="ow-stat orange">
                <div class="ow-stat-icon" style="background:var(--orange-l);color:var(--orange);"><i
                        class="fa-solid fa-bell"></i></div>
                <div class="ow-stat-num">{{ $reqApproved }}</div>
                <div class="ow-stat-lbl">Req. Approved</div>
            </div>
            <div class="ow-stat emerald">
                <div class="ow-stat-icon" style="background:var(--emerald-l);color:var(--emerald);"><i
                        class="fa-solid fa-check-double"></i></div>
                <div class="ow-stat-num">{{ $approved }}</div>
                <div class="ow-stat-lbl">Approved</div>
            </div>
            <div class="ow-stat rose">
                <div class="ow-stat-icon" style="background:var(--rose-l);color:var(--rose);"><i
                        class="fa-solid fa-xmark"></i></div>
                <div class="ow-stat-num">{{ $rejected }}</div>
                <div class="ow-stat-lbl">Rejected</div>
            </div>
            <div class="ow-stat teal">
                <div class="ow-stat-icon" style="background:var(--teal-l);color:var(--teal);"><i
                        class="fa-solid fa-money-bill-wave"></i></div>
                <div class="ow-stat-num">{{ $refunded }}</div>
                <div class="ow-stat-lbl">Refunded</div>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="ow-card">
            <div class="ow-card-head">
                <div class="ow-card-icon"><i class="fa-solid fa-rotate-left"></i></div>
                <div>
                    <div class="ow-card-title">Return Requests</div>
                    <div class="ow-card-sub">{{ $total }} total requests</div>
                </div>
            </div>

            @if($returns->isEmpty())
                <div class="ow-empty">
                    <div class="ow-empty-icon"><i class="fa-solid fa-box-open"></i></div>
                    <div style="font-size:16px;font-weight:700;color:var(--text1)">No return requests yet</div>
                    <div style="font-size:13px;color:var(--text2)">When customers submit return requests, they'll appear
                        here.</div>
                </div>
            @else
                <div class="ow-table-wrap">
                    <table class="ow-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Customer</th>
                                <th>Reason</th>
                                <th>Proof</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($returns as $return)
                                <tr>
                                    <td><span class="ow-num">#{{ $return->id }}</span></td>

                                    <td>
                                        @if($return->order && optional($return->order)->product != null)
                                            <div class="ow-product">
                                                @if(optional($return->order->product)->image)
                                                    <img src="{{ asset('storage/' . optional($return->order->product)->image) }}"
                                                        class="ow-prod-img" alt="">
                                                @else
                                                    <div class="ow-prod-ph"><i class="fa-solid fa-image"></i></div>
                                                @endif
                                                <div>
                                                    <div class="ow-prod-name">
                                                        {{ optional($return->order->product)->name ?? 'Product Removed' }}</div>
                                                    <div class="ow-prod-date">{{ $return->created_at->format('d M Y') }}</div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="ow-product">
                                                <div class="ow-prod-ph"><i class="fa-solid fa-image-slash"></i></div>
                                                <div>
                                                    <div class="ow-prod-name" style="color:var(--text3)">Not found</div>
                                                    <div class="ow-prod-date">{{ $return->created_at->format('d M Y') }}</div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>

                                    <td>
                                        @if($return->user)
                                            <div style="display:flex;align-items:center;gap:10px;">
                                                <div class="ow-av">{{ strtoupper(substr($return->user->name, 0, 2)) }}</div>
                                                <div>
                                                    <div style="font-size:13px;font-weight:600;">{{ $return->user->name }}</div>
                                                    <div style="font-size:11px;color:var(--text3);">{{ $return->user->email }}</div>
                                                </div>
                                            </div>
                                        @else
                                            <span style="color:var(--text3);font-size:12px;">Unknown</span>
                                        @endif
                                    </td>

                                    <td>
                                        <span class="ow-reason-tag">{{ $return->reason }}</span>
                                        @if($return->description)
                                            <div class="ow-reason-desc">{{ Str::limit($return->description, 70) }}</div>
                                        @endif
                                    </td>

                                    <td>
                                        @if($return->image)
                                            <img src="{{ asset('storage/' . $return->image) }}" class="ow-proof-img"
                                                onclick="openLightbox(this.src)">
                                        @else
                                            <div class="ow-no-proof"><i class="fa-regular fa-image"></i> No image</div>
                                        @endif
                                    </td>

                                    <td>
                                        @php
                                            $sicons = [
                                                'pending' => 'fa-clock',
                                                'request_approved' => 'fa-bell',
                                                'approved' => 'fa-check-double',
                                                'rejected' => 'fa-xmark',
                                                'refunded' => 'fa-money-bill-wave',
                                            ];
                                        @endphp
                                        <span class="ow-badge b-{{ $return->status }}">
                                            <i class="fa-solid {{ $sicons[$return->status] ?? 'fa-circle' }}"></i>
                                            {{ ucfirst(str_replace('_', ' ', $return->status)) }}
                                        </span>
                                    </td>

                                    <td>
                                        <form method="POST" action="{{ route('returns.update', $return->id) }}">
                                            @csrf @method('PUT')
                                            <select name="status" class="ow-select" onchange="this.form.submit()">
                                                <option value="pending" {{ $return->status == 'pending' ? 'selected' : '' }}>⏳
                                                    Pending</option>
                                                <option value="request_approved" {{ $return->status == 'request_approved' ? 'selected' : '' }}>🔔 Request Approved</option>
                                                <option value="approved" {{ $return->status == 'approved' ? 'selected' : '' }}>✅
                                                    Approved</option>
                                                <option value="rejected" {{ $return->status == 'rejected' ? 'selected' : '' }}>❌
                                                    Rejected</option>
                                                <option value="refunded" {{ $return->status == 'refunded' ? 'selected' : '' }}>💰
                                                    Refunded</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <div class="ow-lightbox" id="lightbox" onclick="closeLightbox()">
        <button class="ow-lightbox-close" onclick="closeLightbox()">✕</button>
        <img id="lightbox-img" src="" alt="Proof">
    </div>

    <script>
        function openLightbox(src) { document.getElementById('lightbox-img').src = src; document.getElementById('lightbox').classList.add('open'); }
        function closeLightbox() { document.getElementById('lightbox').classList.remove('open'); }
        document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });
    </script>

</x-app-layout>