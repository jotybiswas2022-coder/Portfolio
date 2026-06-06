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

    <div class="exp-header mx-3 mt-3 mb-3">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-1">
                    <i class="bi bi-briefcase me-2 text-primary"></i>Work Experiences
                </h4>
                <p class="text-muted small mb-0">Manage your career timeline</p>
            </div>
            <div class="mt-2 mt-md-0 d-flex gap-2">
                <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">
                    <i class="bi bi-database me-1"></i>
                    {{ $experiences->count() }} Experiences
                </span>
                <a href="{{ route('admin.experiences.create') }}" class="btn btn-primary btn-sm rounded-pill px-3">
                    <i class="bi bi-plus-lg me-1"></i> Add Experience
                </a>
            </div>
        </div>
    </div>

    <div class="mx-3">
        @if($experiences->isEmpty())
            <div class="text-center py-5">
                <div class="empty-state">
                    <i class="bi bi-briefcase fs-1 text-muted mb-3 d-block"></i>
                    <div class="fw-semibold mb-2">No Experiences Found</div>
                    <p class="text-muted small">Add your work history to showcase your career!</p>
                    <a href="{{ route('admin.experiences.create') }}" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-plus-lg me-1"></i> Add Experience
                    </a>
                </div>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 exp-table">
                    <thead>
                        <tr>
                            <th style="width:50px;">#</th>
                            <th>Company</th>
                            <th>Position</th>
                            <th>Duration</th>
                            <th>Location</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th style="width:120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($experiences as $exp)
                            <tr>
                                <td class="fw-semibold text-muted">{{ $loop->iteration }}</td>
                                <td class="fw-semibold">
                                    {{ $exp->company }}
                                    @if($exp->is_current)
                                        <span class="badge bg-success ms-1" style="font-size:0.6rem;">Current</span>
                                    @endif
                                </td>
                                <td>{{ $exp->position }}</td>
                                <td class="small text-muted">{{ $exp->duration }}</td>
                                <td class="small text-muted">{{ $exp->location ?? '—' }}</td>
                                <td><span class="badge bg-light text-dark">{{ $exp->sort_order }}</span></td>
                                <td>
                                    <a href="{{ route('admin.experiences.toggleStatus', $exp->id) }}"
                                       class="badge text-decoration-none {{ $exp->is_active ? 'bg-success' : 'bg-secondary' }}"
                                       onclick="return confirm('Toggle status for \'{{ $exp->company }}\'?')">
                                        {{ $exp->is_active ? 'Active' : 'Inactive' }}
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.experiences.edit', $exp->id) }}"
                                           class="btn btn-sm btn-outline-primary py-1 px-2">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.experiences.destroy', $exp->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Delete experience at {{ $exp->company }}?')">
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
.exp-header{
    background:#fff;
    border-radius:14px;
    padding:18px 20px;
    box-shadow:0 2px 10px rgba(0,0,0,.04);
}
.exp-table thead{
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
