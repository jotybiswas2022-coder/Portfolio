@extends('backend.app')

@section('content')
<style>
.gigs-page h4 { letter-spacing: -0.3px; }
.gigs-page .text-muted { color: var(--admin-text-muted) !important; }

/* ---- Grid ---- */
.gigs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 1.25rem;
}

/* ---- Clean card ---- */
.gig-card {
    background: var(--admin-card-bg);
    border: 1px solid var(--admin-border);
    border-radius: 16px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    box-shadow: 0 1px 2px rgba(15,23,42,0.04);
    transition: border-color 0.2s, box-shadow 0.2s, transform 0.2s;
}
.gig-card:hover {
    border-color: #c7d2fe;
    box-shadow: 0 10px 28px rgba(99,102,241,0.08);
    transform: translateY(-2px);
}
.min-w-0 { min-width: 0; }

.gig-card-top {
    display: flex;
    gap: 0.9rem;
    padding: 1rem 1.15rem 0.5rem;
    align-items: flex-start;
}
.gig-thumb {
    width: 48px; height: 48px;
    border-radius: 12px;
    object-fit: cover;
    flex-shrink: 0;
    background: #f1f5f9;
}
.gig-thumb-placeholder {
    width: 48px; height: 48px;
    border-radius: 12px;
    background: #eef2ff;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--admin-primary);
    font-size: 1.1rem;
    flex-shrink: 0;
}
.gig-card-info {
    flex: 1;
    min-width: 0;
}
.gig-title {
    font-size: 0.92rem;
    font-weight: 700;
    color: var(--admin-text);
    line-height: 1.35;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.gig-id { font-size: 0.72rem; color: var(--admin-text-muted); }
.order-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 0.72rem;
    font-weight: 600;
    color: var(--admin-text-muted);
    background: #f8fafc;
    border: 1px solid var(--admin-border);
    border-radius: 8px;
    padding: 4px 9px;
    flex-shrink: 0;
}
.gig-card-actions {
    display: flex;
    gap: 0.4rem;
    flex-shrink: 0;
    align-items: center;
}
.btn-icon {
    width: 32px; height: 32px;
    padding: 0;
    border-radius: 9px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 0.86rem;
    border: 1px solid var(--admin-border);
    background: #fff;
    color: var(--admin-text-muted);
    transition: all 0.2s;
    cursor: pointer;
    text-decoration: none;
}
.btn-icon:active { transform: scale(0.92); }
.btn-icon-edit:hover { color: var(--admin-primary); border-color: #c7d2fe; background: #eef2ff; }
.btn-icon-del:hover { color: #dc2626; border-color: #fecaca; background: #fef2f2; }

.gig-card-body {
    padding: 0.5rem 1.15rem 1rem;
}
.pricing-chips { display: flex; gap: 0.5rem; flex-wrap: wrap; }
.pricing-chip {
    flex: 1;
    min-width: 0;
    padding: 0.6rem 0.7rem;
    border-radius: 10px;
    text-align: center;
    border: 1px solid var(--admin-border);
    background: #f8fafc;
    transition: all 0.2s;
    cursor: default;
}
.pricing-chip:hover { border-color: #c7d2fe; background: #eef2ff; }
.pricing-chip .chip-name {
    font-size: 0.65rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    color: var(--admin-text-muted);
    margin-bottom: 0.15rem;
}
.pricing-chip .chip-price {
    font-size: 0.85rem;
    font-weight: 700;
    color: #059669;
}
.pricing-chip .chip-price.basic { color: #64748b; }
.pricing-chip .chip-price.standard { color: #6366f1; }
.pricing-chip .chip-price.premium { color: #d97706; }

.gig-card-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    margin-top: auto;
    padding: 0.7rem 1.15rem;
    border-top: 1px dashed var(--admin-border);
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 12px;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.2s;
    cursor: pointer;
}
.status-badge:hover { transform: scale(1.04); }
.status-dot { width: 7px; height: 7px; border-radius: 50%; background: currentColor; flex-shrink: 0; }
.status-active { background: rgba(16,185,129,0.1); color: #059669; border: 1px solid rgba(16,185,129,0.2); }
.status-inactive { background: #f1f5f9; color: #64748b; border: 1px solid var(--admin-border); }

/* ---- Sticky search ---- */
.gig-search-wrap {
    position: sticky;
    top: calc(var(--admin-topbar-height) + 6px);
    z-index: 1020;
}
.gig-search {
    border-radius: 999px;
    background: #fff;
    border: 1px solid var(--admin-border);
    box-shadow: 0 4px 18px rgba(15,23,42,0.06);
    padding: 0.45rem 0.6rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.gig-search:focus-within {
    border-color: var(--admin-primary);
    box-shadow: 0 0 0 4px rgba(99,102,241,0.1), 0 4px 18px rgba(15,23,42,0.06);
}
.gig-search i { color: var(--admin-text-muted); }
.gig-search input {
    flex: 1;
    border: none;
    outline: none;
    background: transparent;
    font-size: 0.85rem;
    color: var(--admin-text);
    padding: 0.15rem 0;
    min-width: 0;
}
.gig-search input::placeholder { color: #94a3b8; }

/* ---- Mobile floating Add button ---- */
.gig-fab {
    position: fixed;
    right: 1.1rem;
    bottom: 1.1rem;
    z-index: 1051;
    width: 54px; height: 54px;
    border-radius: 50%;
    display: none;
    align-items: center;
    justify-content: center;
    font-size: 1.35rem;
    color: #fff;
    background: linear-gradient(135deg, var(--admin-primary), var(--admin-primary-dark));
    border: none;
    box-shadow: 0 10px 26px rgba(99,102,241,0.45);
    text-decoration: none;
    transition: transform 0.2s;
}
.gig-fab:active { transform: scale(0.92); }

.empty-state {
    background: #fff;
    border: 1px solid var(--admin-border);
    border-radius: 20px;
    padding: 3rem 2rem;
    text-align: center;
}

@media (max-width: 575.98px) {
    .gig-fab { display: flex; }
    .gig-add-desktop { display: none !important; }
    .gigs-grid { grid-template-columns: 1fr; gap: 0.9rem; }
    .gig-card { border-radius: 14px; }
    .gig-card-top { padding: 1rem 1rem 0.5rem; }
    .gig-card-body { padding: 0.4rem 1rem 0.9rem; }
    .gig-card-footer { padding: 0.65rem 1rem; }
    .gig-thumb, .gig-thumb-placeholder { width: 44px; height: 44px; }
    .gig-title { font-size: 0.85rem; }
    .btn-icon { width: 34px; height: 34px; font-size: 0.9rem; }
    .pricing-chips { flex-direction: column; }
    .gig-search-wrap { top: 60px; }
}
</style>

<div class="container-fluid py-3 gigs-page">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-11 col-xxl-10">

            {{-- Header --}}
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                <div>
                    <h4 class="fw-bold mb-1"><i class="bi bi-music-note-list me-2" style="color:var(--admin-primary);"></i>Gigs</h4>
                    <p class="text-muted small mb-0">Manage your service packages</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge-count" id="countBadge">
                        <i class="bi bi-database me-1"></i> {{ $gigs->count() }} Gigs
                    </span>
                    <a href="{{ route('admin.gigs.create') }}" class="btn btn-admin btn-admin-primary gig-add-desktop">
                        <i class="bi bi-plus-lg me-1"></i> Add Gig
                    </a>
                </div>
            </div>

            {{-- Live Search (sticky on scroll) --}}
            <div class="gig-search-wrap mb-3">
                <div class="gig-search">
                    <i class="bi bi-search" style="font-size:0.9rem;"></i>
                    <input type="text" id="liveSearch" name="q" value="{{ $query ?? '' }}"
                           placeholder="Search gigs by title..."
                           autocomplete="off">
                    <span class="d-flex align-items-center">
                        <span class="spinner-border spinner-border-sm d-none text-primary" role="status" id="searchLoading"></span>
                        @if(request()->has('q') && request()->q != '')
                            <a href="{{ route('admin.gigs.index') }}" class="text-muted text-decoration-none ms-2"><i class="bi bi-x-lg"></i></a>
                        @endif
                    </span>
                </div>
                <div class="mt-2" id="searchInfo">
                    @if($query ?? false)
                        <small class="text-muted" style="font-size:0.75rem;">
                            <i class="bi bi-info-circle me-1"></i>
                            Showing results for "<strong>{{ $query }}</strong>" —
                            <span id="resultCount">{{ $gigs->count() }}</span> gig(s) found
                        </small>
                    @endif
                </div>
            </div>

            {{-- Cards Grid --}}
            @if($gigs->isEmpty() && !request()->ajax())
                <div class="text-center py-5">
                    <div class="empty-state">
                        <div style="width:80px;height:80px;border-radius:20px;background:rgba(99,102,241,0.08);display:flex;align-items:center;justify-content:center;margin:0 auto 1.5rem;">
                            <i class="bi bi-music-note-list" style="font-size:2.2rem;color:#6366f1;"></i>
                        </div>
                        <div class="fw-semibold fs-5 mb-2" style="color:var(--admin-text);">No Gigs Found</div>
                        <p class="text-muted mb-0" style="max-width:400px;margin:0 auto 1.5rem;">Add your service packages to showcase what you offer!</p>
                        <a href="{{ route('admin.gigs.create') }}" class="btn btn-admin btn-admin-primary mt-2">
                            <i class="bi bi-plus-lg me-1"></i> Add Gig
                        </a>
                    </div>
                </div>
            @else
                <div class="gigs-grid" id="gigsGrid">
                    @include('backend.gig._table_rows', ['gigs' => $gigs])
                </div>
            @endif

        </div>
    </div>
</div>

{{-- Mobile Floating Add Button --}}
<a href="{{ route('admin.gigs.create') }}" class="gig-fab" aria-label="Add Gig">
    <i class="bi bi-plus-lg"></i>
</a>

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
    var title = badge.dataset.title || 'this gig';
    var currentLabel = badge.textContent.trim();
    var next = currentLabel === 'Active' ? 'Inactive' : 'Active';
    Swal.fire({
        title: 'Toggle Status?',
        text: 'Change "' + title + '" from ' + currentLabel + ' to ' + next + '?',
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
    var grid = document.getElementById('gigsGrid');
    var searchInfo = document.getElementById('searchInfo');
    var searchLoading = document.getElementById('searchLoading');

    if (!searchInput || !grid) return;

    var debounceTimer;

    function performSearch(query) {
        if (searchLoading) searchLoading.classList.remove('d-none');

        var url = '{{ route('admin.gigs.index') }}' + '?q=' + encodeURIComponent(query);

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(function(response) { return response.json(); })
        .then(function(data) {
            grid.innerHTML = data.html;

            var countBadge = document.getElementById('countBadge');
            if (countBadge) {
                countBadge.innerHTML = '<i class="bi bi-database me-1"></i> ' + data.count + ' Gigs';
            }

            if (searchInfo) {
                if (query) {
                    searchInfo.innerHTML = '<small class="text-muted" style="font-size:0.75rem;"><i class="bi bi-info-circle me-1"></i>Showing results for "<strong>' + escapeHtml(query) + '</strong>" — ' + data.count + ' gig(s) found</small>';
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