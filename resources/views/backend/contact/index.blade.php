@extends('backend.app')

@section('content')
<style>
.contact-page h4 { letter-spacing: -0.3px; }
.contact-page .text-muted { color: var(--admin-text-muted) !important; }

/* ---- Clean card list ---- */
.ct-card {
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
.ct-card:hover {
    border-color: #c7d2fe;
    box-shadow: 0 10px 28px rgba(99,102,241,0.08);
    transform: translateY(-2px);
}
.min-w-0 { min-width: 0; }
.ct-avatar {
    width: 46px; height: 46px;
    min-width: 46px;
    border-radius: 14px;
    flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg,#6366f1,#8b5cf6);
    color: #fff;
    font-weight: 700;
    font-size: 1rem;
    border: 2px solid rgba(99,102,241,0.18);
}
.ct-name {
    font-weight: 700;
    font-size: 0.92rem;
    color: var(--admin-text);
    line-height: 1.35;
    margin-bottom: 1px;
}
.ct-email {
    font-size: 0.75rem;
    color: var(--admin-primary);
    text-decoration: none;
    line-height: 1.4;
}
.ct-email:hover { text-decoration: underline; }
.ct-date {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 0.7rem;
    font-weight: 600;
    color: var(--admin-text-muted);
    background: #f8fafc;
    border: 1px solid var(--admin-border);
    border-radius: 8px;
    padding: 4px 9px;
    flex-shrink: 0;
    white-space: nowrap;
}
.ct-msg {
    font-size: 0.82rem;
    color: #475569;
    line-height: 1.6;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    margin-bottom: 0;
}
.ct-actions {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: auto;
    padding-top: 0.85rem;
    border-top: 1px dashed var(--admin-border);
}
.ct-time {
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
    white-space: nowrap;
}
.ct-view-btn {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 0.72rem;
    font-weight: 600;
    color: var(--admin-primary);
    background: rgba(99,102,241,0.08);
    border: 1px solid rgba(99,102,241,0.18);
    transition: all 0.2s;
    cursor: pointer;
    text-decoration: none;
}
.ct-view-btn:hover { background: rgba(99,102,241,0.14); }

/* ---- Sticky search ---- */
.ct-search-wrap {
    position: sticky;
    top: calc(var(--admin-topbar-height) + 6px);
    z-index: 1020;
}
.ct-search {
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
.ct-search:focus-within {
    border-color: var(--admin-primary);
    box-shadow: 0 0 0 4px rgba(99,102,241,0.1), 0 4px 18px rgba(15,23,42,0.06);
}
.ct-search i { color: var(--admin-text-muted); }
.ct-search input {
    flex: 1;
    border: none;
    outline: none;
    background: transparent;
    font-size: 0.85rem;
    color: var(--admin-text);
    padding: 0.15rem 0;
    min-width: 0;
}
.ct-search input::placeholder { color: #94a3b8; }

/* ---- Modal ---- */
.ct-modal-header {
    background: linear-gradient(135deg,#6366f1,#8b5cf6);
}
.ct-modal-header .btn-close { filter: invert(1); }
.ct-modal-email { word-break: break-all; }

@media (max-width: 767.98px) {
    .ct-card { padding: 1rem 1.05rem; border-radius: 14px; gap: 0.8rem; }
    .ct-avatar { width: 42px; height: 42px; min-width: 42px; font-size: 0.92rem; }
    .ct-name { font-size: 0.85rem; }
    .ct-email { font-size: 0.71rem; }
    .ct-msg { font-size: 0.77rem; }
    .ct-date, .ct-time { font-size: 0.66rem; padding: 3px 8px; }
    .ct-view-btn { font-size: 0.68rem; padding: 5px 12px; }
    .ct-search-wrap { top: 60px; }
}
</style>

<div class="container-fluid py-3 contact-page">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-11 col-xxl-10">

            {{-- Header --}}
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                <div>
                    <h4 class="fw-bold mb-1"><i class="bi bi-envelope-paper me-2" style="color:var(--admin-primary);"></i>Messages</h4>
                    <p class="text-muted small mb-0">Customer inquiries sent through the contact form</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge-count" id="countBadge">
                        <i class="bi bi-database me-1"></i> {{ $contacts->count() }} Total
                    </span>
                </div>
            </div>

            {{-- Live Search (client-side, sticky on scroll) --}}
            @if($contacts->isNotEmpty())
                <div class="ct-search-wrap mb-3">
                    <div class="ct-search">
                        <i class="bi bi-search" style="font-size:0.9rem;"></i>
                        <input type="text" id="liveSearch" placeholder="Search by name, email or message..."
                               autocomplete="off">
                    </div>
                </div>
            @endif

            {{-- Cards Grid --}}
            @if($contacts->isEmpty())
                <div class="text-center py-5">
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <div class="fw-semibold mb-2">No Messages Found</div>
                        <p class="text-muted small mb-0">Customer messages will appear here once submitted.</p>
                    </div>
                </div>
            @else
                <div id="contactsGrid" class="row g-3">
                    @foreach($contacts as $contact)
                        <div class="col-12 col-md-6 col-xxl-4 ct-card-col" data-filter="{{ strtolower($contact->name . ' ' . $contact->email . ' ' . $contact->message) }}">
                            <div class="ct-card">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="ct-avatar">{{ strtoupper(substr($contact->name, 0, 1)) }}</div>
                                    <div class="min-w-0 flex-grow-1">
                                        <div class="ct-name text-truncate">{{ $contact->name }}</div>
                                        <a class="ct-email text-truncate d-block" href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                                    </div>
                                    <span class="ct-date">
                                        <i class="bi bi-calendar3"></i>{{ \Carbon\Carbon::parse($contact->created_at)->timezone('Asia/Dhaka')->format('d M Y') }}
                                    </span>
                                </div>

                                <p class="ct-msg">{{ $contact->message }}</p>

                                <div class="ct-actions">
                                    <span class="ct-time">
                                        <i class="bi bi-clock"></i>{{ \Carbon\Carbon::parse($contact->created_at)->timezone('Asia/Dhaka')->format('h:i A') }}
                                    </span>
                                    <button type="button" class="ct-view-btn btn-view-msg"
                                            data-name="{{ $contact->name }}"
                                            data-email="{{ $contact->email }}"
                                            data-message="{{ $contact->message }}"
                                            data-date="{{ \Carbon\Carbon::parse($contact->created_at)->timezone('Asia/Dhaka')->format('d M Y, h:i A') }}"
                                            data-bs-toggle="modal" data-bs-target="#viewContactModal">
                                        <i class="bi bi-eye me-1"></i> View Message
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</div>

{{-- Shared Message modal (kept at page level so Bootstrap positions it against the viewport) --}}
<div class="modal fade" id="viewContactModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4" style="overflow:hidden;">
            <div class="modal-header ct-modal-header border-0 text-white">
                <h5 class="modal-title fw-semibold" style="font-size:0.95rem;">
                    <i class="bi bi-chat-dots me-2"></i>Message
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body px-4 py-3">
                <div class="mb-3 d-flex align-items-center gap-3">
                    <div class="ct-avatar" id="ctModalAvatar">?</div>
                    <div class="min-w-0">
                        <div class="fw-bold" style="font-size:0.88rem;" id="ctModalName"></div>
                        <a class="small ct-email ct-modal-email" id="ctModalEmail" href="#"></a>
                    </div>
                </div>
                <div class="mb-3 small" style="color:var(--admin-text-muted);">
                    <i class="bi bi-calendar3 me-1"></i><span id="ctModalDate"></span>
                </div>
                <p class="mb-0" style="line-height:1.75; color:#334155; white-space:pre-wrap;" id="ctModalMsg"></p>
            </div>
            <div class="modal-footer border-0 px-4 pb-3 pt-0">
                <button type="button" class="btn btn-light border rounded-3 px-4" style="font-size:0.8rem;" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const box = document.getElementById('contactsGrid');
        if (!box) return;

        // Client-side live filter
        const input = document.getElementById('liveSearch');
        const cards = box.querySelectorAll('.ct-card-col');
        const badge = document.getElementById('countBadge');
        input.addEventListener('input', function() {
            const q = this.value.toLowerCase().trim();
            let visible = 0;
            cards.forEach(function(card) {
                const match = card.dataset.filter.includes(q);
                card.style.display = match ? '' : 'none';
                if (match) visible++;
            });
            if (badge) badge.innerHTML = '<i class="bi bi-database me-1"></i> ' + visible + ' Total';
        });

        // Shared modal population (delegated)
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.btn-view-msg');
            if (!btn) return;
            document.getElementById('ctModalAvatar').textContent = (btn.dataset.name || '?').charAt(0).toUpperCase();
            document.getElementById('ctModalName').textContent = btn.dataset.name;
            document.getElementById('ctModalEmail').textContent = btn.dataset.email;
            document.getElementById('ctModalEmail').href = 'mailto:' + btn.dataset.email;
            document.getElementById('ctModalDate').textContent = btn.dataset.date;
            document.getElementById('ctModalMsg').textContent = btn.dataset.message;
        });
    });
</script>
@endsection

@endsection