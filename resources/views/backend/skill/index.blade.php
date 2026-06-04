@extends('backend.app')

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mx-3 mt-3 shadow-sm" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="container-fluid" style="padding: 20px 0;">

    <div class="skill-header mx-3 mt-3 mb-3">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-1">
                    <i class="bi bi-lightning-charge me-2 text-primary"></i>Skills
                </h4>
                <p class="text-muted small mb-0">Manage your technical skills</p>
            </div>
            <div class="mt-2 mt-md-0 d-flex gap-2">
                <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">
                    <i class="bi bi-database me-1"></i>
                    {{ $skills->count() }} Skills
                </span>
                <a href="{{ route('admin.skills.create') }}" class="btn btn-primary btn-sm rounded-pill px-3">
                    <i class="bi bi-plus-lg me-1"></i> Add Skill
                </a>
            </div>
        </div>
    </div>

    <div class="mx-3">
        @if($skills->isEmpty())
            <div class="text-center py-5">
                <div class="empty-state">
                    <i class="bi bi-lightning-charge fs-1 text-muted mb-3 d-block"></i>
                    <div class="fw-semibold mb-2">No Skills Found</div>
                    <p class="text-muted small">Add your technical skills to showcase your expertise!</p>
                    <a href="{{ route('admin.skills.create') }}" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-plus-lg me-1"></i> Add Skill
                    </a>
                </div>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 skill-table">
                    <thead>
                        <tr>
                            <th style="width:50px;">#</th>
                            <th>Icon</th>
                            <th>Name</th>
                            <th>Percentage</th>
                            <th>Bar</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th style="width:120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($skills as $skill)
                            <tr>
                                <td class="fw-semibold text-muted">{{ $loop->iteration }}</td>
                                <td class="text-center" style="font-size:1.4rem;">
                                    @if($skill->icon)
                                        <i class="bi {{ $skill->icon }} text-primary"></i>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $skill->name }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ $skill->percentage }}%</span>
                                </td>
                                <td style="min-width:150px;">
                                    <div class="progress" style="height:8px; border-radius:4px; background:#e9ecef;">
                                        <div class="progress-bar bg-primary"
                                             style="width: {{ $skill->percentage }}%; border-radius:4px;"
                                             role="progressbar"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-light text-dark">{{ $skill->sort_order }}</span></td>
                                <td>
                                    <a href="{{ route('admin.skills.toggleStatus', $skill->id) }}"
                                       class="badge text-decoration-none {{ $skill->is_active ? 'bg-success' : 'bg-secondary' }}"
                                       onclick="return confirm('Toggle status for \'{{ $skill->name }}\'?')">
                                        {{ $skill->is_active ? 'Active' : 'Inactive' }}
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.skills.edit', $skill->id) }}"
                                           class="btn btn-sm btn-outline-primary py-1 px-2">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.skills.destroy', $skill->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Delete skill \'{{ $skill->name }}\'?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger py-1 px-2">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<style>
.skill-header{
    background:#fff;
    border-radius:14px;
    padding:18px 20px;
    box-shadow:0 2px 10px rgba(0,0,0,.04);
}
.skill-table thead{
    background:#f8fafc;
    position:sticky;
    top:0;
    z-index:5;
}
.table-hover tbody tr:hover{
    background:rgba(13,110,253,.06);
    transition:.18s ease;
}
.alert{
    border-radius:12px;
    font-size:14px;
}
@media (max-width: 768px) {
    .table-responsive { overflow-x: auto; }
}
</style>
@endsection
