@extends('backend.app')

@section('content')
<style>
.edu-card {
    background: var(--admin-card-bg);
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius);
    padding: 1rem;
    height: 100%;
    box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
    transition: all 0.25s cubic-bezier(0.16,1,0.3,1);
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}
.edu-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(99,102,241,0.12);
    border-color: rgba(99,102,241,0.2);
}
.edu-card .degree-tile {
    width: 42px; height: 42px;
    border-radius: 10px;
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    color: #fff;
    font-size: 1rem;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.edu-card .edu-degree {
    font-size: 0.85rem;
    font-weight: 700;
    color: var(--admin-text);
    line-height: 1.3;
    margin: 0;
}
.edu-card .edu-institution {
    font-size: 0.72rem;
    color: var(--admin-primary);
    font-weight: 500;
    margin: 0;
}
.edu-card .edu-institution .text-muted { color: var(--admin-text-muted) !important; }
.edu-card .edu-meta {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 0.72rem;
    color: var(--admin-text-muted);
    font-weight: 500;
}
.edu-card .edu-meta i { color: var(--admin-primary); font-size: 0.82rem; }
.edu-card .edu-result {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 0.68rem;
    color: #059669;
    background: rgba(16,185,129,0.1);
    border: 1px solid rgba(16,185,129,0.18);
    border-radius: 20px;
    padding: 3px 10px;
    font-weight: 600;
    white-space: nowrap;
}
.order-badge {
    display: inline-flex;
    align-items: center;
    gap: 3px;
    font-size: 0.66rem;
    font-weight: 600;
    color: var(--admin-text-muted);
    background: #f1f5f9;
    border: 1px solid var(--admin-border);
    border-radius: 8px;
    padding: 3px 8px;
    flex-shrink: 0;
}
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.2s;
    cursor: pointer;
}
.status-active { background: rgba(16,185,129,0.1); color: #059669; border: 1px solid rgba(16,185,129,0.2); }
.status-active:hover { background: rgba(16,185,129,0.18); transform: scale(1.05); }
.status-inactive { background: rgba(148,163,184,0.1); color: #64748b; border: 1px solid rgba(148,163,184,0.2); }
.status-inactive:hover { background: rgba(148,163,184,0.18); transform: scale(1.05); }
.btn-icon {
    width: 30px; height: 30px;
    padding: 0;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 0.82rem;
    border: 1px solid var(--admin-border);
    background: #fff;
    color: var(--admin-text-muted);
    transition: all 0.2s;
    cursor: pointer;
    text-decoration: none;
}
.btn-icon-edit:hover { color: var(--admin-primary); border-color: #c7d2fe; background: #eef2ff; }
.btn-icon-del:hover { color: #dc2626; border-color: #fecaca; background: #fef2f2; }

/* Mobile: clean compact card */
@media (max-width: 575.98px) {
    .edu-card { padding: 0.8rem; gap: 0.6rem; border-radius: 14px; }
    .edu-card .degree-tile { width: 36px; height: 36px; font-size: 0.9rem; border-radius: 9px; }
    .edu-card .edu-degree { font-size: 0.8rem; }
    .edu-card .edu-institution { font-size: 0.68rem; }
    .edu-card .edu-meta { font-size: 0.68rem; }
    .edu-card .edu-result { font-size: 0.64rem; padding: 2px 8px; }
    .order-badge { font-size: 0.62rem; padding: 2px 7px; }
    .status-badge { font-size: 0.66rem; padding: 3px 9px; }
    .btn-icon { width: 28px; height: 28px; font-size: 0.76rem; }
    .mobile-stack { gap: 0.5rem !important; }
}
</style>

<div class="container-fluid py-3">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-11 col-xxl-10">

            {{-- Header --}}
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                <div>
                    <h4 class="fw-bold mb-1"><i class="bi bi-mortarboard me-2" style="color:var(--admin-primary);"></i>Education</h4>
                    <p class="text-muted small mb-0">Manage your academic qualifications</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge-count" id="educationsCount">
                        <i class="bi bi-database me-1"></i> {{ $educations->count() }} Qualifications
                    </span>
                    <a href="{{ route('admin.education.create') }}" class="btn btn-admin btn-admin-primary">
                        <i class="bi bi-plus-lg me-1"></i> Add Qualification
                    </a>
                </div>
            </div>

            {{-- Live Search --}}
            <div class="mb-3">
                <div class="input-group" style="max-width:440px;">
                    <span class="input-group-text bg-white border-end-0 rounded-start-3" style="border-color:var(--admin-border); font-size:0.8rem;">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" id="liveSearch" name="q" value="{{ $query ?? '' }}"
                           class="form-control border-start-0 ps-2" style="border-color:var(--admin-border); box-shadow:none; font-size:0.8rem; padding:7px 10px;"
                           placeholder="Search by degree or institution..."
                           autocomplete="off">
                    <span class="input-group-text bg-white border-start-0 rounded-end-3" style="border-color:var(--admin-border); font-size:0.8rem;">
                        <span class="spinner-border spinner-border-sm d-none text-primary" role="status" id="searchLoading"></span>
                        @if(request()->has('q') && request()->q != '')
                            <a href="{{ route('admin.education.index') }}" class="text-muted text-decoration-none"><i class="bi bi-x-lg"></i></a>
                        @endif
                    </span>
                </div>
                <div class="mt-2" id="searchInfo">
                    @if($query ?? false)
                        <small class="text-muted" style="font-size:0.72rem;">
                            <i class="bi bi-info-circle me-1"></i>
                            Showing results for "<strong>{{ $query }}</strong>" —
                            <span id="resultCount">{{ $educations->count() }}</span> qualification(s) found
                        </small>
                    @endif
                </div>
            </div>

            {{-- Qualifications Grid --}}
            @if($educations->isEmpty() && !request()->ajax())
                <div class="text-center py-5">
                    <div class="empty-state">
                        <i class="bi bi-mortarboard"></i>
                        <div class="fw-semibold mb-2">No Qualifications Found</div>
                        <p class="text-muted small">Showcase your academic background to build credibility!</p>
                        <a href="{{ route('admin.education.create') }}" class="btn btn-admin btn-admin-primary mt-2">
                            <i class="bi bi-plus-lg me-1"></i> Add Qualification
                        </a>
                    </div>
                </div>
            @else
                <div id="educationsGrid" class="row g-3">
                    @include('backend.education._table_rows', ['educations' => $educations])
                </div>
            @endif

        </div>
    </div>
</div>

@section('scripts')
<script>
@if(session('success'))
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: {!! json_encode(session('success')) !!},
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3500,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
    }
});
@endif

// ===== STATUS TOGGLE (delegated so it survives AJAX re-renders) =====
document.addEventListener('click', function(e) {
    var badge = e.target.closest('.status-badge');
    if (!badge) return;
    e.preventDefault();
    var href = badge.getAttribute('href');
    var title = badge.dataset.title || 'this qualification';
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
    var grid = document.getElementById('educationsGrid');
    var searchInfo = document.getElementById('searchInfo');
    var searchLoading = document.getElementById('searchLoading');

    if (!searchInput || !grid) return;

    var debounceTimer;

    function performSearch(query) {
        if (searchLoading) searchLoading.classList.remove('d-none');

        var url = '{{ route('admin.education.index') }}' + '?q=' + encodeURIComponent(query);

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(function(response) { return response.json(); })
        .then(function(data) {
            grid.innerHTML = data.html;

            var countBadge = document.getElementById('educationsCount');
            if (countBadge) {
                countBadge.innerHTML = '<i class="bi bi-database me-1"></i> ' + data.count + ' Qualifications';
            }

            if (searchInfo) {
                if (query) {
                    searchInfo.innerHTML = '<small class="text-muted" style="font-size:0.72rem;"><i class="bi bi-info-circle me-1"></i>Showing results for "<strong>' + escapeHtml(query) + '</strong>" — ' + data.count + ' qualification(s) found</small>';
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