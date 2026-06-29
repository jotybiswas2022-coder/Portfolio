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
    <div style="margin-bottom:24px;">
        <h4 style="margin:0;font-weight:800;font-size:1.5rem;background:linear-gradient(135deg,#667eea,#764ba2);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
            <i class="bi bi-pencil-square me-2" style="-webkit-text-fill-color:#667eea;"></i>Edit Account
        </h4>
    </div>

    {{-- Form --}}
    <div style="display:flex;justify-content:center;">
        <div style="width:100%;max-width:560px;">
            <div style="background:#fff;border-radius:24px;box-shadow:0 8px 40px rgba(0,0,0,0.07);border:1px solid rgba(0,0,0,0.04);overflow:hidden;">
                <div style="height:4px;background:linear-gradient(90deg,#667eea,#764ba2,#f093fb,#667eea);"></div>
                <div style="padding:28px 30px;">

                    <form action="{{ url('/admin/account/update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Name --}}
                        <div style="margin-bottom:18px;">
                            <label style="display:block;font-size:0.8rem;font-weight:600;color:#555;margin-bottom:5px;">
                                <i class="bi bi-person me-1" style="color:#667eea;"></i> Name
                            </label>
                            <input type="text" name="name" value="{{ $account->name ?? '' }}" placeholder="Enter name" required
                                   style="width:100%;padding:11px 16px;border-radius:14px;border:1.5px solid #e8e8f0;font-size:0.9rem;outline:none;transition:all 0.3s;background:#fafafe;"
                                   onfocus="this.style.borderColor='#667eea';this.style.boxShadow='0 0 0 4px rgba(102,126,234,0.1)'"
                                   onblur="this.style.borderColor='#e8e8f0';this.style.boxShadow='none'">
                        </div>

                        {{-- Phone --}}
                        <div style="margin-bottom:18px;">
                            <label style="display:block;font-size:0.8rem;font-weight:600;color:#555;margin-bottom:5px;">
                                <i class="bi bi-phone me-1" style="color:#f093fb;"></i> Phone Number
                            </label>
                            <input type="text" name="phone" value="{{ $account->phone ?? '' }}" placeholder="Enter phone number"
                                   style="width:100%;padding:11px 16px;border-radius:14px;border:1.5px solid #e8e8f0;font-size:0.9rem;outline:none;transition:all 0.3s;background:#fafafe;"
                                   onfocus="this.style.borderColor='#f093fb';this.style.boxShadow='0 0 0 4px rgba(240,147,251,0.1)'"
                                   onblur="this.style.borderColor='#e8e8f0';this.style.boxShadow='none'">
                        </div>

                        {{-- Email --}}
                        <div style="margin-bottom:18px;">
                            <label style="display:block;font-size:0.8rem;font-weight:600;color:#555;margin-bottom:5px;">
                                <i class="bi bi-envelope me-1" style="color:#4facfe;"></i> Email
                            </label>
                            <input type="email" name="email" value="{{ $account->email ?? '' }}" placeholder="Enter email address"
                                   style="width:100%;padding:11px 16px;border-radius:14px;border:1.5px solid #e8e8f0;font-size:0.9rem;outline:none;transition:all 0.3s;background:#fafafe;"
                                   onfocus="this.style.borderColor='#4facfe';this.style.boxShadow='0 0 0 4px rgba(79,172,254,0.1)'"
                                   onblur="this.style.borderColor='#e8e8f0';this.style.boxShadow='none'">
                        </div>

                        {{-- Website --}}
                        <div style="margin-bottom:18px;">
                            <label style="display:block;font-size:0.8rem;font-weight:600;color:#555;margin-bottom:5px;">
                                <i class="bi bi-globe me-1" style="color:#a18cd1;"></i> Website
                            </label>
                            <input type="url" name="website" value="{{ $account->website ?? '' }}" placeholder="https://example.com"
                                   style="width:100%;padding:11px 16px;border-radius:14px;border:1.5px solid #e8e8f0;font-size:0.9rem;outline:none;transition:all 0.3s;background:#fafafe;"
                                   onfocus="this.style.borderColor='#a18cd1';this.style.boxShadow='0 0 0 4px rgba(161,140,209,0.1)'"
                                   onblur="this.style.borderColor='#e8e8f0';this.style.boxShadow='none'">
                        </div>

                        {{-- Profile Picture --}}
                        <div style="margin-bottom:20px;">
                            <label style="display:block;font-size:0.8rem;font-weight:600;color:#555;margin-bottom:5px;">
                                <i class="bi bi-image me-1" style="color:#43e97b;"></i> Profile Picture
                            </label>
                            <input type="file" accept="image/*" name="image" onchange="previewImage(event)"
                                   style="width:100%;padding:10px 16px;border-radius:14px;border:1.5px solid #e8e8f0;font-size:0.85rem;outline:none;transition:all 0.3s;background:#fafafe;cursor:pointer;"
                                   onfocus="this.style.borderColor='#43e97b';this.style.boxShadow='0 0 0 4px rgba(67,233,123,0.1)'"
                                   onblur="this.style.borderColor='#e8e8f0';this.style.boxShadow='none'">

                            <div style="margin-top:12px;text-align:center;">
                                <img id="preview"
                                     @if(isset($account) && $account->image)
                                         src="{{ config('app.storage_url') }}{{ $account->image }}"
                                         style="width:90px;height:90px;border-radius:50%;object-fit:cover;border:3px solid #667eea;box-shadow:0 6px 20px rgba(102,126,234,0.15);display:inline-block;"
                                     @else
                                         src=""
                                         style="display:none;"
                                     @endif
                                     alt="Preview">
                                <div id="previewFallback" @if(isset($account) && $account->image) style="display:none;" @endif
                                     style="width:90px;height:90px;border-radius:50%;background:linear-gradient(135deg,#667eea,#764ba2);display:inline-flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:2rem;border:3px solid rgba(255,255,255,0.3);box-shadow:0 6px 20px rgba(102,126,234,0.15);margin:0 auto;">
                                    {{ strtoupper(substr($account->name ?? 'U', 0, 1)) }}
                                </div>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <button type="submit"
                                style="width:100%;padding:13px 20px;border-radius:16px;border:none;background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;font-size:0.95rem;font-weight:700;cursor:pointer;transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1);box-shadow:0 6px 20px rgba(102,126,234,0.3);display:flex;align-items:center;justify-content:center;gap:8px;"
                                onmouseover="this.style.transform='translateY(-2px) scale(1.01)';this.style.boxShadow='0 10px 32px rgba(102,126,234,0.4)'"
                                onmouseout="this.style.transform='';this.style.boxShadow='0 6px 20px rgba(102,126,234,0.3)'">
                            <i class="bi bi-check-circle"></i> Update
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

{{-- Image Preview Script --}}
<script>
function previewImage(event) {
    var input = event.target;
    var preview = document.getElementById('preview');
    var fallback = document.getElementById('previewFallback');
    if (input.files && input.files[0]) {
        preview.src = URL.createObjectURL(input.files[0]);
        preview.style.display = 'inline-block';
        if (fallback) fallback.style.display = 'none';
    }
}
</script>

<style>
@media (max-width: 480px) {
    .container-fluid { padding-left: 10px !important; padding-right: 10px !important; }
}
</style>
@endsection