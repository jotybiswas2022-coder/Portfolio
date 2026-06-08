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
                    <i class="bi bi-question-circle me-2 text-primary"></i>FAQs
                </h4>
                <p class="text-muted small mb-0">Manage frequently asked questions</p>
            </div>
            <div class="mt-2 mt-md-0 d-flex gap-2">
                <span class="badge badge-count">
                    <i class="bi bi-database me-1"></i>
                    {{ $faqs->count() }} FAQs
                </span>
                <a href="{{ route('admin.faqs.create') }}" class="btn btn-admin btn-admin-primary btn-sm px-3">
                    <i class="bi bi-plus-lg me-1"></i> Add FAQ
                </a>
            </div>
        </div>
    </div>

    <div class="mx-3">
        @if($faqs->isEmpty())
            <div class="text-center py-5">
                <div class="empty-state">
                    <i class="bi bi-question-circle"></i>
                    <div class="fw-semibold mb-2">No FAQs Found</div>
                    <p class="text-muted small">Add frequently asked questions to help your visitors!</p>
                    <a href="{{ route('admin.faqs.create') }}" class="btn btn-admin btn-admin-primary px-4">
                        <i class="bi bi-plus-lg me-1"></i> Add FAQ
                    </a>
                </div>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 admin-table">
                    <thead>
                        <tr>
                            <th style="width:50px;">#</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th style="width:120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($faqs as $faq)
                            <tr>
                                <td class="fw-semibold text-muted">{{ $loop->iteration }}</td>
                                <td class="fw-semibold" style="max-width:250px;">
                                    <span class="text-truncate d-inline-block" style="max-width:250px;">{{ $faq->question }}</span>
                                </td>
                                <td style="max-width:300px;">
                                    <span class="text-muted small text-truncate d-inline-block" style="max-width:300px;">
                                        {{ Str::limit(strip_tags($faq->answer), 100) }}
                                    </span>
                                </td>
                                <td><span class="badge bg-light text-dark">{{ $faq->sort_order }}</span></td>
                                <td>
                                    <a href="{{ route('admin.faqs.toggleStatus', $faq->id) }}"
                                       class="badge text-decoration-none {{ $faq->is_active ? 'bg-success' : 'bg-secondary' }}"
                                       onclick="return confirm('Toggle status for this FAQ?')">
                                        {{ $faq->is_active ? 'Active' : 'Inactive' }}
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.faqs.edit', $faq->id) }}"
                                           class="btn btn-sm btn-outline-primary py-1 px-2">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.faqs.destroy', $faq->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Delete this FAQ?')">
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
