<x-app-layout>
    <style>
        .inq-badge {
            border-radius: 20px;
            padding: 4px 12px;
            font-size: 11px;
            font-weight: 600;
        }

        .inq-card {
            border: 1px solid #f0f0f0;
            border-radius: 12px;
            transition: all 0.2s;
        }

        .inq-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transform: translateY(-1px);
        }

        .reply-box {
            background: #f8f9ff;
            border: 1px solid #e0e7ff;
            border-radius: 10px;
        }
    </style>

    <div class="p-4" style="background:#f8f9fa; min-height:100vh;">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h4 class="fw-bold mb-1">💬 Inquiries</h4>
                <p class="text-muted mb-0 small">Manage all product inquiries from customers</p>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <span class="badge px-3 py-2"
                    style="background:#4f46e522;color:#4f46e5;border-radius:20px;font-size:13px;">
                    Total: {{ $inquiries->count() }}
                </span>
            </div>
        </div>

        {{-- Success / Error Alerts --}}
        @if(session('success'))
            <div class="alert d-flex align-items-center gap-2 mb-4"
                style="background:#e8f5e9;border:1px solid #a5d6a7;border-radius:12px;color:#2e7d32;">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            </div>
        @endif

        {{-- Status Filter Tabs --}}
        <div class="d-flex gap-2 flex-wrap mb-4">
            @foreach(['all' => 'All', 'pending' => '⏳ Pending', 'replied' => '✅ Replied', 'completed' => '🎯 Completed'] as $val => $label)
                <a href="{{ request()->fullUrlWithQuery(['status' => $val]) }}" class="btn btn-sm" style="border-radius:20px;
                        background:{{ request('status', 'all') === $val ? '#4f46e5' : '#fff' }};
                        color:{{ request('status', 'all') === $val ? '#fff' : '#555' }};
                        border:1px solid {{ request('status', 'all') === $val ? '#4f46e5' : '#ddd' }};
                        font-weight:{{ request('status', 'all') === $val ? '600' : '400' }};">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        {{-- No Inquiries --}}
        @if($inquiries->isEmpty())
            <div class="text-center py-5 bg-white rounded-4 shadow-sm">
                <i class="bi bi-chat-square-dots" style="font-size:3rem;color:#ccc;"></i>
                <h5 class="mt-3 fw-bold text-muted">No inquiries found</h5>
                <p class="text-muted small">When customers send inquiries, they'll appear here.</p>
            </div>
        @else

            {{-- Inquiries List --}}
            <div class="d-flex flex-column gap-3">
                @foreach($inquiries as $inq)
                    <div class="bg-white inq-card p-4">

                        {{-- Top Row --}}
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-3">

                            {{-- Customer Info --}}
                            <div class="d-flex align-items-center gap-3">
                                <div class="d-flex align-items-center justify-content-center rounded-circle fw-bold text-white flex-shrink-0"
                                    style="width:46px;height:46px;background:#4f46e5;font-size:18px;">
                                    {{ strtoupper(substr($inq->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $inq->name }}</div>
                                    <div class="text-muted small">
                                        <i class="bi bi-envelope me-1"></i>{{ $inq->email ?? 'N/A' }}
                                        @if($inq->phone ?? false)
                                            &nbsp;|&nbsp;<i class="bi bi-telephone me-1"></i>{{ $inq->phone }}
                                        @endif
                                    </div>
                                    <div class="text-muted" style="font-size:11px;">
                                        <i class="bi bi-clock me-1"></i>{{ $inq->created_at->diffForHumans() }}
                                        @if($inq->city ?? false)
                                            &nbsp;|&nbsp;<i class="bi bi-geo-alt me-1"></i>{{ $inq->city }}
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Right: Status + Actions --}}
                            <div class="d-flex align-items-center gap-2 flex-wrap">

                                {{-- Status Badge --}}
                                @php
                                    $status = $inq->status ?? 'pending';
                                    $statusConfig = [
                                        'pending' => ['bg' => '#fff3e0', 'color' => '#e65100', 'icon' => 'bi-clock'],
                                        'replied' => ['bg' => '#e8f5e9', 'color' => '#2e7d32', 'icon' => 'bi-check-circle'],
                                        'completed' => ['bg' => '#e8f0fe', 'color' => '#1565c0', 'icon' => 'bi-patch-check'],
                                    ];
                                    $sc = $statusConfig[$status] ?? $statusConfig['pending'];
                                @endphp
                                <span class="inq-badge" style="background:{{ $sc['bg'] }};color:{{ $sc['color'] }};">
                                    <i class="bi {{ $sc['icon'] }} me-1"></i>{{ ucfirst($status) }}
                                </span>

                                {{-- Status Change Dropdown --}}
                                <div class="dropdown">
                                    <button class="btn btn-sm dropdown-toggle"
                                        style="background:#f5f5f5;border:none;border-radius:8px;" data-bs-toggle="dropdown">
                                        Change Status
                                    </button>
                                    <ul class="dropdown-menu shadow border-0" style="border-radius:12px;min-width:160px;">
                                        @foreach(['pending' => '⏳ Pending', 'replied' => '✅ Replied', 'completed' => '🎯 Completed'] as $val => $label)
                                            <li>
                                                <form action="{{ route('inquiries.status', $inq->id) }}" method="POST">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="status" value="{{ $val }}">
                                                    <button type="submit" class="dropdown-item py-2"
                                                        style="{{ $status === $val ? 'background:#f0f0f0;font-weight:600;' : '' }}">
                                                        {{ $label }}
                                                    </button>
                                                </form>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                {{-- Delete --}}
                                <form action="{{ route('inquiries.destroy', $inq->id) }}" method="POST"
                                    onsubmit="return confirm('Delete this inquiry?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm"
                                        style="background:#fdecea;color:#c62828;border:none;border-radius:8px;">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        {{-- Product Info --}}
                        @if($inq->product)
                            <div class="d-flex align-items-center gap-3 mb-3 p-2 rounded-3"
                                style="background:#f9f9f9;border:1px dashed #ddd;">
                                @if($inq->product->image)
                                    <img src="{{ asset('storage/' . $inq->product->image) }}" alt="{{ $inq->product->name }}"
                                        class="rounded-2" style="width:50px;height:44px;object-fit:cover;">
                                @endif
                                <div>
                                    <div class="fw-semibold small">{{ $inq->product->name }}</div>
                                    <div class="text-muted" style="font-size:11px;">
                                        ₹{{ number_format($inq->product->price) }}
                                        &nbsp;|&nbsp; Product ID: #{{ $inq->product->id }}
                                    </div>
                                </div>
                                <a href="{{ route('products.show', $inq->product->id) }}" class="btn btn-sm ms-auto"
                                    style="background:#4f46e522;color:#4f46e5;border:none;border-radius:8px;font-size:11px;">
                                    View Product
                                </a>
                            </div>
                        @endif

                        {{-- Message --}}
                        <div class="mb-3 p-3 rounded-3" style="background:#f8f9fa;border-left:4px solid #4f46e5;">
                            <div class="text-muted small fw-semibold mb-1">
                                <i class="bi bi-chat-left-text me-1"></i>Customer Message:
                            </div>
                            <p class="mb-0" style="font-size:14px;line-height:1.7;">{{ $inq->message }}</p>
                        </div>

                        {{-- Existing Reply --}}
                        @if($inq->reply ?? false)
                            <div class="mb-3 p-3 rounded-3 reply-box">
                                <div class="fw-semibold small mb-1" style="color:#4f46e5;">
                                    <i class="bi bi-reply me-1"></i>Your Reply:
                                </div>
                                <p class="mb-0 small" style="line-height:1.7;">{{ $inq->reply }}</p>
                            </div>
                        @endif

                        {{-- Reply Form (toggle) --}}
                        <div x-data="{ open: false }">
                            <button @click="open = !open" class="btn btn-sm"
                                style="background:#4f46e522;color:#4f46e5;border:none;border-radius:8px;">
                                <i class="bi bi-reply me-1"></i>
                                {{ ($inq->reply ?? false) ? 'Edit Reply' : 'Reply' }}
                            </button>

                            <div x-show="open" x-transition class="mt-3">
                                <form action="{{ route('inquiries.reply', $inq->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-2">
                                        <textarea name="reply" class="form-control" rows="3"
                                            placeholder="Type your reply to {{ $inq->name }}..."
                                            style="border-radius:10px;border-color:#e0e7ff;"
                                            required>{{ $inq->reply ?? '' }}</textarea>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-sm fw-bold px-4"
                                            style="background:#4f46e5;color:#fff;border-radius:8px;">
                                            <i class="bi bi-send me-1"></i>Send Reply
                                        </button>
                                        <button type="button" @click="open = false" class="btn btn-sm"
                                            style="background:#f5f5f5;border:none;border-radius:8px;">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>