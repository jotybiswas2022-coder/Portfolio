@extends('frontend.app')

@section('content')
<style>
    .inbox-page {
        padding-top: 100px;
        padding-bottom: 4rem;
        min-height: 100vh;
        background: linear-gradient(180deg, var(--bg-primary) 0%, #080d1a 100%);
    }
    html.light-theme .inbox-page {
        background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
    }
    html.light-theme body { background: #f8fafc; }

    .inbox-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .inbox-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
    }
    .inbox-header h1 {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0;
    }

    .inbox-empty {
        text-align: center;
        padding: 4rem 2rem;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-xl);
    }
    .inbox-empty i {
        font-size: 3.5rem;
        color: var(--text-muted);
        margin-bottom: 1rem;
        display: block;
    }
    .inbox-empty h3 {
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }
    .inbox-empty p {
        color: var(--text-secondary);
        margin-bottom: 1.5rem;
    }

    .conversation-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    .conversation-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.2rem 1.5rem;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        text-decoration: none;
        transition: var(--transition);
    }
    .conversation-item:hover {
        border-color: var(--border-hover);
        box-shadow: var(--shadow-sm);
        transform: translateX(4px);
    }
    .conv-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        font-weight: 700;
        color: #fff;
        flex-shrink: 0;
    }
    .conv-info {
        flex: 1;
        min-width: 0;
    }
    .conv-info h4 {
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0 0 0.2rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .conv-info p {
        font-size: 0.85rem;
        color: var(--text-secondary);
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .conv-meta {
        text-align: right;
        flex-shrink: 0;
    }
    .conv-meta .conv-time {
        font-size: 0.75rem;
        color: var(--text-muted);
        display: block;
        margin-bottom: 0.3rem;
    }
    .conv-status {
        display: inline-block;
        padding: 0.15rem 0.6rem;
        border-radius: 10px;
        font-size: 0.7rem;
        font-weight: 600;
    }
    .conv-status.open {
        background: rgba(34, 197, 94, 0.12);
        color: #22c55e;
    }
    .conv-status.closed {
        background: rgba(248, 113, 113, 0.12);
        color: #f87171;
    }

    @media (max-width: 480px) {
        .inbox-page { padding-top: 80px; }
        .inbox-header h1 { font-size: 1.4rem; }
        .conversation-item { padding: 1rem; }
    }
</style>

<div class="inbox-page">
    <div class="container">
        <div class="inbox-container">
            <div class="inbox-header">
                <h1><i class="bi bi-chat-dots me-2" style="color:#3b82f6;"></i>{{ __('messages.inbox') }}</h1>
            </div>

            @if($conversations->isEmpty())
                <div class="inbox-empty">
                    <i class="bi bi-envelope-open"></i>
                    <h3>{{ __('messages.no_conversations') }}</h3>
                    <p>{{ __('messages.no_conversations_desc') }}</p>
                    <a href="{{ route('home') }}" class="btn btn-primary rounded-pill px-4" style="background:#3b82f6; border-color:#3b82f6;">
                        <i class="bi bi-house-fill me-1"></i> {{ __('messages.browse_gigs') }}
                    </a>
                </div>
            @else
                <div class="conversation-list">
                    @foreach($conversations as $conv)
                        <a href="{{ route('inbox.show', $conv->id) }}" class="conversation-item">
                            <div class="conv-avatar">
                                {{ substr($conv->subject, 0, 1) }}
                            </div>
                            <div class="conv-info">
                                <h4>{{ $conv->subject }}</h4>
                                <p>{{ $conv->lastMessage ? Str::limit($conv->lastMessage->message, 60) : '' }}</p>
                            </div>
                            <div class="conv-meta">
                                <span class="conv-time">{{ $conv->updated_at->diffForHumans() }}</span>
                                <span class="conv-status {{ $conv->status }}">{{ ucfirst($conv->status) }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
