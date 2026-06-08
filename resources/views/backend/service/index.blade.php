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

    <div class="page-header mx-3 mt-3 mb-3">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-1">
                    <i class="bi bi-gear me-2 text-primary"></i>Services
                </h4>
                <p class="text-muted small mb-0">Manage your services</p>
            </div>
            <div class="mt-2 mt-md-0 d-flex gap-2">
                <span class="badge badge-count">
                    <i class="bi bi-database me-1"></i>
                    {{ $services->count() }} Services
                </span>
                <a href="{{ route('admin.services.create') }}" class="btn btn-admin btn-admin-primary btn-sm px-3">
                    <i class="bi bi-plus-lg me-1"></i> Add Service
                </a>
            </div>
        </div>
    </div>

    <div class="mx-3">
        @if($services->isEmpty())
            <div class="text-center py-5">
                <div class="empty-state">
                    <i class="bi bi-gear"></i>
                    <div class="fw-semibold mb-2">No Services Found</div>
                    <p class="text-muted small">Add your services to showcase what you offer!</p>
                    <a href="{{ route('admin.services.create') }}" class="btn btn-admin btn-admin-primary px-4">
                        <i class="bi bi-plus-lg me-1"></i> Add Service
                    </a>
                </div>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 admin-table">
                    <thead>
                        <tr>
                            <th style="width:50px;">#</th>
                            <th>Icon</th>
                            <th>Title</th>
                            <th>Short Description</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th style="width:120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                            <tr>
                                <td class="fw-semibold text-muted">{{ $loop->iteration }}</td>
                                <td class="text-center" style="font-size:1.4rem;">
                                    @if($service->icon)
                                        <i class="bi {{ $service->icon }} text-primary"></i>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $service->title }}</td>
                                <td>
                                    <span class="text-muted small">{{ Str::limit($service->short_description, 60) ?: '—' }}</span>
                                </td>
                                <td><span class="badge bg-light text-dark">{{ $service->sort_order }}</span></td>
                                <td>
                                    <a href="{{ route('admin.services.toggleStatus', $service->id) }}"
                                       class="badge text-decoration-none {{ $service->is_active ? 'bg-success' : 'bg-secondary' }}"
                                       onclick="return confirm('Toggle status for \'{{ $service->title }}\'?')">
                                        {{ $service->is_active ? 'Active' : 'Inactive' }}
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.services.edit', $service->id) }}"
                                           class="btn btn-sm btn-outline-primary py-1 px-2">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.services.destroy', $service->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Delete service \'{{ $service->title }}\'?')">
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

@endsection
