@extends('backend.app')

@section('content')
<style>
.acct-view { font-size: 0.88rem; }
.acct-view .profile-banner {
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a78bfa 100%);
    border-radius: 16px 16px 0 0;
    height: 120px;
    position: relative;
}
.acct-view .profile-banner::after {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.06'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    border-radius: 16px 16px 0 0;
}
.acct-view .avatar-wrap {
    width: 130px; height: 130px;
    margin-top: -65px;
    position: relative;
    z-index: 2;
}
.acct-view .avatar-img {
    width: 130px; height: 130px;
    border: 4px solid #fff;
    border-radius: 50%;
    object-fit: cover;
    box-shadow: 0 4px 20px rgba(99,102,241,0.25);
}
.acct-view .avatar-placeholder {
    width: 130px; height: 130px;
    border: 4px solid #fff;
    border-radius: 50%;
    background: linear-gradient(135deg,#6366f1,#8b5cf6);
    color: #fff;
    font-size: 3.2rem;
    font-weight: 800;
    box-shadow: 0 4px 20px rgba(99,102,241,0.25);
    display: flex; align-items: center; justify-content: center;
}
.acct-view .info-label {
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #94a3b8;
    margin-bottom: 2px;
}
.acct-view .info-value {
    font-size: 0.85rem;
    font-weight: 500;
    color: #1e293b;
    word-break: break-all;
}
.acct-view .social-chip {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    border-radius: 10px;
    font-size: 0.78rem;
    font-weight: 500;
    color: #334155;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    text-decoration: none;
    transition: all 0.2s ease;
}
.acct-view .social-chip:hover {
    background: #f1f5f9;
    border-color: #cbd5e1;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    color: #1e293b;
}
.acct-view .social-chip i,
.acct-view .social-chip svg { font-size: 1rem; }
.acct-view .section-title {
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #94a3b8;
    padding-bottom: 8px;
    border-bottom: 2px solid #f1f5f9;
    margin-bottom: 14px;
}
.acct-view .cv-chip {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 18px;
    border-radius: 10px;
    font-size: 0.78rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s ease;
}
.acct-view .cv-chip.active {
    background: #fef2f2;
    color: #dc2626;
    border: 1px solid #fecaca;
}
.acct-view .cv-chip.active:hover {
    background: #fee2e2;
    transform: translateY(-1px);
}
.acct-view .cv-chip.empty {
    background: #f8fafc;
    color: #94a3b8;
    border: 1px dashed #e2e8f0;
    cursor: default;
}

@media (max-width: 767.98px) {
    .acct-view { font-size: 0.8rem; }
    .acct-view .profile-banner { height: 90px; border-radius: 12px 12px 0 0; }
    .acct-view .avatar-wrap,
    .acct-view .avatar-img { width: 90px; height: 90px; margin-top: -45px; }
    .acct-view .avatar-placeholder { width: 90px; height: 90px; font-size: 2.2rem; border-width: 3px; }
    .acct-view .avatar-img { border-width: 3px; }
    .acct-view .info-value { font-size: 0.78rem; }
    .acct-view .social-chip { padding: 6px 12px; font-size: 0.72rem; gap: 6px; }
    .acct-view .social-chip i { font-size: 0.88rem; }
    .acct-view .cv-chip { padding: 6px 14px; font-size: 0.72rem; }
}
</style>

<div class="container-fluid py-3 acct-view">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="fw-bold mb-0" style="font-size:0.95rem;">
                    <i class="bi bi-person-circle me-2" style="color:#6366f1;"></i>Account Profile
                </h5>
                <a href="{{ route('admin.account.edit') }}" class="btn btn-admin btn-admin-primary" style="font-size:0.78rem; padding:6px 16px;">
                    <i class="bi bi-pencil-square me-1"></i> Edit
                </a>
            </div>

            {{-- Main Card --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-3">
                {{-- Banner --}}
                <div class="profile-banner"></div>

                {{-- Profile Info --}}
                <div class="card-body px-4 pb-4">
                    <div class="d-flex align-items-end gap-4 flex-wrap mb-4">
                        {{-- Avatar --}}
                        <div class="avatar-wrap flex-shrink-0">
                            @if(isset($account) && $account->image)
                                <img src="{{ config('app.storage_url') }}{{ $account->image }}"
                                     alt="{{ $account->name ?? 'User' }}" class="avatar-img">
                            @else
                                <div class="avatar-placeholder">
                                    {{ isset($account->name) ? strtoupper(substr($account->name, 0, 1)) : 'U' }}
                                </div>
                            @endif
                        </div>

                        {{-- Name & Actions --}}
                        <div class="flex-grow-1 pb-1">
                            <h4 class="fw-bold mb-1" style="font-size:1.1rem; line-height:1.3;">
                                {{ $account->name ?? 'Not set' }}
                            </h4>
                            @if(isset($account) && $account->email)
                                <span class="text-muted" style="font-size:0.78rem;">
                                    <i class="bi bi-envelope me-1"></i>{{ $account->email }}
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Info Grid --}}
                    <div class="row g-3 mb-4">
                        @if(isset($account) && $account->name)
                        <div class="col-sm-4 col-6">
                            <div class="info-label">Full Name</div>
                            <div class="info-value">{{ $account->name }}</div>
                        </div>
                        @endif
                        @if(isset($account) && $account->email)
                        <div class="col-sm-4 col-6">
                            <div class="info-label">Email</div>
                            <div class="info-value">{{ $account->email }}</div>
                        </div>
                        @endif
                        @if(isset($account) && $account->phone)
                        <div class="col-sm-4 col-6">
                            <div class="info-label">WhatsApp</div>
                            <div class="info-value">{{ $account->phone }}</div>
                        </div>
                        @endif
                    </div>

                    {{-- CV --}}
                    <div class="mb-0">
                        <div class="section-title">CV / Resume</div>
                        @if(isset($account) && $account->cv)
                            <a href="{{ config('app.storage_url') }}{{ $account->cv }}" target="_blank" class="cv-chip active">
                                <i class="bi bi-file-earmark-pdf"></i> View CV
                            </a>
                        @else
                            <span class="cv-chip empty">
                                <i class="bi bi-file-earmark"></i> No CV uploaded
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Social Links --}}
            @if(isset($account) && ($account->github || $account->linkedin || $account->facebook || $account->instagram || $account->twitter || $account->youtube))
            <div class="card border-0 shadow-sm rounded-4 mb-3">
                <div class="card-body px-4 py-3">
                    <div class="section-title">Social Links</div>
                    <div class="d-flex flex-wrap gap-2">
                        @if($account->github)
                            <a href="{{ $account->github }}" target="_blank" class="social-chip">
                                <i class="bi bi-github"></i> GitHub
                            </a>
                        @endif
                        @if($account->linkedin)
                            <a href="{{ $account->linkedin }}" target="_blank" class="social-chip">
                                <i class="bi bi-linkedin" style="color:#0a66c2;"></i> LinkedIn
                            </a>
                        @endif
                        @if($account->facebook)
                            <a href="{{ $account->facebook }}" target="_blank" class="social-chip">
                                <i class="bi bi-facebook" style="color:#1877f2;"></i> Facebook
                            </a>
                        @endif
                        @if($account->instagram)
                            <a href="{{ $account->instagram }}" target="_blank" class="social-chip">
                                <i class="bi bi-instagram" style="color:#E4405F;"></i> Instagram
                            </a>
                        @endif
                        @if($account->twitter)
                            <a href="{{ $account->twitter }}" target="_blank" class="social-chip">
                                <i class="bi bi-twitter-x"></i> Twitter
                            </a>
                        @endif
                        @if($account->youtube)
                            <a href="{{ $account->youtube }}" target="_blank" class="social-chip">
                                <i class="bi bi-youtube" style="color:#dc2626;"></i> YouTube
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            {{-- Freelance Profiles --}}
            @if(isset($account) && ($account->fiverr || $account->upwork || $account->freelancer))
            <div class="card border-0 shadow-sm rounded-4 mb-3">
                <div class="card-body px-4 py-3">
                    <div class="section-title">Freelance Profiles</div>
                    <div class="d-flex flex-wrap gap-2">
                        @if($account->fiverr)
                            <a href="{{ $account->fiverr }}" target="_blank" class="social-chip">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:1em;height:1em"><rect width="24" height="24" rx="5" fill="#1DBF73"/><text x="12" y="17" text-anchor="middle" fill="white" font-weight="700" font-size="14" font-family="Arial,sans-serif">f</text></svg> Fiverr
                            </a>
                        @endif
                        @if($account->upwork)
                            <a href="{{ $account->upwork }}" target="_blank" class="social-chip">
                                <i class="fab fa-upwork" style="color:#6FDA44;"></i> Upwork
                            </a>
                        @endif
                        @if($account->freelancer)
                            <a href="{{ $account->freelancer }}" target="_blank" class="social-chip">
                                <i class="fas fa-user-tie" style="color:#29B2FE;"></i> Freelancer
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection
