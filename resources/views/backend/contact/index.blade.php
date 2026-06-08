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
                <h4 class="fw-bold mb-1">Contact Messages</h4>
                <p class="text-muted small mb-0">Manage customer inquiries from one place</p>
            </div>
            <div class="mt-2 mt-md-0">
                <span class="badge badge-count">
                    <i class="bi bi-database me-1"></i>
                    {{ $contacts->count() }} Messages
                </span>
            </div>
        </div>
    </div>

    <div class="mx-3">
        <div class="card-modern">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 admin-table">
                    <thead>
                        <tr>
                            <th style="width:50px;">#</th>
                            <th><i class="bi bi-person me-1 text-primary"></i> Name</th>
                            <th><i class="bi bi-envelope me-1 text-primary"></i> Email</th>
                            <th><i class="bi bi-chat-dots me-1 text-primary"></i> Message</th>
                            <th style="width:120px;"><i class="bi bi-calendar-event me-1 text-primary"></i> Date</th>
                            <th style="width:100px;"><i class="bi bi-clock me-1 text-primary"></i> Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contacts as $contact)
                            <tr>
                                <td class="fw-semibold text-muted">{{ $loop->iteration }}</td>
                                <td class="fw-semibold">{{ $contact->name }}</td>
                                <td><span class="text-muted small">{{ $contact->email }}</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary py-1 px-2" data-bs-toggle="modal" data-bs-target="#messageModal{{ $contact->id }}">
                                        View Message
                                    </button>

                                    <!-- Message Modal -->
                                    <div class="modal fade modal-modern" id="messageModal{{ $contact->id }}" tabindex="-1" aria-labelledby="messageModalLabel{{ $contact->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background: linear-gradient(135deg, #6366f1, #8b5cf6); color: #fff; border-radius: 12px 12px 0 0;">
                                                    <h5 class="modal-title fw-semibold" id="messageModalLabel{{ $contact->id }}">
                                                        <i class="bi bi-chat-dots me-2"></i> Message from {{ $contact->name }}
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body px-4 py-3">
                                                    <p>{{ $contact->message }}</p>
                                                </div>
                                                <div class="modal-footer border-0 px-4 pb-4">
                                                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-date">
                                        {{ \Carbon\Carbon::parse($contact->created_at)->timezone('Asia/Dhaka')->format('d M Y') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-time">
                                        {{ \Carbon\Carbon::parse($contact->created_at)->timezone('Asia/Dhaka')->format('h:i A') }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="bi bi-inbox"></i>
                                        <div class="fw-semibold">No Messages Found</div>
                                        <small class="text-muted">Customer messages will appear here once submitted.</small>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection
