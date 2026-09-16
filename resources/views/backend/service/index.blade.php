@extends('backend.app')

@section('content')
<style>
.sv-admin { font-size: 0.88rem; }
.sv-admin .status-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.72rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
    cursor: pointer;
}
.sv-admin .status-badge::before {
    content: '';
    width: 6px; height: 6px;
    border-radius: 50%;
    background: currentColor;
}
.sv-admin .status-badge:hover { transform: scale(1.05); }
.sv-admin .active-badge { background: rgba(16,185,129,0.12); color: #059669; }
.sv-admin .inactive-badge { background: #f1f5f9; color: #94a3b8; }

.sv-card {
    background: #fff;
    border: 1px solid #eef0f4;
    border-radius: 14px;
    padding: 16px;
    height: 100%;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.sv-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(99,102,241,0.08);
    border-color: #e0e7ff;
}
.sv-card .icon-tile {
    width: 52px; height: 52px;
    border-radius: 13px;
    background: linear-gradient(135deg, rgba(99,102,241,0.12), rgba(139,92,246,0.12));
    color: #6366f1;
    font-size: 1.4rem;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.sv-card .order-badge {
    font-size: 0.68rem;
    font-weight: 600;
    color: #64748b;
    background: #f1f5f9;
    border-radius: 8px;
    padding: 3px 8px;
}
.sv-card .sv-title {
    font-size: 0.92rem;
    font-weight: 600;
    color: #1e293b;
    line-height: 1.3;
    margin: 0;
}
.sv-card .sv-desc {
    font-size: 0.76rem;
    color: #64748b;
    line-height: 1.5;
    margin: 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.sv-card .sv-actions .btn-icon {
    width: 30px; height: 30px;
    padding: 0;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 0.85rem;
    border: 1px solid #e2e8f0;
    background: #fff;
    color: #64748b;
    transition: all 0.2s;
}
.sv-card .sv-actions .btn-icon-edit:hover {
    color: #6366f1;
    border-color: #c7d2fe;
    background: #eef2ff;
}
.sv-card .sv-actions .btn-icon-del:hover {
    color: #dc2626;
    border-color: #fecaca;
    background: #fef2f2;
}

@media (max-width: 767.98px) {
    .sv-admin { font-size: 0.8rem; }
    .sv-card { padding: 12px; border-radius: 12px; gap: 10px; }
    .sv-card .icon-tile { width: 44px; height: 44px; font-size: 1.15rem; border-radius: 11px; }
    .sv-card .sv-title { font-size: 0.84rem; }
    .sv-card .sv-desc { font-size: 0.72rem; }
    .sv-card .status-badge { font-size: 0.66rem; padding: 3px 9px; }
    .sv-card .sv-actions .btn-icon { width: 26px; height: 26px; font-size: 0.75rem; }
}
</style>

<div class="container-fluid py-3 sv-admin">
    <div class="row justify-content-center">
        <div class="col-12 col-xxl-10">

            {{-- Header --}}
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                <div>
                    <h5 class="fw-bold mb-1" style="font-size:0.95rem;">
                        <i class="bi bi-gear me-2" style="color:#6366f1;"></i>Services
                    </h5>
                    <p class="text-muted mb-0" style="font-size:0.74rem;">Manage the services you showcase</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge rounded-pill px-3 py-2" id="servicesCount" style="background:rgba(99,102,241,0.1); color:#6366f1; font-weight:500; font-size:0.72rem;">
                        <i class="bi bi-database me-1"></i> {{ $services->count() }} Services
                    </span>
                    <a href="{{ route('admin.services.create') }}" class="btn btn-admin btn-admin-primary" style="font-size:0.78rem; padding:6px 16px;">
                        <i class="bi bi-plus-lg me-1"></i> Add Service
                    </a>
                </div>
            </div>

            {{-- Live Search --}}
            <div class="mb-3">
                <div class="input-group" style="max-width:420px;">
                    <span class="input-group-text bg-white border-end-0 rounded-start-3" style="border-color:#e2e8f0; font-size:0.8rem;">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" id="liveSearch" name="q" value="{{ $query ?? '' }}"
                           class="form-control border-start-0 ps-2" style="border-color:#e2e8f0; box-shadow:none; font-size:0.8rem; padding:7px 10px;"
                           placeholder="Search by title or description..."
                           autocomplete="off">
                    <span class="input-group-text bg-white border-start-0 rounded-end-3" style="border-color:#e2e8f0; font-size:0.8rem;">
                        <span class="spinner-border spinner-border-sm d-none text-primary" role="status" id="searchLoading"></span>
                        @if(request()->has('q') && request()->q != '')
                            <a href="{{ route('admin.services.index') }}" class="text-muted text-decoration-none"><i class="bi bi-x-lg"></i></a>
                        @endif
                    </span>
                </div>
                <div class="mt-2" id="searchInfo">
                    @if($query ?? false)
                        <small class="text-muted" style="font-size:0.72rem;">
                            <i class="bi bi-info-circle me-1"></i>
                            Showing results for "<strong>{{ $query }}</strong>" —
                            <span id="resultCount">{{ $services->count() }}</span> service(s) found
                        </small>
                    @endif
                </div>
            </div>

            {{-- Services Grid --}}
            @if($services->isEmpty() && !request()->ajax())
                <div class="text-center py-5">
                    <div class="empty-state">
                        <i class="bi bi-gear"></i>
                        <div class="fw-semibold mb-2">No Services Found</div>
                        <p class="text-muted" style="font-size:0.78rem;">Add your services to showcase what you offer!</p>
                        <a href="{{ route('admin.services.create') }}" class="btn btn-admin btn-admin-primary" style="font-size:0.78rem;">
                            <i class="bi bi-plus-lg me-1"></i> Add Service
                        </a>
                    </div>
                </div>
            @else
                <div id="servicesGrid" class="row g-3">
                    @include('backend.service._table_rows', ['services' => $services])
                </div>
            @endif

        </div>
    </div>
</div>

@section('scripts')
<script>
// ===== STATUS TOGGLE (delegated so it survives AJAX re-renders) =====
document.addEventListener('click', function(e) {
    var badge = e.target.closest('.status-badge');
    if (!badge) return;
    e.preventDefault();
    var href = badge.getAttribute('href');
    var title = badge.dataset.title || 'this service';
    var current = badge.textContent.trim();
    var next = current === 'Active' ? 'Inactive' : 'Active';
    Swal.fire({
        title: 'Toggle Status?',
        text: 'Change "' + title + '" from ' + current + ' to ' + next + '?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#6366f1',
        cancelButtonColor: '#64748b',
        confirmButtonText: '<i class="bi bi-arrow-repeat me-1"></i> Toggle',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then(function(result) {
        if (result.isConfirmed) {
            window.location.href = href;
        }
    });
});

// ===== LIVE SEARCH (AJAX) =====
(function() {
    var searchInput = document.getElementById('liveSearch');
    var grid = document.getElementById('servicesGrid');
    var searchInfo = document.getElementById('searchInfo');
    var searchLoading = document.getElementById('searchLoading');

    if (!searchInput || !grid) return;

    var debounceTimer;

    function performSearch(query) {
        if (searchLoading) searchLoading.classList.remove('d-none');

        var url = '{{ route('admin.services.index') }}' + '?q=' + encodeURIComponent(query);

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(function(response) { return response.json(); })
        .then(function(data) {
            grid.innerHTML = data.html;

            var countBadge = document.getElementById('servicesCount');
            if (countBadge) {
                countBadge.innerHTML = '<i class="bi bi-database me-1"></i> ' + data.count + ' Services';
            }

            if (searchInfo) {
                if (query) {
                    searchInfo.innerHTML = '<small class="text-muted" style="font-size:0.72rem;"><i class="bi bi-info-circle me-1"></i>Showing results for "<strong>' + escapeHtml(query) + '</strong>" — ' + data.count + ' service(s) found</small>';
                } else {
                    searchInfo.innerHTML = '';
                }
            }
        })
        .catch(function(error) {
            console.error('Search error:', error);
        })
        .finally(function() {
            if (searchLoading) searchLoading.classList.add('d-none');
        });
    }

    searchInput.addEventListener('input', function() {
        var query = this.value.trim();
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function() {
            performSearch(query);
        }, 300);
    });

    function escapeHtml(text) {
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(text));
        return div.innerHTML;
    }
})();
</script>
@endsection

@endsection