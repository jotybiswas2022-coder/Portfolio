@extends('backend.app')

@section('content')
<style>
.cs-admin { font-size: 0.88rem; }
.cs-admin .status-badge {
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
.cs-admin .status-badge::before {
    content: '';
    width: 6px; height: 6px;
    border-radius: 50%;
    background: currentColor;
}
.cs-admin .status-badge:hover { transform: scale(1.05); }
.cs-admin .active-badge { background: rgba(16,185,129,0.12); color: #059669; }
.cs-admin .inactive-badge { background: #f1f5f9; color: #94a3b8; }

.cs-card {
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
.cs-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(99,102,241,0.08);
    border-color: #e0e7ff;
}
.cs-card .cs-thumb {
    width: 74px; height: 56px;
    border-radius: 10px;
    object-fit: cover;
    flex-shrink: 0;
    border: 1px solid #eef0f4;
}
.cs-card .cs-thumb-placeholder {
    width: 74px; height: 56px;
    border-radius: 10px;
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    color: #fff;
    font-size: 1.2rem;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.cs-card .order-badge {
    font-size: 0.68rem;
    font-weight: 600;
    color: #64748b;
    background: #f1f5f9;
    border-radius: 8px;
    padding: 3px 8px;
    flex-shrink: 0;
}
.cs-card .cs-title {
    font-size: 0.9rem;
    font-weight: 600;
    color: #1e293b;
    line-height: 1.3;
    margin: 0;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.cs-card .cs-client {
    font-size: 0.72rem;
    color: #64748b;
    font-weight: 500;
}
.cs-card .cs-client i { color: #6366f1; font-size: 0.78rem; }
.cs-card .cat-badge {
    font-size: 0.68rem;
    font-weight: 600;
    color: #6366f1;
    background: rgba(99,102,241,0.1);
    border-radius: 20px;
    padding: 2px 10px;
}
.cs-card .tech-badge {
    font-size: 0.66rem;
    font-weight: 500;
    color: #475569;
    background: #f1f5f9;
    border-radius: 20px;
    padding: 2px 9px;
}
.cs-card .sv-actions .btn-icon {
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
.cs-card .sv-actions .btn-icon-edit:hover {
    color: #6366f1;
    border-color: #c7d2fe;
    background: #eef2ff;
}
.cs-card .sv-actions .btn-icon-del:hover {
    color: #dc2626;
    border-color: #fecaca;
    background: #fef2f2;
}

@media (max-width: 767.98px) {
    .cs-admin { font-size: 0.8rem; }
    .cs-card { padding: 12px; border-radius: 12px; gap: 10px; }
    .cs-card .cs-thumb,
    .cs-card .cs-thumb-placeholder { width: 60px; height: 46px; font-size: 1rem; }
    .cs-card .cs-title { font-size: 0.84rem; }
    .cs-card .cs-client { font-size: 0.7rem; }
    .cs-card .status-badge { font-size: 0.66rem; padding: 3px 9px; }
    .cs-card .sv-actions .btn-icon { width: 26px; height: 26px; font-size: 0.75rem; }
}
</style>

<div class="container-fluid py-3 cs-admin">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-11 col-xxl-10">

            {{-- Header --}}
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                <div>
                    <h5 class="fw-bold mb-1" style="font-size:0.95rem;">
                        <i class="bi bi-journal-code me-2" style="color:#6366f1;"></i>Case Studies
                    </h5>
                    <p class="text-muted mb-0" style="font-size:0.74rem;">Manage IT project case studies (Problem → Solution → Result)</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge rounded-pill px-3 py-2" id="caseStudiesCount" style="background:rgba(99,102,241,0.1); color:#6366f1; font-weight:500; font-size:0.72rem;">
                        <i class="bi bi-database me-1"></i> {{ $caseStudies->count() }} Total
                    </span>
                    <a href="{{ route('admin.casestudies.create') }}" class="btn btn-admin btn-admin-primary" style="font-size:0.78rem; padding:6px 16px;">
                        <i class="bi bi-plus-lg me-1"></i> Add New
                    </a>
                </div>
            </div>

            {{-- Live Search --}}
            <div class="mb-3">
                <div class="input-group" style="max-width:440px;">
                    <span class="input-group-text bg-white border-end-0 rounded-start-3" style="border-color:#e2e8f0; font-size:0.8rem;">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" id="liveSearch" name="q" value="{{ $query ?? '' }}"
                           class="form-control border-start-0 ps-2" style="border-color:#e2e8f0; box-shadow:none; font-size:0.8rem; padding:7px 10px;"
                           placeholder="Search by title, client or category..."
                           autocomplete="off">
                    <span class="input-group-text bg-white border-start-0 rounded-end-3" style="border-color:#e2e8f0; font-size:0.8rem;">
                        <span class="spinner-border spinner-border-sm d-none text-primary" role="status" id="searchLoading"></span>
                        @if(request()->has('q') && request()->q != '')
                            <a href="{{ route('admin.casestudies.index') }}" class="text-muted text-decoration-none"><i class="bi bi-x-lg"></i></a>
                        @endif
                    </span>
                </div>
                <div class="mt-2" id="searchInfo">
                    @if($query ?? false)
                        <small class="text-muted" style="font-size:0.72rem;">
                            <i class="bi bi-info-circle me-1"></i>
                            Showing results for "<strong>{{ $query }}</strong>" —
                            <span id="resultCount">{{ $caseStudies->count() }}</span> case study(ies) found
                        </small>
                    @endif
                </div>
            </div>

            {{-- Case Studies Grid --}}
            @if($caseStudies->isEmpty() && !request()->ajax())
                <div class="text-center py-5">
                    <div class="empty-state">
                        <i class="bi bi-journal-code"></i>
                        <div class="fw-semibold mb-2">No Case Studies Found</div>
                        <p class="text-muted" style="font-size:0.78rem;">Start by adding your first IT case study!</p>
                        <a href="{{ route('admin.casestudies.create') }}" class="btn btn-admin btn-admin-primary" style="font-size:0.78rem;">
                            <i class="bi bi-plus-lg me-1"></i> Add Case Study
                        </a>
                    </div>
                </div>
            @else
                <div id="caseStudiesGrid" class="row g-3">
                    @include('backend.casestudy._table_rows', ['caseStudies' => $caseStudies])
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
    var title = badge.dataset.title || 'this case study';
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
    var grid = document.getElementById('caseStudiesGrid');
    var searchInfo = document.getElementById('searchInfo');
    var searchLoading = document.getElementById('searchLoading');

    if (!searchInput || !grid) return;

    var debounceTimer;

    function performSearch(query) {
        if (searchLoading) searchLoading.classList.remove('d-none');

        var url = '{{ route('admin.casestudies.index') }}' + '?q=' + encodeURIComponent(query);

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(function(response) { return response.json(); })
        .then(function(data) {
            grid.innerHTML = data.html;

            var countBadge = document.getElementById('caseStudiesCount');
            if (countBadge) {
                countBadge.innerHTML = '<i class="bi bi-database me-1"></i> ' + data.count + ' Total';
            }

            if (searchInfo) {
                if (query) {
                    searchInfo.innerHTML = '<small class="text-muted" style="font-size:0.72rem;"><i class="bi bi-info-circle me-1"></i>Showing results for "<strong>' + escapeHtml(query) + '</strong>" — ' + data.count + ' case study(ies) found</small>';
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