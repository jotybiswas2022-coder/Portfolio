@extends('backend.app')

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show alert-modern mx-3 mt-3" role="alert" style="border-radius: 12px; font-size: 14px;">
        <i class="bi bi-check-circle me-1"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="container-fluid py-2">

    <!-- Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">
                <i class="bi bi-chat-quote me-2" style="color: #6366f1;"></i>Testimonials
            </h4>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">Manage client reviews & testimonials</p>
        </div>
        <div class="d-flex gap-2 mt-2 mt-md-0">
            <span class="badge badge-count">
                <i class="bi bi-database me-1"></i>
                {{ $testimonials->count() }} Total
            </span>
            <a href="{{ route('admin.testimonials.create') }}" class="btn btn-admin btn-admin-primary btn-sm px-3">
                <i class="bi bi-plus-lg me-1"></i> Add New
            </a>
        </div>
    </div>

    @if($testimonials->isEmpty())
        <div class="text-center py-5">
            <div class="empty-state">
                <i class="bi bi-chat-quote"></i>
                <div class="fw-semibold mb-2" style="font-size: 1.1rem;">No Testimonials Found</div>
                <p class="text-muted small">Start by adding your first client testimonial!</p>
                <a href="{{ route('admin.testimonials.create') }}" class="btn btn-admin btn-admin-primary px-4">
                    <i class="bi bi-plus-lg me-1"></i> Add Testimonial
                </a>
            </div>
        </div>
    @else
        <div class="card-modern">
            <div class="table-responsive">
                <table class="table table-modern mb-0">
                    <thead>
                        <tr>
                            <th style="width:45px;">#</th>
                            <th style="width:55px;">Avatar</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Rating</th>
                            <th>Message</th>
                            <th style="width:60px;">Order</th>
                            <th style="width:90px;">Status</th>
                            <th style="width:100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($testimonials as $testimonial)
                            <tr>
                                <td class="fw-semibold" style="color: #94a3b8;">{{ $loop->iteration }}</td>
                                <td>
                                    @if($testimonial->avatar)
                                        <img src="{{ config('app.storage_url') }}{{ $testimonial->avatar }}"
                                             alt="{{ $testimonial->name }}"
                                             class="rounded-circle shadow-sm"
                                             style="width: 42px; height: 42px; object-fit: cover; border: 2px solid rgba(99,102,241,0.15);">
                                    @else
                                        <div style="width: 42px; height: 42px; border-radius: 50%; background: linear-gradient(135deg, #6366f1, #8b5cf6); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 1rem;">
                                            {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $testimonial->name }}</td>
                                <td><span style="color: #64748b; font-size: 0.85rem;">{{ $testimonial->designation_display ?: '—' }}</span></td>
                                <td>
                                    <div style="color: #f59e0b; white-space: nowrap; font-size: 0.85rem;">
                                        @foreach($testimonial->stars as $filled)
                                            <i class="bi {{ $filled ? 'bi-star-fill' : 'bi-star' }}"></i>
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-sm px-2 py-1 rounded-3" 
                                            style="background: rgba(99,102,241,0.08); color: #6366f1; border: none; font-weight: 500; font-size: 0.78rem;"
                                            data-bs-toggle="modal" data-bs-target="#messageModal{{ $testimonial->id }}">
                                        <i class="bi bi-eye me-1"></i> View
                                    </button>

                                    <!-- Message Modal -->
                                    <div class="modal fade modal-modern" id="messageModal{{ $testimonial->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background: linear-gradient(135deg, #6366f1, #8b5cf6); color: #fff; border-radius: 12px 12px 0 0;">
                                                    <h5 class="modal-title fw-semibold"><i class="bi bi-chat-quote me-2"></i>{{ $testimonial->name }}'s Review</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body px-4 py-3">
                                                    <div class="mb-3 d-flex align-items-center gap-2">
                                                        @if($testimonial->avatar)
                                                            <img src="{{ config('app.storage_url') }}{{ $testimonial->avatar }}"
                                                                 class="rounded-circle shadow-sm" style="width:50px; height:50px; object-fit:cover;">
                                                        @endif
                                                        <div>
                                                            <div class="fw-bold">{{ $testimonial->name }}</div>
                                                            <div style="color: #f59e0b; font-size: 0.85rem;">
                                                                @foreach($testimonial->stars as $filled)
                                                                    <i class="bi {{ $filled ? 'bi-star-fill' : 'bi-star' }}"></i>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="mb-0" style="font-style: italic; line-height: 1.7; color: #334155;">
                                                        "{{ $testimonial->message }}"
                                                    </p>
                                                </div>
                                                <div class="modal-footer border-0 px-4 pb-4">
                                                    <button type="button" class="btn btn-secondary rounded-3 px-4" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge-admin" style="background: rgba(99,102,241,0.08); color: #6366f1;">{{ $testimonial->sort_order }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.testimonials.toggleStatus', $testimonial->id) }}"
                                       class="badge-admin text-decoration-none d-inline-block"
                                       style="background: {{ $testimonial->is_active ? 'rgba(16,185,129,0.12)' : 'rgba(100,116,139,0.12)' }}; color: {{ $testimonial->is_active ? '#10b981' : '#64748b' }};"
                                       onclick="return confirm('Toggle status for \'{{ $testimonial->name }}\'?')">
                                        <i class="bi {{ $testimonial->is_active ? 'bi-check-circle-fill' : 'bi-x-circle-fill' }} me-1"></i>
                                        {{ $testimonial->is_active ? 'Active' : 'Inactive' }}
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}"
                                           class="btn btn-sm rounded-3"
                                           style="background: rgba(99,102,241,0.08); color: #6366f1; border: none; padding: 0.4rem 0.7rem;">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Delete testimonial from {{ $testimonial->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm rounded-3"
                                                    style="background: rgba(239,68,68,0.08); color: #ef4444; border: none; padding: 0.4rem 0.7rem;">
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
        </div>
    @endif
</div>

<style>
@media (max-width: 768px) {
    .table-responsive { overflow-x: auto; -webkit-overflow-scrolling: touch; }
    .table-modern thead th, .table-modern tbody td { font-size: 0.78rem; padding: 0.6rem 0.6rem; }
    .d-flex.gap-2 .btn-admin { font-size: 0.78rem; padding: 0.3rem 0.8rem; }
}
@media (max-width: 480px) {
    .badge-admin { font-size: 0.7rem; padding: 0.2rem 0.5rem; }
}
</style>

@endsection
