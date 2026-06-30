@extends('frontend.app')

@section('content')
<style>
    .chat-page {
        padding-top: 100px;
        padding-bottom: 4rem;
        min-height: 100vh;
        background: linear-gradient(180deg, var(--bg-primary) 0%, #080d1a 100%);
    }
    html.light-theme .chat-page {
        background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
    }
    html.light-theme body { background: #f8fafc; }

    .chat-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .chat-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    .chat-header a {
        color: var(--accent-light);
        text-decoration: none;
        font-size: 1.2rem;
        transition: var(--transition);
    }
    .chat-header a:hover { color: var(--accent); }
    .chat-header h2 {
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0;
        flex: 1;
    }

    .package-summary {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 1.2rem 1.5rem;
        margin-bottom: 1.5rem;
    }
    .package-summary h5 {
        font-size: 0.85rem;
        color: var(--text-muted);
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .package-summary .pkg-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--accent-light);
    }
    .package-summary .pkg-price {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text-primary);
    }

    .messages-box {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        margin-bottom: 1rem;
        max-height: 500px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    .messages-box::-webkit-scrollbar { width: 4px; }
    .messages-box::-webkit-scrollbar-track { background: transparent; }
    .messages-box::-webkit-scrollbar-thumb { background: rgba(59,130,246,0.3); border-radius: 2px; }

    .message {
        display: flex;
        gap: 0.75rem;
        max-width: 85%;
    }
    .message.incoming { align-self: flex-start; }
    .message.outgoing { align-self: flex-end; flex-direction: row-reverse; }

    .msg-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        font-weight: 700;
        color: #fff;
        flex-shrink: 0;
    }
    .message.outgoing .msg-avatar {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
    }

    .msg-bubble {
        padding: 0.7rem 1rem;
        border-radius: 16px;
        font-size: 0.92rem;
        line-height: 1.5;
        word-break: break-word;
    }
    .message.incoming .msg-bubble {
        background: rgba(59, 130, 246, 0.08);
        border: 1px solid rgba(59, 130, 246, 0.12);
        color: var(--text-primary);
        border-bottom-left-radius: 4px;
    }
    .message.outgoing .msg-bubble {
        background: rgba(59, 130, 246, 0.15);
        border: 1px solid rgba(59, 130, 246, 0.2);
        color: var(--text-primary);
        border-bottom-right-radius: 4px;
    }
    .msg-bubble .msg-time {
        display: block;
        font-size: 0.7rem;
        color: var(--text-muted);
        margin-top: 0.4rem;
    }
    .msg-bubble img {
        max-width: 200px;
        max-height: 200px;
        border-radius: 10px;
        margin-top: 0.3rem;
        display: block;
    }
    .msg-bubble .msg-label {
        font-size: 0.7rem;
        color: var(--text-muted);
        margin-bottom: 0.2rem;
    }

    .chat-form {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 1rem;
    }
    .chat-form .input-group {
        display: flex;
        gap: 0.5rem;
        align-items: flex-end;
    }
    .chat-form textarea {
        flex: 1;
        background: rgba(255,255,255,0.04);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        color: var(--text-primary);
        padding: 0.7rem 1rem;
        font-size: 0.9rem;
        resize: none;
        min-height: 44px;
        max-height: 120px;
        outline: none;
        transition: var(--transition);
    }
    html.light-theme .chat-form textarea { background: rgba(0,0,0,0.02); }
    .chat-form textarea:focus { border-color: #3b82f6; }

    .chat-form .emoji-btn {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        border: 1px solid var(--border-color);
        background: rgba(255,255,255,0.04);
        color: var(--text-secondary);
        font-size: 1.2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
        padding: 0;
    }
    .chat-form .emoji-btn:hover {
        border-color: var(--border-hover);
        color: var(--accent-light);
    }
    .chat-form .image-btn {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        border: 1px solid var(--border-color);
        background: rgba(255,255,255,0.04);
        color: var(--text-secondary);
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }
    .chat-form .image-btn:hover {
        border-color: var(--border-hover);
        color: var(--accent-light);
    }
    .chat-form .image-btn input[type="file"] {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        opacity: 0;
        cursor: pointer;
    }
    .chat-form .send-btn {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        border: none;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: #fff;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
        box-shadow: 0 4px 15px rgba(59,130,246,0.3);
    }
    .chat-form .send-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59,130,246,0.4);
    }

    .emoji-picker {
        display: none;
        padding: 0.5rem;
        gap: 0.3rem;
        flex-wrap: wrap;
        border-top: 1px solid var(--border-color);
        margin-top: 0.5rem;
    }
    .emoji-picker.open { display: flex; }
    .emoji-picker button {
        background: none;
        border: none;
        font-size: 1.4rem;
        cursor: pointer;
        padding: 2px 4px;
        border-radius: 4px;
        transition: background 0.2s;
        line-height: 1;
    }
    .emoji-picker button:hover { background: rgba(59,130,246,0.1); }

    #imagePreview {
        display: none;
        padding: 0.5rem 0;
        border-top: 1px solid var(--border-color);
        margin-top: 0.5rem;
    }
    #imagePreview img {
        max-width: 120px;
        max-height: 120px;
        border-radius: 8px;
        border: 1px solid var(--border-color);
    }
    #imagePreview .remove-image {
        display: inline-block;
        margin-left: 0.5rem;
        color: #f87171;
        cursor: pointer;
        font-size: 0.85rem;
        vertical-align: top;
    }

    @media (max-width: 480px) {
        .chat-page { padding-top: 80px; }
        .messages-box { max-height: 400px; padding: 1rem; }
        .message { max-width: 95%; }
    }
