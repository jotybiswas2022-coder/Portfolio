@extends('backend.app')

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show alert-modern mx-3 mt-3" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="container-fluid py-2">

    <!-- Header -->
    <div class="page-header mx-3 mt-3 mb-3">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-1">
                    <i class="bi bi-folder2-open me-2 text-primary"></i>Projects
                </h4>
                <p class="text-muted small mb-0">Manage your portfolio projects</p>
            </div>
            <div class="mt-2 mt-md-0 d-flex gap-2">
                <span class="badge badge-count">
                    <i class="bi bi-database me-1"></i>
                    {{ $projects->count() }} Projects
                </span>
                <a href="{{ route('admin.projects.create') }}" class="btn btn-admin btn-admin-primary btn-sm px-3">
                    <i class="bi bi-plus-lg me-1"></i> Add Project
                </a>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="mx-3">
        @if($projects->isEmpty())
            <div class="text-center py-5">
                <div class="empty-state">
                    <i class="bi bi-folder-plus"></i>
                    <div class="fw-semibold mb-2">No Projects Found</div>
                    <p class="text-muted small">Start by adding your first project!</p>
                    <a href="{{ route('admin.projects.create') }}" class="btn btn-admin btn-admin-primary px-4">
                        <i class="bi bi-plus-lg me-1"></i> Add Project
                    </a>
                </div>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 admin-table">
                    <thead>
                        <tr>
                            <th style="width:50px;">#</th>
                            <th style="width:80px;">Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Tech Stack</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th style="width:200px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                            <tr>
                                <td class="fw-semibold text-muted">{{ $loop->iteration }}</td>
                                <td>
                                    @if($project->image)
                                        <img src="{{ config('app.storage_url') }}{{ $project->image }}"
                                             alt="{{ $project->title }}"
                                             class="rounded"
                                             style="width: 50px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="bg-secondary rounded d-flex align-items-center justify-content-center"
                                             style="width: 50px; height: 40px;">
                                            <i class="bi bi-image text-white opacity-50"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $project->title }}</td>
                                <td>
                                    @if($project->category)
                                        <span class="badge bg-info-subtle text-info">{{ $project->category }}</span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="tech-stack-preview">
                                        @foreach($project->getTechStackArray() as $tech)
                                            <span class="tech-tag">{{ $tech }}</span>
                                        @endforeach
                                    </div>
                                </td>
                                <td><span class="badge bg-light text-dark">{{ $project->sort_order }}</span></td>
                                <td>
                                    <a href="{{ route('admin.projects.toggleStatus', $project->id) }}"
                                       class="badge text-decoration-none {{ $project->is_active ? 'bg-success' : 'bg-secondary' }}"
                                       onclick="return confirm('Toggle status for \'{{ $project->title }}\'?')">
                                        {{ $project->is_active ? 'Active' : 'Inactive' }}
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.projects.edit', $project->id) }}"
                                           class="btn btn-sm btn-outline-primary py-1 px-2">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.projects.destroy', $project->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Delete \'{{ $project->title }}\'? This cannot be undone.')">
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
.tech-tag {
    display: inline-block;
    padding: 2px 8px;
    margin: 1px;
    background: rgba(99,102,241,0.08);
    border: 1px solid rgba(99,102,241,0.2);
    border-radius: 12px;
    font-size: 0.7rem;
    color: #6366f1;
    white-space: nowrap;
}
</style>

@endsection
