@extends('backend.app')

@section('content')

<div class="container-fluid py-3 py-md-4">

    {{-- Header --}}
    <div style="margin-bottom:24px;">
        <h4 style="margin:0;font-weight:800;font-size:1.5rem;background:linear-gradient(135deg,#667eea,#764ba2);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
            <i class="bi bi-person-circle me-2" style="-webkit-text-fill-color:#667eea;"></i>Account Profile
        </h4>
    </div>

    {{-- Profile Card --}}
    <div style="display:flex;justify-content:center;">
        <div style="width:100%;max-width:720px;">
            <div style="background:#fff;border-radius:24px;box-shadow:0 8px 40px rgba(0,0,0,0.07);border:1px solid rgba(0,0,0,0.04);overflow:hidden;">
                <div style="height:4px;background:linear-gradient(90deg,#667eea,#764ba2,#f093fb,#667eea);"></div>
                <div style="padding:32px 28px;display:flex;align-items:center;gap:28px;flex-wrap:wrap;">

                    {{-- Avatar --}}
                    <div style="flex-shrink:0;">
                        @if(isset($account) && $account->image)
                            <img src="{{ config('app.storage_url') }}{{ $account->image }}"
                                 alt="{{ $account->name ?? 'User' }}"
                                 style="width:110px;height:110px;border-radius:50%;object-fit:cover;border:3px solid #667eea;box-shadow:0 8px 24px rgba(102,126,234,0.2);display:block;">
                        @else
                            <div style="width:110px;height:110px;border-radius:50%;background:linear-gradient(135deg,#667eea,#764ba2);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:2.5rem;border:3px solid rgba(255,255,255,0.3);box-shadow:0 8px 24px rgba(102,126,234,0.2);">
                                {{ isset($account->name) ? strtoupper(substr($account->name, 0, 1)) : 'U' }}
                            </div>
                        @endif
                    </div>

                    {{-- Info --}}
                    <div style="flex:1;min-width:200px;">
                        <h4 style="margin:0 0 12px;font-weight:700;font-size:1.3rem;color:#222;">{{ $account->name ?? 'Not set' }}</h4>

                        <div style="display:flex;flex-direction:column;gap:8px;">
                            <div style="display:flex;align-items:center;gap:8px;font-size:0.88rem;">
                                <span style="display:inline-flex;align-items:center;justify-content:center;width:28px;height:28px;border-radius:8px;background:rgba(102,126,234,0.1);color:#667eea;flex-shrink:0;">
                                    <i class="bi bi-telephone" style="font-size:0.75rem;"></i>
                                </span>
                                <span style="font-weight:600;color:#888;margin-right:4px;">Phone:</span>
                                <span style="color:#555;">{{ $account->phone ?? 'Not set' }}</span>
                            </div>

                            <div style="display:flex;align-items:center;gap:8px;font-size:0.88rem;">
                                <span style="display:inline-flex;align-items:center;justify-content:center;width:28px;height:28px;border-radius:8px;background:rgba(240,147,251,0.1);color:#f093fb;flex-shrink:0;">
                                    <i class="bi bi-envelope" style="font-size:0.75rem;"></i>
                                </span>
                                <span style="font-weight:600;color:#888;margin-right:4px;">Email:</span>
                                <span style="color:#555;word-break:break-all;">{{ $account->email ?? 'Not set' }}</span>
                            </div>

                            <div style="display:flex;align-items:center;gap:8px;font-size:0.88rem;">
                                <span style="display:inline-flex;align-items:center;justify-content:center;width:28px;height:28px;border-radius:8px;background:rgba(79,172,254,0.1);color:#4facfe;flex-shrink:0;">
                                    <i class="bi bi-globe" style="font-size:0.75rem;"></i>
                                </span>
                                <span style="font-weight:600;color:#888;margin-right:4px;">Website:</span>
                                @if(!empty($account->website))
                                    <a href="{{ $account->website }}" target="_blank" style="color:#667eea;text-decoration:none;font-weight:500;word-break:break-all;">{{ $account->website }}</a>
                                @else
                                    <span style="color:#555;">Not set</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Edit Button --}}
                    <div style="flex-shrink:0;width:100%;text-align:center;@media(min-width:768px){width:auto}">
                        <a href="{{ url('/admin/account/edit') }}"
                           style="display:inline-flex;align-items:center;gap:8px;padding:12px 28px;border-radius:50px;background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;text-decoration:none;font-weight:600;font-size:0.9rem;box-shadow:0 6px 20px rgba(102,126,234,0.3);transition:all 0.3s;"
                           onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 10px 32px rgba(102,126,234,0.4)'"
                           onmouseout="this.style.transform='';this.style.boxShadow='0 6px 20px rgba(102,126,234,0.3)'">
                            <i class="bi bi-pencil-square"></i> Edit Account
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<style>
@media (max-width: 768px) {
    .container-fluid { padding-left: 10px !important; padding-right: 10px !important; }
}
</style>
@endsection