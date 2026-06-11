<x-app-layout>
    <div class="dashboard-header">
        <h4>Welcome back, {{ auth()->user()->name }}</h4>

        <div class="bg-white px-3 py-2 rounded shadow">
            Hi {{ auth()->user()->name }}
        </div>
    </div>

    <div class="card shadow rounded-4 border-0">
        <div class="p-3 text-white" style="background: linear-gradient(135deg,#4f46e5,#7c3aed);">
            <h5 class="mb-0">⭐ Reviews</h5>
        </div>

        <div class="card-body p-2"></div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>User</th>
                    <th>Rating</th>
                    <th>Review</th>
                </tr>
            </thead>

            <tbody>
                @foreach($reviews as $rev)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $rev->product->name }}</td>
                        <td>{{ $rev->user->name }}</td>
                        <td>⭐ {{ $rev->rating }}</td>
                        <td>{{ $rev->review }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>
    </div>

    </div>
    </div>
</x-app-layout>