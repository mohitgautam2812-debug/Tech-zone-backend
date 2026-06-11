<x-app-layout>
    <div class="dashboard-header">
        <h4>Welcome back, {{ auth()->user()->name }}</h4>

        <div class="bg-white px-3 py-2 rounded shadow">
            Hi {{ auth()->user()->name }}
        </div>
    </div>


    <div class="card shadow-lg border-0 rounded-4">

        <div class="p-3 text-white" style="background: linear-gradient(135deg,#4f46e5,#7c3aed);">
            <h5 class="mb-0">Stock Overview</h5>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">

                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Owner</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($products as $product)
                        <tr class="hover-row">

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <img src="{{ asset('storage/' . $product->image) }}" width="50" class="rounded shadow-sm">
                            </td>

                            <td class="fw-semibold">{{ $product->name }}</td>

                            <td>{{ $product->category->name ?? '-' }}</td>

                            <td class="text-success fw-bold">₹{{ $product->price }}</td>

                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ $product->stock }}
                                </span>
                            </td>

                            <td>
                                <span class="badge 
                                            {{ $product->status == 'approved' ? 'bg-success' : 'bg-warning' }}">
                                    {{ $product->status }}
                                </span>
                            </td>

                            <td>{{ $product->user->name ?? '-' }}</td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>

    </div>
    </div>

    <style>
        .hover-row:hover {
            background: #f1f5f9;
            transition: 0.2s;
        }
    </style>

</x-app-layout>