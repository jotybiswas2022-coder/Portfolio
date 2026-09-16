@extends('backend.app')

@section('content')
<style>
.inbox-page h4 { letter-spacing: -0.3px; }
.inbox-page .text-muted { color: var(--admin-text-muted) !important; }

/* ---- Clean card list ---- */
.ibx-card {
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
    text-decoration: none;
    color: inherit;
}
a.ibx-card:hover {
    border-color: #c7d2fe;
    box-shadow: 0 10px 28px rgba(99,102,241,0.08);
    transform: translateY(-2px);
    color: inherit;
}
.min-w-0 { min-width: 0; }
.ibx-avatar {
    width: 46px; height: 46px;
    min-width: 46px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: #fff;
    font-weight: 700;
    font-size: 1rem;
    background: linear-gradient(135deg,#3b82f6,#8b5cf6);
    border: 2px solid rgba(99,102,241,0.15);
}
.ibx-name {
    font-weight: 700;
    font-size: 0.9rem;
    color: var(--admin-text);
    line-height: 1.3;
}
.ibx-email {
    font-size: 0.75rem;
    color: var(--admin-text-muted);
    line-height: 1.4;
    margin-top: 1px;
}
.ibx-time {
    font-size: 0.7rem;
    color: var(--admin-text-muted);
    white-space: nowrap;
}
.ibx-subject {
    font-weight: 600;
    font-size: 0.82rem;
    color: var(--admin-text);
    line-height: 1.4;
    margin-bottom: 2px;
}
.ibx-preview {
    font-size: 0.76rem;
    color: var(--admin-text-muted);
    line-height: 1.5;
}
.ibx-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.5rem;
    margin-top: auto;
    padding-top: 0.85rem;
    border-top: 1px dashed var(--admin-border);
    flex-wrap: wrap;
}
.ibx-pkg {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 0.7rem;
    font-weight: 600;
    color: var(--admin-primary);
    background: rgba(99,102,241,0.08);
    border: 1px solid rgba(99,102,241,0.18);
    white-space: nowrap;
}
.ibx-status {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 0.7rem;
    font-weight: 700;
}
.ibx-status::before {
    content: '';
    width: 7px; height: 7px;
    border-radius: 50%;
    background: currentColor;
}
.ibx-open {
    background: rgba(16,185,129,0.1);
    color: #059669;
    border: 1px solid rgba(16,185,129,0.2);
}
.ibx-closed {
    background: #f1f5f9;
    color: #64748b;
    border: 1px solid var(--admin-border);
}
.ibx-reply {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 14px;
    border-radius: 9px;
    font-size: 0.75rem;
    font-weight: 600;
    color: #fff;
    background: linear-gradient(135deg, #6366f1, #4f46e5);
    box-shadow: 0 4px 12px rgba(99,102,241,0.25);
    text-decoration: none;
    transition: all 0.2s;
}
.ibx-reply:hover {
    transform: translateY(-1px);
    box-shadow: 0 8px 20px rgba(99,102,241,0.35);
    color: #fff;
}

@media (max-width: 575.98px) {
    .ibx-card { padding: 1rem 1.05rem; border-radius: 14px; gap: 0.8rem; }
    .ibx-avatar { width: 42px; height: 42px; min-width: 42px; font-size: 0.9rem; }
    .ibx-name { font-size: 0.85rem; }
    .ibx-email { font-size: 0.71rem; }
    .ibx-subject { font-size: 0.78rem; }
    .ibx-preview { font-size: 0.73rem; }
    .ibx-time { font-size: 0.66rem; }
}
</style>

<div class="container-fluid py-3 inbox-page">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-11 col-xxl-10">

            {{-- Header --}}
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                <div>
                    <h4 class="fw-bold mb-1"><i class="bi bi-chat-dots me-2" style="color:var(--admin-primary);"></i>Inbox</h4>
                    <p class="text-muted small mb-0">Manage conversations with clients</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge-count">
                        <i class="bi bi-database me-1"></i> {{ $conversations->count() }} Conversations
                    </span>
                </div>
            </div>

            {{-- Conversation Cards --}}
            @if($conversations->isEmpty())
                <div class="text-center py-5">
                    <div class="empty-state">
                        <i class="bi bi-envelope-open"></i>
                        <div class="fw-semibold mb-2">No Conversations Yet</div>
                        <p class="text-muted small mb-0">When clients send you a message, it will show up here.</p>
                    </div>
                </div>
            @else
                <div class="row g-3">
                    @foreach($conversations as $conv)
                        <div class="col-12 col-md-6 col-xxl-4">
                            <a href="{{ route('admin.inbox.show', $conv->id) }}" class="ibx-card">

                                {{-- Client + time --}}
                                <div class="d-flex align-items-start gap-3">
                                    <div class="ibx-avatar">{{ strtoupper(substr($conv->user->name, 0, 1)) }}</div>
                                    <div class="min-w-0 flex-grow-1">
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <div class="ibx-name text-truncate">{{ $conv->user->name }}</div>
                                            <span class="ibx-time">{{ $conv->updated_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="ibx-email text-truncate">{{ $conv->user->email }}</div>
                                    </div>
                                </div>

                                {{-- Subject + preview --}}
                                <div>
                                    <div class="ibx-subject">{{ $conv->subject }}</div>
                                    <div class="ibx-preview text-truncate">
                                        {{ $conv->lastMessage ? ($conv->lastMessage->message ?: '(shared image)') : 'No messages yet' }}
                                    </div>
                                </div>

                                {{-- Footer: package + status + reply --}}
                                <div class="ibx-footer">
                                    <div class="d-flex align-items-center gap-1 flex-wrap">
                                        @if($conv->package_name)
                                            <span class="ibx-pkg">
                                                <i class="bi bi-box-seam"></i> {{ $conv->package_name }} · ${{ $conv->package_price }}
                                            </span>
                                        @endif
                                        <span class="ibx-status {{ $conv->status == 'open' ? 'ibx-open' : 'ibx-closed' }}">
                                            {{ ucfirst($conv->status) }}
                                        </span>
                                    </div>
                                    <span class="ibx-reply">
                                        <i class="bi bi-chat-dots"></i> Reply
                                    </span>
                                </div>

                            </a>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</div>
@endsection