@extends('backend.app')

@section('content')
<style>
.faqs-page h4 { letter-spacing: -0.3px; }
.faqs-page .text-muted { color: var(--admin-text-muted) !important; }

/* ---- Clean card list ---- */
.faq-card {
    background: var(--admin-card-bg);
    border: 1px solid var(--admin-border);
    border-radius: 16px;
    padding: 1.15rem 1.2rem;
    height: 100%;
    display: flex;
    flex-direction: column;
    gap: 0.9rem;
    box-shadow: 0 1px 2px rgba(15,23,42,0.04);
    transition: border-color 0.2s, box-shadow 0.2s, transform 0.2s;
}
.faq-card:hover {
    border-color: #c7d2fe;
    box-shadow: 0 10px 28px rgba(99,102,241,0.08);
    transform: translateY(-2px);
}
.min-w-0 { min-width: 0; }
.faq-icon {
    width: 44px; height: 44px;
    min-width: 44px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    background: #eef2ff;
    color: var(--admin-primary);
    font-size: 1.15rem;
    border: 1px solid rgba(99,102,241,0.15);
}
.faq-q {
    font-weight: 700;
    font-size: 0.92rem;
    color: var(--admin-text);
    line-height: 1.4;
    margin-bottom: 2px;
}
.faq-a {
    font-size: 0.78rem;
    color: var(--admin-text-muted);
    line-height: 1.6;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    border-top: 1px dashed var(--admin-border);
    padding-top: 0.75rem;
}
.faq-a i { font-size: 0.7rem; color: var(--admin-primary); }
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
.faq-actions {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: auto;
    padding-top: 0.85rem;
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

/* ---- Sticky search ---- */
.faq-search-wrap {
    position: sticky;
    top: calc(var(--admin-topbar-height) + 6px);
    z-index: 1020;
}
.faq-search {
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
.faq-search:focus-within {
    border-color: var(--admin-primary);
    box-shadow: 0 0 0 4px rgba(99,102,241,0.1), 0 4px 18px rgba(15,23,42,0.06);
}
.faq-search i { color: var(--admin-text-muted); }
.faq-search input {
    flex: 1;
    border: none;
    outline: none;
    background: transparent;
    font-size: 0.85rem;
    color: var(--admin-text);
    padding: 0.15rem 0;
    min-width: 0;
}
.faq-search input::placeholder { color: #94a3b8; }

/* ---- Mobile floating Add button ---- */
.faq-fab {
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
.faq-fab:active { transform: scale(0.92); }
@media (max-width: 575.98px) {
    .faq-fab { display: flex; }
    .faq-add-desktop { display: none !important; }
    .faq-card { padding: 1rem 1.05rem; border-radius: 14px; gap: 0.8rem; }
    .faq-icon { width: 40px; height: 40px; min-width: 40px; font-size: 1rem; border-radius: 10px; }
    .faq-q { font-size: 0.85rem; }
    .faq-a { font-size: 0.73rem; }
    .order-badge { font-size: 0.68rem; padding: 3px 8px; }
    .btn-icon { width: 34px; height: 34px; font-size: 0.9rem; }
    .faq-search-wrap { top: 60px; }
}
</style>

<div class="container-fluid py-3 faqs-page">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-11 col-xxl-10">

            {{-- Header --}}
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                <div>
                    <h4 class="fw-bold mb-1"><i class="bi bi-question-circle me-2" style="color:var(--admin-primary);"></i>FAQs</h4>
                    <p class="text-muted small mb-0">Manage frequently asked questions</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge-count" id="countBadge">
                        <i class="bi bi-database me-1"></i> {{ $faqs->count() }} FAQs
                    </span>
                    <a href="{{ route('admin.faqs.create') }}" class="btn btn-admin btn-admin-primary faq-add-desktop">
                        <i class="bi bi-plus-lg me-1"></i> Add FAQ
                    </a>
                </div>
            </div>

            {{-- Live Search (sticky on scroll) --}}
            <div class="faq-search-wrap mb-3">
                <div class="faq-search">
                    <i class="bi bi-search" style="font-size:0.9rem;"></i>
                    <input type="text" id="liveSearch" name="q" value="{{ $query ?? '' }}"
                           placeholder="Search by question or answer..."
                           autocomplete="off">
                    <span class="d-flex align-items-center">
                        <span class="spinner-border spinner-border-sm d-none text-primary" role="status" id="searchLoading"></span>
                        @if(request()->has('q') && request()->q != '')
                            <a href="{{ route('admin.faqs.index') }}" class="text-muted text-decoration-none ms-2"><i class="bi bi-x-lg"></i></a>
                        @endif
                    </span>
                </div>
                <div class="mt-2" id="searchInfo">
                    @if($query ?? false)
                        <small class="text-muted" style="font-size:0.75rem;">
                            <i class="bi bi-info-circle me-1"></i>
                            Showing results for "<strong>{{ $query }}</strong>" —
                            <span id="resultCount">{{ $faqs->count() }}</span> FAQ(s) found
                        </small>
                    @endif
                </div>
            </div>

            {{-- Cards Grid --}}
            @if($faqs->isEmpty() && !request()->ajax())
                <div class="text-center py-5">
                    <div class="empty-state">
                        <i class="bi bi-question-circle"></i>
                        <div class="fw-semibold mb-2">No FAQs Found</div>
                        <p class="text-muted small mb-0">Start by adding your first frequently asked question!</p>
                        <a href="{{ route('admin.faqs.create') }}" class="btn btn-admin btn-admin-primary mt-3">
                            <i class="bi bi-plus-lg me-1"></i> Add FAQ
                        </a>
                    </div>
                </div>
            @else
                <div id="faqsGrid" class="row g-3">
                    @include('backend.faq._table_rows', ['faqs' => $faqs])
                </div>
            @endif

        </div>
    </div>
</div>

{{-- Mobile Floating Add Button --}}
<a href="{{ route('admin.faqs.create') }}" class="faq-fab" aria-label="Add FAQ">
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
    var title = badge.dataset.title || 'this FAQ';
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

// ===== DELETE CONFIRMATION (delegated) =====
document.addEventListener('click', function(e) {
    var btn = e.target.closest('.delete-btn');
    if (!btn) return;
    var id = btn.dataset.id;
    var title = btn.dataset.title || 'this FAQ';
    Swal.fire({
        title: 'Delete FAQ?',
        text: 'Are you sure you want to delete "' + title + '"?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#64748b',
        confirmButtonText: '<i class="bi bi-trash me-1"></i> Delete',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then(function(result) {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
});

// ===== LIVE SEARCH (AJAX) =====
(function() {
    var searchInput = document.getElementById('liveSearch');
    var grid = document.getElementById('faqsGrid');
    var searchInfo = document.getElementById('searchInfo');
    var searchLoading = document.getElementById('searchLoading');

    if (!searchInput || !grid) return;

    var debounceTimer;

    function performSearch(query) {
        if (searchLoading) searchLoading.classList.remove('d-none');

        var url = '{{ route('admin.faqs.index') }}' + '?q=' + encodeURIComponent(query);

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
                countBadge.innerHTML = '<i class="bi bi-database me-1"></i> ' + data.count + ' FAQs';
            }

            if (searchInfo) {
                if (query) {
                    searchInfo.innerHTML = '<small class="text-muted" style="font-size:0.75rem;"><i class="bi bi-info-circle me-1"></i>Showing results for "<strong>' + escapeHtml(query) + '</strong>" — ' + data.count + ' FAQ(s) found</small>';
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