    <x-app-layout>

        <style>
            .section-label {
                font-size: 10.5px;
                font-weight: 700;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                color: #6c757d;
            }

            .card-header-icon {
                width: 36px;
                height: 36px;
                border-radius: 9px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 16px;
                flex-shrink: 0;
            }

            .order-table th {
                font-size: 10.5px;
                font-weight: 700;
                letter-spacing: 0.07em;
                text-transform: uppercase;
                color: #6c757d;
                border-bottom: 1px solid #f1f3f5;
                padding: 11px 16px;
                white-space: nowrap;
            }

            .order-table td {
                padding: 13px 16px;
                border-bottom: 1px solid #f8f9fa;
                vertical-align: middle;
                font-size: 13px;
            }

            .order-table tr:last-child td {
                border-bottom: none;
            }

            .order-table tbody tr:hover td {
                background: #f8f9fa;
            }

            .product-img {
                width: 42px;
                height: 42px;
                object-fit: cover;
                border-radius: 8px;
                border: 1px solid #e9ecef;
                flex-shrink: 0;
            }

            .product-img-placeholder {
                width: 42px;
                height: 42px;
                border-radius: 8px;
                background: #f1f3f5;
                border: 1px solid #e9ecef;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #adb5bd;
                font-size: 16px;
                flex-shrink: 0;
            }

            .status-badge {
                padding: 4px 12px;
                border-radius: 20px;
                font-size: 11px;
                font-weight: 600;
                letter-spacing: 0.03em;
            }

            .status-pending {
                background: #fef9c3;
                color: #854d0e;
                border: 1px solid #fde68a;
                display: flex;
                justify-self: center;
                align-items: center;
            }

            .status-delivered {
                background: #dcfce7;
                color: #14532d;
                border: 1px solid #86efac;
                display: flex;
                justify-self: center;
                align-items: center;
            }

            .status-cancelled {
                background: #fee2e2;
                color: #7f1d1d;
                border: 1px solid #fca5a5;
                display: flex;
                justify-self: center;
                align-items: center;
            }

            .status-select {
                font-size: 12px;
                padding: 4px 8px;
                border-radius: 6px;
                border: 1px solid #dee2e6;
                background: #fff;
                color: #374151;
                cursor: pointer;
                min-width: 120px;
            }

            .status-select:focus {
                outline: none;
                border-color: #7c3aed;
                box-shadow: 0 0 0 3px #7c3aed18;
            }

            .user-avatar {
                width: 30px;
                height: 30px;
                border-radius: 50%;
                background: #ede9fe;
                color: #6d28d9;
                font-size: 11px;
                font-weight: 700;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
            }

            .order-num {
                font-family: 'Courier New', monospace;
                font-size: 12px;
                color: #9ca3af;
            }

            .empty-state {
                padding: 60px 20px;
                text-align: center;
                color: #9ca3af;
            }

            .empty-state i {
                font-size: 40px;
                margin-bottom: 12px;
                opacity: 0.4;
            }

            .empty-state p {
                font-size: 14px;
                margin: 0;
            }
        </style>

        <div class="container-fluid py-4 px-4">

            {{-- PAGE HEADER --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h5 class="fw-bold mb-1 text-dark">
                        @if(auth()->user()->hasRole('admin'))
                            All Orders
                        @elseif(auth()->user()->hasRole('agent'))
                            Orders on My Products
                        @else
                            My Orders
                        @endif
                    </h5>
                    <p class="text-muted mb-0 small">
                        @if(auth()->user()->hasRole('admin'))
                            Manage and update all customer orders
                        @elseif(auth()->user()->hasRole('agent'))
                            Orders placed on products you listed
                        @else
                            Track orders you have placed
                        @endif
                    </p>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge rounded-pill px-3 py-2"
                        style="background:#ede9fe; color:#6d28d9; font-size:12px; font-weight:600;">
                        {{ $orders->count() }} Orders
                    </span>
                    <div class="bg-white border rounded-pill px-3 py-2 small text-muted shadow-sm">
                        <i class="fa-solid fa-user me-1"></i>{{ auth()->user()->name }}
                    </div>
                </div>
            </div>

            {{-- ALERTS --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 py-2 mb-4"
                    role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- STATS ROW --}}
            <div class="row g-3 mb-4">
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm rounded-4 p-3 h-100">
                        <div class="d-flex align-items-center gap-3">
                            <div class="card-header-icon" style="background:#fef9c3; color:#854d0e;">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <div>
                                <div class="section-label">Pending</div>
                                <div class="fw-bold fs-5">{{ $orders->where('status', 'pending')->count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm rounded-4 p-3 h-100">
                        <div class="d-flex align-items-center gap-3">
                            <div class="card-header-icon" style="background:#dcfce7; color:#14532d;">
                                <i class="fa-solid fa-truck"></i>
                            </div>
                            <div>
                                <div class="section-label">Delivered</div>
                                <div class="fw-bold fs-5">{{ $orders->where('status', 'delivered')->count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm rounded-4 p-3 h-100">
                        <div class="d-flex align-items-center gap-3">
                            <div class="card-header-icon" style="background:#fee2e2; color:#7f1d1d;">
                                <i class="fa-solid fa-xmark"></i>
                            </div>
                            <div>
                                <div class="section-label">Cancelled</div>
                                <div class="fw-bold fs-5">{{ $orders->where('status', 'cancelled')->count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm rounded-4 p-3 h-100">
                        <div class="d-flex align-items-center gap-3">
                            <div class="card-header-icon" style="background:#ede9fe; color:#6d28d9;">
                                <i class="fa-solid fa-indian-rupee-sign"></i>
                            </div>
                            <div>
                                <div class="section-label">Total Revenue</div>
                                <div class="fw-bold fs-5">₹{{ number_format($orders->sum('total_price'), 0) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ORDERS TABLE --}}
            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-header bg-white border-bottom d-flex align-items-center gap-3 py-3 rounded-top-4">
                    <div class="card-header-icon" style="background:#ede9fe; color:#7c3aed;">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div>
                        <div class="fw-semibold text-dark" style="font-size:14px;">Order List</div>
                        <div class="text-muted" style="font-size:12px;">
                            @if(auth()->user()->hasRole('admin')) All customer orders
                            @elseif(auth()->user()->hasRole('agent')) Orders from your listed products
                            @else Your placed orders
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    @if($orders->isEmpty())
                        <div class="empty-state">
                            <i class="fa-solid fa-box-open d-block"></i>
                            <p class="mt-2 text-muted">No orders found.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table order-table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product</th>
                                        @if(!auth()->user()->hasRole('user'))
                                            <th>Customer</th>
                                        @endif
                                        @if(auth()->user()->hasRole('admin'))
                                            <th>Agent</th>
                                        @endif
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Invoice</th>
                                        @if(auth()->user()->hasRole('admin'))
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>

                                            {{-- # --}}
                                            <td class="ps-4">
                                                <span class="order-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                            </td>

                                            {{-- Product --}}
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    @if($order->product->image ?? false)
                                                        <img src="{{ asset('storage/' . $order->product->image) }}"
                                                            alt="{{ $order->product->name }}" class="product-img">
                                                    @else
                                                        <div class="product-img-placeholder">
                                                            <i class="fa-solid fa-image"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <div class="fw-medium text-dark" style="font-size:13px;">
                                                            {{ $order->product->name }}
                                                        </div>
                                                        <div class="text-muted" style="font-size:11px;">
                                                            {{ $order->created_at->format('d M, Y') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            {{-- Customer (not shown to regular user) --}}
                                            @if(!auth()->user()->hasRole('user'))
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="user-avatar">
                                                            {{ strtoupper(substr($order->user->name, 0, 2)) }}
                                                        </div>
                                                        <div>
                                                            <div style="font-size:13px; font-weight:500;">{{ $order->user->name }}</div>
                                                            <div class="text-muted" style="font-size:11px;">{{ $order->user->email }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            @endif

                                            {{-- Agent (admin only) --}}
                                            @if(auth()->user()->hasRole('admin'))
                                                <td>
                                                    <span style="font-size:13px; color:#6c757d;">
                                                        {{ $order->product->user->name ?? '—' }}
                                                    </span>
                                                </td>
                                            @endif

                                            {{-- Price --}}
                                            <td>
                                                <span class="fw-semibold text-dark" style="font-size:13px;">
                                                    ₹{{ number_format($order->total_price, 0) }}
                                                </span>
                                            </td>

                                            {{-- Status Badge --}}
                                            <td>
                                                <span class="status-badge
                                                                        @if($order->status == 'pending') status-pending
                                                                        @elseif($order->status == 'delivered') status-delivered
                                                                        @else status-cancelled
                                                                        @endif
                                                                    ">
                                                    @if($order->status == 'pending') <i class="fa-solid fa-clock me-1"></i>
                                                    @elseif($order->status == 'delivered') <i class="fa-solid fa-check me-1"></i>
                                                    @else <i class="fa-solid fa-xmark me-1"></i>
                                                    @endif
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>


                                            <td>

                                                <a href="{{ route('invoice', $order->id) }}" target="_blank"
                                                    class="btn btn-sm fw-semibold" style="
                                                                                    background:#111827;
                                                                                    color:#fff;
                                                                                    border-radius:8px;
                                                                                    padding:6px 14px;
                                                                                    font-size:11px;
                                                                                    text-decoration:none;
                                                                                ">

                                                    <i class="fa-solid fa-file-invoice me-1"></i>

                                                    Invoice

                                                </a>

                                            </td>

                                            @if(
                                                    auth()->user()->hasRole('user') &&
                                                    in_array($order->status, [
                                                        'pending',
                                                        'confirmed',
                                                        'packed'
                                                    ])
                                                )

                                                <form action="{{ route('orders.cancel', $order->id) }}" method="POST" class="mt-2">

                                                    @csrf

                                                    @method('PUT')

                                                    <button class="btn btn-sm btn-danger fw-semibold" style="
                                                                                border-radius:8px;
                                                                                padding:6px 14px;
                                                                                font-size:11px;
                                                                            ">

                                                        <i class="fa-solid fa-xmark me-1"></i>

                                                        Cancel Order

                                                    </button>
                                                    @if(
                                                            auth()->user()->hasRole('user') &&
                                                            $order->status == 'delivered'
                                                        )

                                                        <button class="btn btn-sm fw-semibold mt-2" data-bs-toggle="modal"
                                                            data-bs-target="#returnModal{{ $order->id }}" style="
                                                                                    background:#dcfce7;
                                                                                    color:#166534;
                                                                                    border-radius:8px;
                                                                                    padding:6px 14px;
                                                                                    font-size:11px;
                                                                                    border:none;
                                                                                ">

                                                            <i class="fa-solid fa-rotate-left me-1"></i>

                                                            Return / Refund

                                                        </button>

                                                    @endif

                                                </form>

                                            @endif



                                            {{-- Action (admin only) --}}
                                            @if(auth()->user()->hasRole('admin'))
                                                <td class="pe-4">
                                                    <form method="POST" action="{{ route('orders.update', $order->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <select name="status" class="status-select" onchange="this.form.submit()">

                                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                                                Pending
                                                            </option>

                                                            <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>
                                                                Confirmed
                                                            </option>

                                                            <option value="packed" {{ $order->status == 'packed' ? 'selected' : '' }}>
                                                                Packed
                                                            </option>

                                                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>
                                                                Shipped
                                                            </option>

                                                            <option value="out_for_delivery" {{ $order->status == 'out_for_delivery' ? 'selected' : '' }}>
                                                                Out For Delivery
                                                            </option>

                                                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>
                                                                Delivered
                                                            </option>

                                                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                                                                Cancelled
                                                            </option>

                                                            <option value="returned" {{ $order->status == 'returned' ? 'selected' : '' }}>
                                                                Returned
                                                            </option>

                                                            <option value="refunded" {{ $order->status == 'refunded' ? 'selected' : '' }}>
                                                                Refunded</option>

                                                        </select>
                                                    </form>
                                                </td>
                                            @endif

                                        </tr>

                                        @if(
                                                auth()->user()->hasRole('user') &&
                                                $order->status == 'delivered'
                                            )

                                            <div class="modal fade" id="returnModal{{ $order->id }}" tabindex="-1">

                                                <div class="modal-dialog modal-dialog-centered">

                                                    <div class="modal-content border-0 rounded-4">

                                                        <form action="/return-request" method="POST" enctype="multipart/form-data">

                                                            @csrf

                                                            <input type="hidden" name="order_id" value="{{ $order->id }}">

                                                            <div class="modal-header border-0">

                                                                <h5 class="fw-bold">

                                                                    Return Product

                                                                </h5>

                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"></button>

                                                            </div>

                                                            <div class="modal-body">

                                                                <label class="fw-semibold mb-2">

                                                                    Reason

                                                                </label>

                                                                <select name="reason" class="form-control mb-3">

                                                                    <option>
                                                                        Damaged Product
                                                                    </option>

                                                                    <option>
                                                                        Wrong Product
                                                                    </option>

                                                                    <option>
                                                                        Product Not Working
                                                                    </option>

                                                                </select>

                                                                <textarea name="description" class="form-control mb-3" rows="4"
                                                                    placeholder="Describe issue..."></textarea>

                                                                <input type="file" name="image" class="form-control">

                                                            </div>

                                                            <div class="modal-footer border-0">

                                                                <button class="btn btn-success">

                                                                                Submit Request

                                                                            </button>

                                                                        </div>

                                                                    </form>

                                                                </div>

                                                            </div>

                                                        </div>

                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                    @endif
                </div>

            </div>

        </div>

    </x-app-layout>