@extends('backend.app')

@section('content')

<div class="container-fluid py-3">

    {{-- Dashboard Header --}}
    <div class="mb-4">
        <div class="p-4 rounded-4 shadow-lg" style="background: linear-gradient(135deg, #6a11cb, #2575fc); color: #fff;">
            <div class="d-flex align-items-center justify-content-between flex-wrap">
                <div class="fw-bold fs-4 d-flex align-items-center">
                    <i class="bi bi-speedometer2 me-2 fs-3"></i>
                    Welcome to Admin Dashboard
                </div>
                <div class="mt-2 mt-md-0 fw-semibold">
                    Hello, <strong>{{ auth()->user()->name }}</strong>! Here's a quick overview.
                </div>
            </div>
        </div>
    </div>

    {{-- Summary Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="stat-card text-center">
                <div class="stat-icon mx-auto" style="background: rgba(99,102,241,0.1); color: #6366f1;">
                    <i class="bi bi-people"></i>
                </div>
                <div class="stat-number">{{ $accountsCount }}</div>
                <div class="stat-label">Total Accounts</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="stat-card text-center">
                <div class="stat-icon mx-auto" style="background: rgba(16,185,129,0.1); color: #10b981;">
                    <i class="bi bi-envelope"></i>
                </div>
                <div class="stat-number">{{ $contactsCount }}</div>
                <div class="stat-label">Total Messages</div>
            </div>
        </div>
    </div>

    {{-- Recent Contacts --}}
    <div class="row">
        <div class="col-12">
            <div class="card-modern">
                <div class="card-header">
                    <i class="bi bi-chat-dots me-2"></i> Recent Messages
                </div>
                <div class="card-body p-0">
                    @if($contacts->isEmpty())
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 mb-2 d-block"></i>
                            <div>No messages found</div>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 admin-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contacts as $index => $contact)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $contact->name }}</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary py-1 px-2" data-bs-toggle="modal" data-bs-target="#messageModal{{ $contact->id }}">
                                                    View
                                                </button>

                                                <!-- Message Modal -->
                                                <div class="modal fade modal-modern" id="messageModal{{ $contact->id }}" tabindex="-1" aria-labelledby="messageModalLabel{{ $contact->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background: linear-gradient(135deg, #6366f1, #8b5cf6); color: #fff; border-radius: 12px 12px 0 0;">
                                                                <h5 class="modal-title fw-semibold" id="messageModalLabel{{ $contact->id }}">
                                                                    Message from {{ $contact->name }}
                                                                </h5>
                                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body px-4 py-3">
                                                                <p>{{ $contact->message }}</p>
                                                            </div>
                                                            <div class="modal-footer border-0 px-4 pb-4">
                                                                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                                                                    Close
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
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
        </div>
    </div>

</div>

@endsection
