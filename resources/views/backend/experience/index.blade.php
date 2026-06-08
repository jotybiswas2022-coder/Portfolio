@extends('backend.app')

@section('content')

<div class="container-fluid py-3">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-1"><i class="bi bi-briefcase me-2" style="color:#6366f1;"></i>Work Experiences</h4>
            <p class="text-muted small mb-0">Manage your career timeline</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge rounded-pill px-3 py-2" style="background:rgba(99,102,241,0.1); color:#6366f1; font-weight:500;">
                <i class="bi bi-database me-1"></i> {{ $experiences->count() }} Experiences
            </span>
            <a href="{{ route('admin.experiences.create') }}" class="btn btn-primary rounded-3 px-3" style="background:#6366f1; border-color:#6366f1;">
                <i class="bi bi-plus-lg me-1"></i> Add Experience
            </a>
        </div>
    </div>

    {{-- Table Card --}}
    @if($experiences->isEmpty())
        <div class="text-center py-5">
            <div class="empty-state">
                <i class="bi bi-briefcase"></i>
                <div class="fw-semibold mb-2">No Experiences Found</div>
                <p class="text-muted small">Add your work history to showcase your career!</p>
                <a href="{{ route('admin.experiences.create') }}" class="btn btn-primary rounded-3 px-4" style="background:#6366f1; border-color:#6366f1;">
                    <i class="bi bi-plus-lg me-1"></i> Add Experience
                </a>
            </div>
        </div>
    @else
        <div class="card border-0 shadow-sm rounded-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="min-width:800px;">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-muted small fw-semibold" style="width:50px;">#</th>
                            <th class="py-3 text-muted small fw-semibold">Company</th>
                            <th class="py-3 text-muted small fw-semibold">Position</th>
                            <th class="py-3 text-muted small fw-semibold">Duration</th>
                            <th class="py-3 text-muted small fw-semibold" style="width:120px;">Location</th>
                            <th class="py-3 text-muted small fw-semibold" style="width:65px;">Order</th>
                            <th class="py-3 text-muted small fw-semibold" style="width:90px;">Status</th>
                            <th class="pe-4 py-3 text-muted small fw-semibold" style="width:120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($experiences as $exp)
                            <tr>
                                <td class="ps-4 fw-semibold text-muted">{{ $loop->iteration }}</td>
                                <td class="fw-semibold">
                                    {{ $exp->company }}
                                    @if($exp->is_current)
                                        <span class="badge rounded-pill px-2 py-1 ms-1" style="background:rgba(16,185,129,0.12); color:#059669; font-size:0.6rem; font-weight:600;">Current</span>
                                    @endif
                                </td>
                                <td>{{ $exp->position }}</td>
                                <td class="small text-muted">{{ $exp->duration }}</td>
                                <td class="small text-muted">{{ $exp->location ?: '—' }}</td>
                                <td><span class="badge rounded-pill px-3 py-1" style="background:#f1f5f9; color:#475569; font-weight:500;">{{ $exp->sort_order }}</span></td>
                                <td>
                                    <a href="{{ route('admin.experiences.toggleStatus', $exp->id) }}"
                                       class="badge rounded-pill px-3 py-1 text-decoration-none status-badge {{ $exp->is_active ? 'active-badge' : 'inactive-badge' }}"
                                       data-title="{{ $exp->company }}">
                                        {{ $exp->is_active ? 'Active' : 'Inactive' }}
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.experiences.edit', $exp->id) }}"
                                           class="btn btn-sm btn-outline-primary rounded-3 px-2">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button"
                                                class="btn btn-sm btn-outline-danger rounded-3 px-2 delete-btn"
                                                data-id="{{ $exp->id }}"
                                                data-title="{{ $exp->company }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <form id="delete-form-{{ $exp->id }}"
                                              action="{{ route('admin.experiences.destroy', $exp->id) }}"
                                              method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
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
.status-badge { transition: all 0.2s; }
.status-badge:hover { transform: scale(1.05); }
.active-badge { background: rgba(16,185,129,0.12); color: #059669; }
.inactive-badge { background: #f1f5f9; color: #94a3b8; }
</style>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const title = this.dataset.title;
            Swal.fire({
                title: 'Delete Experience?',
                text: 'Are you sure you want to delete the experience at "' + title + '"?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#64748b',
                confirmButtonText: '<i class="bi bi-trash me-1"></i> Delete',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        });
    });

    document.querySelectorAll('.status-badge').forEach(badge => {
        badge.addEventListener('click', function (e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            const title = this.dataset.title;
            const current = this.textContent.trim();
            Swal.fire({
                title: 'Toggle Status?',
                text: 'Change "' + title + '" from ' + current + ' to ' + (current === 'Active' ? 'Inactive' : 'Active') + '?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#6366f1',
                cancelButtonColor: '#64748b',
                confirmButtonText: '<i class="bi bi-arrow-repeat me-1"></i> Toggle',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        });
    });
});
</script>
@endsection

@endsection
