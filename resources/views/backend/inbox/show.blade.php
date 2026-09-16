@extends('backend.app')

@section('content')
<style>
.inbox-show-page { font-size: 0.88rem; }
.inbox-show-page .text-muted { color: var(--admin-text-muted) !important; }

/* ---- Header ---- */
.c-chat-title {
    font-weight: 700;
    font-size: 0.98rem;
    color: var(--admin-text);
    line-height: 1.35;
}
.c-chat-sub {
    font-size: 0.75rem;
    color: var(--admin-text-muted);
    line-height: 1.4;
}
.c-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 12px;
    border-radius: 999px;
    font-size: 0.72rem;
    font-weight: 700;
    white-space: nowrap;
}
.c-status::before {
    content: '';
    width: 7px; height: 7px;
    border-radius: 50%;
    background: currentColor;
}
.c-status.open { background: rgba(16,185,129,0.1); color: #059669; border: 1px solid rgba(16,185,129,0.2); }
.c-status.closed { background: #f1f5f9; color: #64748b; border: 1px solid var(--admin-border); }
.c-back {
    width: 38px; height: 38px;
    padding: 0;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    border: 1px solid var(--admin-border);
    background: #fff;
    color: var(--admin-text-muted);
    text-decoration: none;
    transition: all 0.2s;
    flex-shrink: 0;
}
.c-back:hover { color: var(--admin-primary); border-color: #c7d2fe; background: #eef2ff; }

/* ---- Package strip ---- */
.c-pkg-icon {
    width: 42px; height: 42px;
    min-width: 42px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    background: #eef2ff;
    color: var(--admin-primary);
    font-size: 1.1rem;
    border: 1px solid rgba(99,102,241,0.15);
}
.c-pkg-name { font-weight: 700; font-size: 0.88rem; color: var(--admin-text); }
.c-pkg-price { font-weight: 600; font-size: 0.82rem; color: var(--admin-primary); }
.c-pkg-link {
    font-size: 0.74rem;
    font-weight: 600;
    color: var(--admin-primary);
    text-decoration: none;
    white-space: nowrap;
}
.c-pkg-link:hover { text-decoration: underline; }

/* ---- Chat ---- */
.c-chat-card {
    border-radius: 18px;
}
.chat-messages {
    max-height: 500px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 1rem;
    padding: 1.1rem;
    background: linear-gradient(180deg, #fafbff 0%, #ffffff 100%);
}
.chat-messages::-webkit-scrollbar { width: 4px; }
.chat-messages::-webkit-scrollbar-thumb { background: rgba(99,102,241,0.3); border-radius: 2px; }

.cmsg {
    display: flex;
    gap: 0.7rem;
    max-width: 82%;
}
.cmsg.incoming { align-self: flex-start; }
.cmsg.outgoing { align-self: flex-end; flex-direction: row-reverse; }

.c-avatar {
    width: 34px; height: 34px;
    min-width: 34px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.8rem; font-weight: 700; color: #fff;
    flex-shrink: 0;
}
.cmsg .cbubble {
    padding: 0.7rem 1rem;
    border-radius: 16px;
    font-size: 0.86rem;
    line-height: 1.55;
    word-break: break-word;
    box-shadow: 0 1px 2px rgba(15,23,42,0.04);
}
.cmsg.incoming .cbubble {
    background: #fff;
    border: 1px solid var(--admin-border);
    border-bottom-left-radius: 5px;
}
.cmsg.outgoing .cbubble {
    background: linear-gradient(135deg, #6366f1, #4f46e5);
    color: #fff;
    border-bottom-right-radius: 5px;
    box-shadow: 0 6px 18px rgba(99,102,241,0.25);
}
.cbubble .sender-label {
    font-size: 0.68rem;
    color: var(--admin-primary);
    font-weight: 600;
    margin-bottom: 0.25rem;
}
.cbubble .time {
    display: block;
    font-size: 0.66rem;
    margin-top: 0.4rem;
}
.cmsg.incoming .cbubble .time { color: #94a3b8; }
.cmsg.outgoing .cbubble .time { color: rgba(255,255,255,0.75); }
.cbubble img {
    max-width: 260px; max-height: 260px;
    width: auto; height: auto;
    border-radius: 12px;
    margin-top: 0.4rem;
    display: block;
    object-fit: cover;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
}
.cmsg.outgoing .cbubble img { border: 2px solid rgba(255,255,255,0.25); }
.cmsg.incoming .cbubble img { border: 1px solid #e2e8f0; }

/* ---- Composer ---- */
.c-composer {
    border-radius: 18px;
}
.c-composer-row { display: flex; gap: 0.5rem; align-items: flex-start; }
.c-composer-input { min-width: 0; flex: 1; }
.c-composer-input .msg-textarea {
    border-radius: 12px;
    border: 1.5px solid #e2e8f0;
    font-size: 0.82rem;
    padding: 0.55rem 0.8rem;
    resize: none;
    width: 100%;
    transition: all 0.2s;
}
.c-composer-input .msg-textarea:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
}
.c-composer-actions { display: flex; gap: 0.25rem; flex-shrink: 0; }
.c-tool-btn {
    width: 38px; height: 38px;
    padding: 0;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 0.95rem;
    background: #f8fafc;
    border: 1px solid var(--admin-border);
    color: var(--admin-text-muted);
    transition: all 0.2s;
    cursor: pointer;
}
.c-tool-btn:hover { color: var(--admin-primary); border-color: #c7d2fe; background: #eef2ff; }
.c-send-btn {
    background: linear-gradient(135deg, #6366f1, #4f46e5);
    color: #fff;
    border: none;
    padding: 0 1.1rem;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.8rem;
    box-shadow: 0 4px 15px rgba(99,102,241,0.3);
    transition: all 0.2s;
}
.c-send-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 8px 22px rgba(99,102,241,0.4);
    color: #fff;
}
.c-emoji-row {
    display: none;
    gap: 0.3rem;
    flex-wrap: wrap;
    padding: 0.6rem;
    background: #f8fafc;
    border-radius: 12px;
    border: 1px solid var(--admin-border);
}
.c-emoji-row button {
    background: none;
    border: none;
    font-size: 1.3rem;
    cursor: pointer;
    padding: 3px 5px;
    border-radius: 6px;
    line-height: 1;
    transition: transform 0.15s, background 0.15s;
}
.c-emoji-row button:hover { transform: scale(1.15); background: #eef2ff; }
.c-image-preview {
    display: none;
    margin-bottom: 0.5rem;
    align-items: center;
    gap: 0.5rem;
}
.c-image-preview img {
    max-width: 110px; max-height: 110px;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
}
.c-image-preview .c-remove-img {
    color: #f87171;
    cursor: pointer;
    font-size: 0.78rem;
}

@media (max-width: 767.98px) {
    .inbox-show-page { font-size: 0.8rem; }
    .c-chat-title { font-size: 0.88rem; }
    .c-chat-sub { font-size: 0.7rem; }
    .chat-messages { max-height: 48vh; min-height: 220px; padding: 0.85rem; gap: 0.8rem; }
    .cmsg { max-width: 97%; }
    .cmsg .cbubble { font-size: 0.78rem; padding: 0.5rem 0.75rem; }
    .c-avatar { width: 28px; height: 28px; min-width: 28px; font-size: 0.65rem; }
    .cbubble .time { font-size: 0.6rem; }
    .cbubble img { max-width: 100%; max-height: 200px; }
    .c-pkg-icon { width: 36px; height: 36px; min-width: 36px; font-size: 0.95rem; }
    .c-back { width: 34px; height: 34px; }

    /* composer stacks: textarea full width, buttons on their own row */
    .c-composer-row { flex-wrap: wrap; }
    .c-composer-input { flex: 1 1 100%; }
    .c-composer-actions { flex: 1 1 100%; justify-content: flex-end; gap: 0.35rem; }
    .c-send-btn { padding: 0 1rem; font-size: 0.78rem; height: 38px; }

    /* tighter header + package row on small screens */
    .c-header-row { gap: 0.5rem !important; flex-wrap: nowrap; }
    .c-pkg-row { gap: 0.6rem !important; }
    .c-status { padding: 4px 9px; font-size: 0.66rem; }
}
</style>

<div class="container-fluid py-3 inbox-show-page">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            {{-- Header --}}
            <div class="d-flex align-items-center gap-3 mb-3 c-header-row">
                <a href="{{ route('admin.inbox.index') }}" class="c-back" title="Back to inbox">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div class="min-w-0 flex-grow-1">
                    <h5 class="c-chat-title text-truncate mb-0">{{ $conversation->subject }}</h5>
                    <div class="c-chat-sub">
                        <i class="bi bi-person me-1"></i>{{ $conversation->user->name }} &middot; {{ $conversation->user->email }}
                    </div>
                </div>
                <span class="c-status {{ $conversation->status == 'open' ? 'open' : 'closed' }} ms-auto flex-shrink-0">
                    {{ ucfirst($conversation->status) }}
                </span>
            </div>

            {{-- Package strip --}}
            @if($conversation->package_name)
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-3 py-2">
                        <div class="d-flex align-items-center gap-3 c-pkg-row">
                            <div class="c-pkg-icon"><i class="bi bi-box-seam"></i></div>
                            <div class="min-w-0 flex-grow-1">
                                <div class="small text-uppercase mb-1" style="font-size:0.65rem; letter-spacing:0.6px; color:#94a3b8;">Requested Package</div>
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <span class="c-pkg-name">{{ $conversation->package_name }}</span>
                                    <span class="c-pkg-price">${{ $conversation->package_price }}</span>
                                </div>
                            </div>
                            @if($conversation->gig)
                                <a href="{{ route('admin.gigs.edit', $conversation->gig->id) }}" class="c-pkg-link flex-shrink-0">
                                    <i class="bi bi-box-arrow-up-right me-1"></i>View Gig
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            {{-- Messages --}}
            <div class="card border-0 shadow-sm rounded-4 c-chat-card mb-3">
                <div class="card-body p-0">
                    <div class="chat-messages" id="messagesBox">
                        @forelse($conversation->messages as $msg)
                            @php $isAdmin = $msg->sender_id == auth()->id(); @endphp
                            <div class="cmsg {{ $isAdmin ? 'outgoing' : 'incoming' }}">
                                <div class="c-avatar" style="background:{{ $isAdmin ? 'linear-gradient(135deg,#6366f1,#8b5cf6)' : 'linear-gradient(135deg,#3b82f6,#60a5fa)' }};">
                                    {{ strtoupper(substr($msg->sender->name, 0, 1)) }}
                                </div>
                                <div class="cbubble">
                                    @if(!$isAdmin)
                                        <div class="sender-label">{{ $msg->sender->name }}</div>
                                    @endif
                                    @if($msg->message)
                                        <span>{!! nl2br(e($msg->message)) !!}</span>
                                    @endif
                                    @if($msg->image)
                                        <img src="{{ config('app.storage_url') }}{{ $msg->image }}" alt="Shared image">
                                    @endif
                                    <span class="time">{{ $msg->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @empty
                            <div style="text-align:center; padding:2rem; color:#94a3b8;">
                                <i class="bi bi-chat-dots" style="font-size:2rem; display:block; margin-bottom:0.5rem;"></i>
                                No messages yet.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Composer --}}
            @if($conversation->status == 'open')
                <div class="card border-0 shadow-sm rounded-4 c-composer">
                    <div class="card-body p-3">
                        <form method="POST" action="{{ route('admin.inbox.send', $conversation->id) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="c-image-preview" id="imagePreview">
                                <img id="previewImg" src="">
                                <span class="c-remove-img" onclick="clearImage()">&times; Remove</span>
                            </div>

                            <div class="c-emoji-row" id="emojiPicker">
                                <button type="button" onclick="insertEmoji('😊')">😊</button>
                                <button type="button" onclick="insertEmoji('👍')">👍</button>
                                <button type="button" onclick="insertEmoji('😍')">😍</button>
                                <button type="button" onclick="insertEmoji('🎉')">🎉</button>
                                <button type="button" onclick="insertEmoji('🔥')">🔥</button>
                                <button type="button" onclick="insertEmoji('💯')">💯</button>
                                <button type="button" onclick="insertEmoji('✅')">✅</button>
                                <button type="button" onclick="insertEmoji('❓')">❓</button>
                                <button type="button" onclick="insertEmoji('👋')">👋</button>
                                <button type="button" onclick="insertEmoji('📸')">📸</button>
                                <button type="button" onclick="insertEmoji('🚀')">🚀</button>
                                <button type="button" onclick="insertEmoji('💪')">💪</button>
                                <button type="button" onclick="insertEmoji('🙏')">🙏</button>
                                <button type="button" onclick="insertEmoji('😎')">😎</button>
                                <button type="button" onclick="insertEmoji('💰')">💰</button>
                            </div>

                            <div class="c-composer-row">
                                <div class="c-composer-input">
                                    <textarea name="message" id="msgInput" class="form-control msg-textarea" rows="2" placeholder="Type your reply..."></textarea>
                                    @error('message')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                    @error('image')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                </div>
                                <div class="c-composer-actions">
                                    <button type="button" class="c-tool-btn" onclick="toggleEmojiPicker()" title="Emoji">
                                        <i class="bi bi-emoji-smile"></i>
                                    </button>
                                    <label class="c-tool-btn" style="cursor:pointer;" title="Send Image">
                                        <i class="bi bi-image"></i>
                                        <input type="file" name="image" accept="image/*" onchange="previewImage(event)" style="display:none;">
                                    </label>
                                    <button type="submit" class="c-send-btn">
                                        <i class="bi bi-send-fill me-1"></i> Send
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="alert alert-secondary rounded-4 text-center mb-0">
                    <i class="bi bi-lock-fill me-1"></i> This conversation is closed.
                </div>
            @endif

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const box = document.getElementById('messagesBox');
        if (box) box.scrollTop = box.scrollHeight;
        const textarea = document.getElementById('msgInput');
        if (textarea) {
            textarea.addEventListener('input', function() { autoResize(this); });
        }
    });
    function toggleEmojiPicker() {
        const picker = document.getElementById('emojiPicker');
        picker.style.display = picker.style.display === 'none' ? 'flex' : 'none';
    }
    function insertEmoji(emoji) {
        const input = document.getElementById('msgInput');
        const start = input.selectionStart;
        const end = input.selectionEnd;
        input.value = input.value.substring(0, start) + emoji + input.value.substring(end);
        input.focus();
        input.selectionStart = input.selectionEnd = start + emoji.length;
        autoResize(input);
    }
    function autoResize(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = Math.min(textarea.scrollHeight, 120) + 'px';
    }
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'flex';
            };
            reader.readAsDataURL(file);
        }
    }
    function clearImage() {
        document.querySelector('input[name="image"]').value = '';
        document.getElementById('imagePreview').style.display = 'none';
    }
</script>
@endsection