@extends('backend.app')

@section('content')
<style>
.proj-card {
    background: var(--admin-card-bg);
    border-radius: var(--admin-radius);
    padding: 1.1rem;
    display: flex;
    flex-direction: column;
    gap: 0.6rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
    transition: all 0.25s cubic-bezier(0.16,1,0.3,1);
    height: 100%;
    border: 1px solid var(--admin-border);
}
.proj-card:hover {
    box-shadow: 0 10px 30px rgba(99,102,241,0.12);
    transform: translateY(-3px);
    border-color: rgba(99,102,241,0.2);
}
.proj-thumb {
    width: 56px;
    height: 56px;
    min-width: 56px;
    border-radius: 10px;
    overflow: hidden;
    background: rgba(99,102,241,0.06);
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid var(--admin-border);
}
.proj-thumb img { width: 100%; height: 100%; object-fit: cover; }
.proj-thumb i { font-size: 1.4rem; color: var(--admin-text-muted); }
.proj-title {
    font-weight: 700;
    font-size: 0.88rem;
    color: var(--admin-text);
    line-height: 1.3;
    margin-bottom: 2px;
}
.proj-cat {
    font-size: 0.72rem;
    color: var(--admin-text-muted);
    font-weight: 500;
}
.proj-cat i { color: var(--admin-primary); }
.tech-tag {
    display: inline-flex;
    align-items: center;
    padding: 2px 8px;
    background: rgba(99,102,241,0.06);
    border: 1px solid rgba(99,102,241,0.15);
    border-radius: 12px;
    font-size: 0.65rem;
    font-weight: 600;
    color: var(--admin-primary);
    white-space: nowrap;
    line-height: 1.6;
}
.tech-tag i { font-size: 0.6rem; }
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 0.68rem;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s;
}
.status-active {
    background: rgba(16,185,129,0.1);
    color: #059669;
    border: 1px solid rgba(16,185,129,0.2);
}
.status-active:hover { background: rgba(16,185,129,0.18); transform: scale(1.05); }
.status-inactive {
    background: rgba(148,163,184,0.1);
    color: #64748b;
    border: 1px solid rgba(148,163,184,0.2);
}
.status-inactive:hover { background: rgba(148,163,184,0.18); transform: scale(1.05); }
.order-badge {
    display: inline-flex;
    align-items: center;
    gap: 3px;
    padding: 3px 8px;
    background: #f1f5f9;
    border: 1px solid var(--admin-border);
    border-radius: 6px;
    font-size: 0.66rem;
    font-weight: 600;
    color: var(--admin-text-muted);
}
.btn-icon {
    width: 30px;
    height: 30px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    border: 1px solid var(--admin-border);
    background: #fff;
    color: var(--admin-text-muted);
    font-size: 0.78rem;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
}
.btn-icon-edit:hover {
    background: rgba(99,102,241,0.1);
    color: var(--admin-primary);
    border-color: rgba(99,102,241,0.3);
}
.btn-icon-del:hover {
    background: rgba(239,68,68,0.1);
    color: #ef4444;
    border-color: rgba(239,68,68,0.3);
}
@media (max-width: 767.98px) {
    .proj-thumb { width: 44px; height: 44px; min-width: 44px; }
    .proj-title { font-size: 0.8rem; }
    .btn-icon { width: 26px; height: 26px; font-size: 0.7rem; }
    .tech-tag { font-size: 0.6rem; padding: 1px 6px; }
}
</style>