</style>

<div class="chat-page">
    <div class="container">
        <div class="chat-container">
            <div class="chat-header">
                <a href="{{ route('inbox.index') }}"><i class="bi bi-arrow-left"></i></a>
                <h2>{{ $conversation->subject }}</h2>
                <span class="conv-status {{ $conversation->status }}" style="font-size:0.75rem; padding:0.2rem 0.6rem; border-radius:10px; font-weight:600;
                    {{ $conversation->status == 'open' ? 'background:rgba(34,197,94,0.12); color:#22c55e;' : 'background:rgba(248,113,113,0.12); color:#f87171;' }}">
                    {{ ucfirst($conversation->status) }}
                </span>
            </div>

            @if($conversation->package_name)
            <div class="package-summary">
                <h5>{{ __('messages.package_details') }}</h5>
                <span class="pkg-name">{{ $conversation->package_name }}</span>
                                <span class="pkg-price ms-3">{{ $conversation->package_price }} USD</span>
                @if($conversation->package_details)
                    <div style="margin-top:0.5rem; font-size:0.85rem; color:var(--text-secondary); white-space:pre-line;">{{ $conversation->package_details }}</div>
                @endif
            </div>
            @endif

            <div class="messages-box" id="messagesBox">
                @forelse($conversation->messages as $msg)
                    @php $isMine = $msg->sender_id == auth()->id(); @endphp
                    <div class="message {{ $isMine ? 'outgoing' : 'incoming' }}">
                        <div class="msg-avatar">{{ substr($msg->sender->name, 0, 1) }}</div>
                        <div class="msg-bubble">
                            @if($msg->sender->is_admin)
                                <div class="msg-label">Admin</div>
                            @endif
                            @if($msg->message)
                                <span>{!! nl2br(e($msg->message)) !!}</span>
                            @endif
                            @if($msg->image)
                                <img src="{{ config('app.storage_url') }}{{ $msg->image }}" alt="Shared image">
                            @endif
                            <span class="msg-time">{{ $msg->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @empty
                    <div style="text-align:center; color:var(--text-muted); padding:2rem;">
                        <i class="bi bi-chat-dots" style="font-size:2rem; display:block; margin-bottom:0.5rem;"></i>
                        {{ __('messages.no_messages_yet') }}
                    </div>
                @endforelse
            </div>

            @if($conversation->status == 'open')
            <form method="POST" action="{{ route('inbox.send', $conversation->id) }}" enctype="multipart/form-data" class="chat-form">
                @csrf
                <div class="emoji-picker" id="emojiPicker">
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
                <div id="imagePreview">
                    <img id="previewImg" src="" alt="Preview">
                    <span class="remove-image" onclick="clearImageInput()">✕ {{ __('messages.remove') }}</span>
                </div>
                <div class="input-group">
                    <textarea name="message" id="messageInput" rows="1" placeholder="{{ __('messages.type_message') }}"></textarea>
                    <button type="button" class="emoji-btn" onclick="toggleEmojiPicker()" title="Emoji"><i class="bi bi-emoji-smile"></i></button>
                    <label class="image-btn" title="{{ __('messages.send_image') }}">
                        <i class="bi bi-image"></i>
                        <input type="file" name="image" accept="image/*" onchange="previewSelectedImage(event)">
                    </label>
                    <button type="submit" class="send-btn" title="{{ __('messages.send') }}"><i class="bi bi-send-fill"></i></button>
                </div>
                @error('message')<div style="color:#f87171; font-size:0.8rem; margin-top:0.3rem;">{{ $message }}</div>@enderror
                @error('image')<div style="color:#f87171; font-size:0.8rem; margin-top:0.3rem;">{{ $message }}</div>@enderror
            </form>
            @else
                <div style="text-align:center; padding:1rem; color:var(--text-muted); background:var(--bg-card); border:1px solid var(--border-color); border-radius:var(--radius-lg);">
                    <i class="bi bi-lock-fill me-1"></i> {{ __('messages.conversation_closed') }}
                </div>
            @endif

        </div>
    </div>
</div>

<script>
    function toggleEmojiPicker() {
        document.getElementById('emojiPicker').classList.toggle('open');
    }
    function insertEmoji(emoji) {
        const input = document.getElementById('messageInput');
        const start = input.selectionStart;
        const end = input.selectionEnd;
        input.value = input.value.substring(0, start) + emoji + input.value.substring(end);
        input.focus();
        input.selectionStart = input.selectionEnd = start + emoji.length;
        autoResize(input);
    }
    function previewSelectedImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }
    function clearImageInput() {
        document.querySelector('input[name="image"]').value = '';
        document.getElementById('imagePreview').style.display = 'none';
        document.getElementById('previewImg').src = '';
    }
    function autoResize(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = Math.min(textarea.scrollHeight, 120) + 'px';
    }
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.getElementById('messageInput');
        if (textarea) {
            textarea.addEventListener('input', function() { autoResize(this); });
        }
        const box = document.getElementById('messagesBox');
        if (box) box.scrollTop = box.scrollHeight;
    });
</script>
@endsection
