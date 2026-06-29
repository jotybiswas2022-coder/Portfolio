@extends('backend.app')

@section('content')

@if (session('success'))
    <div style="padding:12px 18px;border-radius:14px;background:linear-gradient(135deg,rgba(67,233,123,0.1),rgba(67,233,123,0.05));border:1px solid rgba(67,233,123,0.2);margin:10px 10px 0;display:flex;align-items:center;gap:8px;font-size:0.88rem;color:#2d7d4a;">
        <i class="bi bi-check-circle" style="color:#43e97b;"></i>
        <span style="flex:1;">{{ session('success') }}</span>
        <button onclick="this.parentElement.remove()" style="background:none;border:none;color:#999;cursor:pointer;font-size:1.1rem;">&times;</button>
    </div>
@endif

<div class="container-fluid py-3 py-md-4">

    {{-- Header --}}
    <div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;margin-bottom:20px;gap:12px;">
        <div>
            <h4 style="margin:0;font-weight:800;font-size:1.5rem;background:linear-gradient(135deg,#4facfe,#667eea);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                <i class="bi bi-chat-dots me-2" style="-webkit-text-fill-color:#4facfe;"></i>Contact Messages
            </h4>
            <div style="margin-top:6px;display:inline-flex;align-items:center;gap:6px;background:linear-gradient(135deg,rgba(79,172,254,0.08),rgba(102,126,234,0.05));padding:6px 16px;border-radius:50px;border:1px solid rgba(79,172,254,0.12);">
                <i class="bi bi-database" style="color:#4facfe;font-size:0.8rem;"></i>
                <span style="color:#4facfe;font-weight:600;font-size:0.8rem;">{{ $contacts->count() }} Messages</span>
            </div>
        </div>
    </div>

    {{-- Messages Table --}}
    <div id="contactTableWrap" style="background:#fff;border-radius:20px;box-shadow:0 4px 24px rgba(0,0,0,0.06);overflow:auto;border:1px solid rgba(0,0,0,0.04);">
        {{-- Header --}}
        <div style="display:flex;align-items:center;padding:12px 22px;background:linear-gradient(135deg,#f8f9ff,#f0f1fe);border-bottom:1px solid #f0f0f5;gap:10px;min-width:650px;">
            <div style="width:36px;flex-shrink:0;font-size:0.78rem;font-weight:600;color:#888;text-align:center;">#</div>
            <div style="flex:1.5;font-size:0.78rem;font-weight:600;color:#888;">Name</div>
            <div style="flex:2;font-size:0.78rem;font-weight:600;color:#888;">Email</div>
            <div style="flex:1;font-size:0.78rem;font-weight:600;color:#888;text-align:center;">Message</div>
            <div style="flex:1.2;font-size:0.78rem;font-weight:600;color:#888;">Date</div>
            <div style="flex:0.9;font-size:0.78rem;font-weight:600;color:#888;">Time</div>
            <div style="flex:0.8;font-size:0.78rem;font-weight:600;color:#888;text-align:center;">Status</div>
        </div>

        @forelse ($contacts as $contact)
        <div style="display:flex;align-items:center;padding:10px 22px;border-bottom:1px solid #f0f0f5;gap:10px;min-width:650px;transition:background 0.15s;"
             onmouseover="this.style.background='rgba(79,172,254,0.02)'"
             onmouseout="this.style.background='transparent'">

            <div style="width:36px;flex-shrink:0;font-size:0.82rem;color:#bbb;font-weight:500;text-align:center;">{{ $loop->iteration }}</div>

            <div style="flex:1.5;overflow:hidden;">
                <span style="font-weight:600;font-size:0.88rem;color:#222;display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $contact->name }}</span>
            </div>

            <div style="flex:2;overflow:hidden;">
                <span style="font-size:0.82rem;color:#888;display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $contact->email }}</span>
            </div>

            <div style="flex:1;text-align:center;flex-shrink:0;">
                <button data-bs-toggle="modal" data-bs-target="#msgModal{{ $contact->id }}"
                        style="padding:5px 16px;border-radius:50px;border:none;background:linear-gradient(135deg,#4facfe,#667eea);color:#fff;font-size:0.78rem;font-weight:600;cursor:pointer;transition:all 0.3s;box-shadow:0 3px 10px rgba(79,172,254,0.25);"
                        onmouseover="this.style.transform='translateY(-1px)';this.style.boxShadow='0 5px 16px rgba(79,172,254,0.35)'"
                        onmouseout="this.style.transform='';this.style.boxShadow='0 3px 10px rgba(79,172,254,0.25)'">
                    <i class="bi bi-eye me-1" style="font-size:0.7rem;"></i>View
                </button>

                {{-- Modal --}}
                <div class="modal fade" id="msgModal{{ $contact->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content" style="background:#fff;border-radius:20px;border:none;box-shadow:0 24px 80px rgba(0,0,0,0.25);overflow:hidden;">
                            <div style="background:linear-gradient(135deg,#4facfe,#667eea);padding:16px 22px;display:flex;align-items:center;justify-content:space-between;">
                                <h5 style="margin:0;color:#fff;font-weight:600;font-size:0.95rem;">
                                    <i class="bi bi-chat-dots me-2"></i> Message from {{ $contact->name }}
                                </h5>
                                <button type="button" style="background:none;border:none;color:#fff;font-size:1.5rem;cursor:pointer;opacity:0.85;line-height:1;padding:0;display:flex;" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="bi bi-x-lg" style="font-size:0.9rem;"></i>
                                </button>
                            </div>
                            <div style="padding:20px 22px;">
                                <div style="display:flex;gap:8px;margin-bottom:14px;flex-wrap:wrap;">
                                    <span style="font-size:0.78rem;padding:4px 14px;border-radius:50px;background:rgba(79,172,254,0.08);color:#4facfe;display:inline-flex;align-items:center;gap:5px;">
                                        <i class="bi bi-person"></i>{{ $contact->name }}
                                    </span>
                                    <span style="font-size:0.78rem;padding:4px 14px;border-radius:50px;background:rgba(102,126,234,0.08);color:#667eea;display:inline-flex;align-items:center;gap:5px;">
                                        <i class="bi bi-envelope"></i>{{ $contact->email }}
                                    </span>
                                    <span style="font-size:0.78rem;padding:4px 14px;border-radius:50px;background:rgba(67,233,123,0.08);color:#2d7d4a;display:inline-flex;align-items:center;gap:5px;">
                                        <i class="bi bi-calendar"></i>{{ \Carbon\Carbon::parse($contact->created_at)->timezone('Asia/Dhaka')->format('d M Y, h:i A') }}
                                    </span>
                                </div>

                                {{-- Conversation Thread --}}
                                @php
                                    $thread = collect([$contact])->concat($contact->replies->sortBy('created_at'));
                                @endphp
                                @foreach ($thread as $entry)
                                    @php $isAdmin = $entry->type === 'reply'; @endphp
                                    <div style="margin-top:12px;border-radius:14px;padding:14px 16px;{{ $isAdmin ? 'background:#f0fdf4;border:1px solid #bbf7d0;' : ($loop->first ? 'background:#fafafe;border:1px solid #f0f0f5;' : 'background:#eff6ff;border:1px solid #bfdbfe;') }}">
                                        <div style="display:flex;align-items:center;gap:6px;margin-bottom:6px;flex-wrap:wrap;">
                                            @if ($isAdmin)
                                                <i class="bi bi-shield-fill-check" style="color:#22c55e;font-size:0.8rem;"></i>
                                                <span style="font-weight:600;font-size:0.78rem;color:#15803d;">{{ __('Admin') }}</span>
                                            @elseif ($loop->first)
                                                <i class="bi bi-person-fill" style="color:#4facfe;font-size:0.8rem;"></i>
                                                <span style="font-weight:600;font-size:0.78rem;color:#4facfe;">{{ $contact->name }}</span>
                                            @else
                                                <i class="bi bi-person-fill" style="color:#3b82f6;font-size:0.8rem;"></i>
                                                <span style="font-weight:600;font-size:0.78rem;color:#1d4ed8;">{{ __('User') }}</span>
                                            @endif
                                            <span style="font-size:0.7rem;color:#aaa;margin-left:auto;">
                                                {{ \Carbon\Carbon::parse($entry->created_at)->timezone('Asia/Dhaka')->format('d M Y, h:i A') }}
                                            </span>
                                        </div>
                                        <p style="margin:0;font-size:0.88rem;color:#444;line-height:1.6;">{{ $entry->message }}</p>
                                    </div>
                                @endforeach

                                <form action="{{ route('contact.reply', $contact->id) }}" method="POST" style="margin-top:16px;">
                                    @csrf
                                    <label for="reply_{{ $contact->id }}" style="display:block;font-size:0.8rem;font-weight:600;color:#555;margin-bottom:6px;">
                                        <i class="bi bi-reply"></i> {{ __('Write a Reply') }}
                                    </label>
                                    <textarea id="reply_{{ $contact->id }}" name="reply" rows="3" style="width:100%;padding:12px 14px;border-radius:12px;border:1.5px solid #e8e8f0;font-size:0.85rem;color:#444;resize:vertical;outline:none;font-family:inherit;transition:border-color 0.2s;" placeholder="{{ __('Type your reply...') }}" required onfocus="this.style.borderColor='#4facfe'" onblur="this.style.borderColor='#e8e8f0'"></textarea>
                                    <div style="display:flex;gap:8px;justify-content:flex-end;margin-top:12px;">
                                        <button type="button" style="padding:8px 24px;border-radius:50px;border:1.5px solid #e8e8f0;background:#fff;color:#888;font-size:0.85rem;font-weight:500;cursor:pointer;transition:all 0.2s;" data-bs-dismiss="modal"
                                                onmouseover="this.style.borderColor='#ccc';this.style.color='#555'"
                                                onmouseout="this.style.borderColor='#e8e8f0';this.style.color='#888'">Close</button>
                                        <button type="submit" style="padding:8px 24px;border-radius:50px;border:none;background:linear-gradient(135deg,#4facfe,#667eea);color:#fff;font-size:0.85rem;font-weight:600;cursor:pointer;transition:all 0.3s;box-shadow:0 3px 10px rgba(79,172,254,0.25);display:inline-flex;align-items:center;gap:6px;"
                                                onmouseover="this.style.transform='translateY(-1px)';this.style.boxShadow='0 5px 16px rgba(79,172,254,0.35)'"
                                                onmouseout="this.style.transform='';this.style.boxShadow='0 3px 10px rgba(79,172,254,0.25)'">
                                            <i class="bi bi-send-fill" style="font-size:0.75rem;"></i> {{ $contact->reply ? __('Send Another Reply') : __('Send Reply') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="flex:1.2;overflow:hidden;">
                <span style="font-size:0.82rem;color:#666;display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ \Carbon\Carbon::parse($contact->created_at)->timezone('Asia/Dhaka')->format('d M Y') }}</span>
            </div>

            <div style="flex:0.9;overflow:hidden;">
                <span style="font-size:0.82rem;color:#999;display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ \Carbon\Carbon::parse($contact->created_at)->timezone('Asia/Dhaka')->format('h:i A') }}</span>
            </div>

            <div style="flex:0.8;text-align:center;">
                @if($contact->reply)
                    <span style="display:inline-flex;align-items:center;gap:3px;padding:3px 12px;border-radius:50px;background:rgba(67,233,123,0.1);color:#2d7d4a;font-size:0.72rem;font-weight:600;">
                        <i class="bi bi-check-circle-fill" style="font-size:0.6rem;"></i> Replied
                    </span>
                @else
                    <span style="display:inline-flex;align-items:center;gap:3px;padding:3px 12px;border-radius:50px;background:rgba(255,159,67,0.1);color:#cc7a2a;font-size:0.72rem;font-weight:600;">
                        <i class="bi bi-clock" style="font-size:0.6rem;"></i> Pending
                    </span>
                @endif
            </div>
        </div>
        @empty
        <div style="text-align:center;padding:60px 22px;">
            <i class="bi bi-inbox" style="font-size:3rem;color:#ddd;display:block;margin-bottom:10px;"></i>
            <span style="font-weight:600;font-size:1rem;color:#999;display:block;">No Messages Found</span>
            <p style="margin:6px 0 0;font-size:0.85rem;color:#bbb;">Customer messages will appear here once submitted.</p>
        </div>
        @endforelse
    </div>

</div>

{{-- Top Scrollbar + Responsive --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    var tw = document.getElementById('contactTableWrap');
    if (tw) {
        var ts = document.createElement('div');
        ts.style.cssText = 'overflow-x:auto;overflow-y:hidden;height:10px;visibility:visible;margin-bottom:1px;';
        ts.innerHTML = '<div style="height:1px"></div>';
        tw.parentNode.insertBefore(ts, tw);
        var ti = ts.firstChild;
        function sw() { ti.style.width = tw.scrollWidth + 'px'; }
        sw();
        ts.addEventListener('scroll', function () { tw.scrollLeft = ts.scrollLeft; });
        tw.addEventListener('scroll', function () { ts.scrollLeft = tw.scrollLeft; });
        window.addEventListener('resize', sw);
        if (window.ResizeObserver) { new ResizeObserver(sw).observe(tw); }
    }
});
</script>

<style>
#contactTableWrap + div::-webkit-scrollbar { height: 10px; background: #f1f1f1; border-radius: 5px; }
#contactTableWrap + div::-webkit-scrollbar-thumb { background: #c1c1c1; border-radius: 5px; }
#contactTableWrap + div::-webkit-scrollbar-thumb:hover { background: #a0a0a0; }
#contactTableWrap + div { scrollbar-width: auto; scrollbar-color: #c1c1c1 #f1f1f1; }
@media (max-width: 575.98px) {
    #contactTableWrap + div { display: none; }
    .container-fluid { padding-left: 10px !important; padding-right: 10px !important; }
}
</style>

@endsection