<div class="container-fluid py-3">

    {{-- Header --}}
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 gap-3">
        <div>
            <h4 class="fw-bold mb-1"><i class="bi bi-folder2-open me-2" style="color:var(--admin-primary);"></i>Projects</h4>
            <p class="text-muted small mb-0">Manage your portfolio projects</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge-count">
                <i class="bi bi-database me-1"></i> {{ $projects->count() }} Projects
            </span>
            <a href="{{ route('admin.projects.create') }}" class="btn btn-admin btn-admin-primary">
                <i class="bi bi-plus-lg me-1"></i> Add Project
            </a>
        </div>
    </div>

    {{-- Live Search --}}
    <div class="mb-4">
        <div class="d-flex gap-2 align-items-center">
            <div class="input-group" style="max-width:560px;">
                <span class="input-group-text bg-white border-end-0 rounded-start-3" style="border-color:var(--admin-border); border-right:none;">
                    <i class="bi bi-search text-muted"></i>
                </span>
                <input type="text" id="liveSearch" name="q" value="{{ $query ?? '' }}"
                       class="form-control border-start-0 ps-0 rounded-end-3"
                       placeholder="Search by title, category or tech..."
                       style="border-color:var(--admin-border); box-shadow:none;"
                       autocomplete="off">
                <span class="input-group-text bg-white border-start-0 rounded-end-3" style="border-color:var(--admin-border);">
                    <span class="spinner-border spinner-border-sm d-none" role="status" id="searchLoading"></span>
                </span>
            </div>
            @if(request()->has('q') && request()->q != '')
                <a href="{{ route('admin.projects.index') }}" class="btn btn-admin btn-admin-outline" style="font-size:0.78rem;">
                    <i class="bi bi-x-lg"></i>
                </a>
            @endif
        </div>
        <div class="mt-2" id="searchInfo">
            @if($query ?? false)
                <small class="text-muted">
                    <i class="bi bi-info-circle me-1"></i>
                    Showing results for "<strong>{{ $query }}</strong>" —
                    <span id="resultCount">{{ $projects->count() }}</span> project(s) found
                </small>
            @endif
        </div>
    </div>

    {{-- Cards Grid --}}
    @if($projects->isEmpty())
        <div class="text-center py-5">
            <div class="empty-state">
                <i class="bi bi-folder-plus"></i>
                <div class="fw-semibold mb-2">No Projects Found</div>
                <p class="text-muted small">Start by adding your first project!</p>
                <a href="{{ route('admin.projects.create') }}" class="btn btn-admin btn-admin-primary mt-2">
                    <i class="bi bi-plus-lg me-1"></i> Add Project
                </a>
            </div>
        </div>
    @else
        <div class="row g-3" id="projectsGrid">
            @include('backend.project._table_rows', ['projects' => $projects])
        </div>
    @endif

</div>

@section('scripts')
<script>
// ===== STATUS TOGGLE CONFIRMATION (event delegation - works for AJAX rows too) =====
(function() {
    document.addEventListener('click', function(e) {
        var badge = e.target.closest('.status-badge');
        if (!badge) return;
        e.preventDefault();
        var href = badge.getAttribute('href');
        var title = badge.dataset.title;
        var current = badge.textContent.trim().replace(/\s+/g, ' ');
        var next = current.indexOf('Active') !== -1 ? 'Inactive' : 'Active';
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
})();

// ===== LIVE SEARCH (AJAX) =====
(function() {
    var searchInput = document.getElementById('liveSearch');
    var grid = document.getElementById('projectsGrid');
    var searchInfo = document.getElementById('searchInfo');
    var searchLoading = document.getElementById('searchLoading');

    if (!searchInput || !grid) return;

    var debounceTimer;

    function performSearch(query) {
        if (searchLoading) searchLoading.classList.remove('d-none');

        var url = '{{ route('admin.projects.index') }}' + '?q=' + encodeURIComponent(query);

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(function(response) { return response.json(); })
        .then(function(data) {
            grid.innerHTML = data.html;

            var countBadge = document.querySelector('.badge-count');
            if (countBadge) {
                countBadge.innerHTML = '<i class="bi bi-database me-1"></i> ' + data.count + ' Projects';
            }

            if (searchInfo) {
                if (query) {
                    searchInfo.innerHTML = '<small class="text-muted"><i class="bi bi-info-circle me-1"></i>Showing results for "<strong>' + escapeHtml(query) + '</strong>" — ' + data.count + ' project(s) found</small>';
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
