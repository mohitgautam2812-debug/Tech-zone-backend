<x-app-layout>

<style>
    .perm-chip {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 9px 14px;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        font-size: 12.5px;
        background: #fff;
        cursor: pointer;
        transition: all 0.15s;
        user-select: none;
        color: #374151;
    }
    .perm-chip:hover { border-color: #6f42c1; background: #f5f3ff; color: #5b21b6; }
    .perm-chip input[type=checkbox] { accent-color: #6f42c1; width: 15px; height: 15px; cursor: pointer; flex-shrink: 0; }
    .perm-chip:has(input:checked) { border-color: #6f42c1; background: #ede9fe; color: #5b21b6; }

    .role-badge { padding: 4px 14px; border-radius: 20px; font-size: 12px; font-weight: 600; letter-spacing: 0.03em; }
    .badge-admin  { background: #1e1b4b; color: #a78bfa; }
    .badge-agent  { background: #064e3b; color: #6ee7b7; }
    .badge-user   { background: #1e3a5f; color: #93c5fd; }
    .badge-custom { background: #f1f3f5; color: #495057; border: 1px solid #dee2e6; }

    .perm-tag { display: inline-block; padding: 2px 8px; border-radius: 4px; font-size: 10.5px; font-family: 'Courier New', monospace; background: #f8f9fa; color: #6c757d; border: 1px solid #e9ecef; margin: 2px; }

    .card-header-icon { width: 34px; height: 34px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; }

    .tbl-row-hover:hover td { background: #f8f9fa; }

    .section-label { font-size: 10.5px; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; color: #6c757d; margin-bottom: 6px; display: block; }

    .perm-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; }
</style>

<div class="container-fluid py-4 px-4">

    {{-- PAGE HEADER --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h5 class="fw-bold mb-1 text-dark">Role Management</h5>
            <p class="text-muted mb-0 small">Create roles and assign permissions</p>
        </div>
        <div class="bg-white border rounded-pill px-3 py-2 small text-muted shadow-sm">
            <i class="fa-solid fa-user me-1"></i>{{ auth()->user()->name }}
        </div>
    </div>

    {{-- ALERTS --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 py-2 mb-4" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 py-2 mb-4" role="alert">
            @foreach($errors->all() as $error)
                <div><i class="fa-solid fa-circle-exclamation me-2"></i>{{ $error }}</div>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- CREATE ROLE CARD --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-white border-bottom d-flex align-items-center gap-3 py-3 rounded-top-4">
            <div class="card-header-icon" style="background:#ede9fe; color:#7c3aed;">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <div>
                <div class="fw-semibold text-dark" style="font-size:14px;">Create New Role</div>
                <div class="text-muted" style="font-size:12px;">Define a role and select its permissions</div>
            </div>
        </div>

        <div class="card-body p-4">
            <form method="POST" action="{{ route('roles.store') }}">
                @csrf

                {{-- Role Name --}}
                <div class="mb-4">
                    <span class="section-label">Role Name</span>
                    <input
                        type="text"
                        name="name"
                        class="form-control rounded-3 shadow-sm"
                        placeholder="e.g. manager"
                        style="font-size:13px; max-width:360px;"
                    >
                </div>

                {{-- Permissions Grid --}}
                <div class="mb-4">
                    <span class="section-label">Permissions</span>
                    <div class="perm-grid">
                        @foreach($permissions as $perm)
                            <label class="perm-chip">
                                <input type="checkbox" name="permissions[]" value="{{ $perm->name }}">
                                {{ ucwords(str_replace('_', ' ', $perm->name)) }}
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end">
                    <button
                        type="submit"
                        class="btn px-4 py-2 rounded-3 fw-semibold shadow-sm"
                        style="background:#7c3aed; color:#fff; font-size:13px;"
                    >
                        <i class="fa-solid fa-plus me-1"></i> Create Role
                    </button>
                </div>

            </form>
        </div>
    </div>

    {{-- ALL ROLES TABLE --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-bottom d-flex align-items-center py-3 rounded-top-4">
            <div class="d-flex align-items-center gap-3">
                <div class="card-header-icon" style="background:#d1fae5; color:#059669;">
                    <i class="fa-solid fa-users-gear"></i>
                </div>
                <div>
                    <div class="fw-semibold text-dark" style="font-size:14px;">All Roles</div>
                    <div class="text-muted" style="font-size:12px;">{{ $roles->count() }} roles configured</div>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0" style="font-size:13px;">
                    <thead>
                        <tr style="border-bottom:1px solid #f1f3f5;">
                            <th class="ps-4 py-3 text-muted fw-semibold" style="font-size:11px;letter-spacing:.06em;text-transform:uppercase;width:50px;">#</th>
                            <th class="py-3 text-muted fw-semibold" style="font-size:11px;letter-spacing:.06em;text-transform:uppercase;width:140px;">Role</th>
                            <th class="py-3 text-muted fw-semibold" style="font-size:11px;letter-spacing:.06em;text-transform:uppercase;">Permissions</th>
                            <th class="py-3 pe-4 text-muted fw-semibold text-end" style="font-size:11px;letter-spacing:.06em;text-transform:uppercase;width:160px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr class="tbl-row-hover" style="border-bottom:1px solid #f8f9fa;">
                            <td class="ps-4 py-3 text-muted" style="font-family:'Courier New',monospace;font-size:12px;">
                                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="py-3">
                                @php
                                    $cls = match(strtolower($role->name)) {
                                        'admin' => 'badge-admin',
                                        'agent' => 'badge-agent',
                                        'user'  => 'badge-user',
                                        default => 'badge-custom',
                                    };
                                @endphp
                                <span class="role-badge {{ $cls }}">{{ ucfirst($role->name) }}</span>
                            </td>
                            <td class="py-3">
                                <div class="d-flex flex-wrap">
                                    @forelse($role->permissions as $perm)
                                        <span class="perm-tag">{{ $perm->name }}</span>
                                    @empty
                                        <span class="text-muted small fst-italic">No permissions</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="py-3 pe-4">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a
                                        href="{{ route('roles.edit', $role->id) }}"
                                        class="btn btn-sm rounded-2 fw-medium"
                                        style="font-size:11.5px;background:#ede9fe;color:#6d28d9;border:1px solid #c4b5fd;"
                                    >
                                        <i class="fa-solid fa-pen-to-square me-1"></i>Edit
                                    </a>
                                    <form action="{{ route('roles.delete', $role->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-sm rounded-2 fw-medium"
                                            style="font-size:11.5px;background:#fee2e2;color:#b91c1c;border:1px solid #fca5a5;"
                                            onclick="return confirm('Delete this role?')"
                                        >
                                            <i class="fa-solid fa-trash me-1"></i>Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

</x-app-layout>