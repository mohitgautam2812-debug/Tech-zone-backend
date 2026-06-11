<x-app-layout>
    <div class="dashboard-header">
        <h4>Welcome back, {{ auth()->user()->name }}</h4>

        <div class="bg-white px-3 py-2 rounded shadow">
            Hi {{ auth()->user()->name }}
        </div>
    </div>


    <div class="flex-grow-1 p-4">

        <h3 class="fw-bold mb-4 text-danger">⚠ Unapproved Products</h3>

        <div class="card shadow-lg border-0 rounded-4">

            <div class="p-3 text-white" style="background: linear-gradient(135deg,#dc2626,#ef4444);">
                <h5 class="mb-0">Pending Approval</h5>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Owner</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($products as $product)
                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    <img src="{{ asset('storage/' . $product->image) }}" width="50" class="rounded">
                                </td>

                                <td>{{ $product->name }}</td>

                                <td>{{ $product->category->name ?? '-' }}</td>

                                <td>₹{{ $product->price }}</td>

                                <td>{{ $product->user->name }}</td>

                                <td>

                                    {{-- ADMIN APPROVE --}}
                                    @if(auth()->user()->hasRole('admin'))
                                        <form action="{{ route('products.update', $product->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="approved">
                                            <button class="btn btn-success btn-sm">Approve</button>
                                        </form>
                                    @endif

                                    {{-- DELETE --}}
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>

                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">No unapproved products</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>

    </div>
    
</x-app-layout>