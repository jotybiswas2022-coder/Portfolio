@extends('backend.app')

@section('content')

<div class="container-fluid py-3">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-1"><i class="bi bi-lightning-charge me-2" style="color:#6366f1;"></i>Skills</h4>
            <p class="text-muted small mb-0">Manage your technical skills</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge rounded-pill px-3 py-2" style="background:rgba(99,102,241,0.1); color:#6366f1; font-weight:500;">
                <i class="bi bi-database me-1"></i> {{ $skills->count() }} Skills
            </span>
            <a href="{{ route('admin.skills.create') }}" class="btn btn-primary rounded-3 px-3" style="background:#6366f1; border-color:#6366f1;">
                <i class="bi bi-plus-lg me-1"></i> Add Skill
            </a>
        </div>
    </div>

    {{-- Table Card --}}
    @if($skills->isEmpty())
        <div class="text-center py-5">
            <div class="empty-state">
                <i class="bi bi-lightning-charge"></i>
                <div class="fw-semibold mb-2">No Skills Found</div>
                <p class="text-muted small">Add your technical skills to showcase your expertise!</p>
                <a href="{{ route('admin.skills.create') }}" class="btn btn-primary rounded-3 px-4" style="background:#6366f1; border-color:#6366f1;">
                    <i class="bi bi-plus-lg me-1"></i> Add Skill
                </a>
            </div>
        </div>
    @else
        <div class="card border-0 shadow-sm rounded-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="min-width:750px;">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-muted small fw-semibold" style="width:50px;">#</th>
                            <th class="py-3 text-muted small fw-semibold" style="width:55px;">Icon</th>
                            <th class="py-3 text-muted small fw-semibold">Name</th>
                            <th class="py-3 text-muted small fw-semibold" style="width:80px;">Level</th>
                            <th class="py-3 text-muted small fw-semibold">Progress</th>
                            <th class="py-3 text-muted small fw-semibold" style="width:65px;">Order</th>
                            <th class="py-3 text-muted small fw-semibold" style="width:90px;">Status</th>
                            <th class="pe-4 py-3 text-muted small fw-semibold" style="width:120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($skills as $skill)
                            <tr>
                                <td class="ps-4 fw-semibold text-muted">{{ $loop->iteration }}</td>
                                <td class="text-center" style="font-size:1.3rem;">
                                    @if($skill->icon)
                                        <span style="color:#6366f1;"><i class="bi {{ $skill->icon }}"></i></span>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $skill->name }}</td>
                                <td>
                                    <span class="badge rounded-pill px-3 py-1 fw-semibold" style="background:rgba(99,102,241,0.1); color:#6366f1;">{{ $skill->percentage }}%</span>
                                </td>
                                <td style="min-width:150px;">
                                    <div class="progress" style="height:7px; border-radius:10px; background:#e2e8f0;">
                                        <div class="progress-bar rounded-pill" style="width:{{ $skill->percentage }}%; background:linear-gradient(90deg,#6366f1,#818cf8);" role="progressbar"></div>
                                    </div>
                                </td>
                                <td><span class="badge rounded-pill px-3 py-1" style="background:#f1f5f9; color:#475569; font-weight:500;">{{ $skill->sort_order }}</span></td>
                                <td>
                                    <a href="{{ route('admin.skills.toggleStatus', $skill->id) }}"
                                       class="badge rounded-pill px-3 py-1 text-decoration-none status-badge {{ $skill->is_active ? 'active-badge' : 'inactive-badge' }}"
                                       data-title="{{ $skill->name }}">
                                        {{ $skill->is_active ? 'Active' : 'Inactive' }}
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.skills.edit', $skill->id) }}"
                                           class="btn btn-sm btn-outline-primary rounded-3 px-2">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button"
                                                class="btn btn-sm btn-outline-danger rounded-3 px-2 delete-btn"
                                                data-id="{{ $skill->id }}"
                                                data-title="{{ $skill->name }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <form id="delete-form-{{ $skill->id }}"
                                              action="{{ route('admin.skills.destroy', $skill->id) }}"
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
                title: 'Delete Skill?',
                text: 'Are you sure you want to delete "' + title + '"?',
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
