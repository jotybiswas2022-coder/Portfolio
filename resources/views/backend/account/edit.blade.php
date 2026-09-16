@extends('backend.app')

@section('content')
<style>
.acct-edit { font-size: 0.88rem; }
.acct-edit .edit-banner {
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a78bfa 100%);
    border-radius: 16px 16px 0 0;
    height: 80px;
    position: relative;
}
.acct-edit .edit-banner::after {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.06'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    border-radius: 16px 16px 0 0;
}
.acct-edit .avatar-section { margin-top: -40px; position: relative; z-index: 2; }
.acct-edit .avatar-preview {
    width: 100px; height: 100px;
    border: 4px solid #fff;
    border-radius: 50%;
    object-fit: cover;
    box-shadow: 0 4px 20px rgba(99,102,241,0.25);
}
.acct-edit .avatar-placeholder {
    width: 100px; height: 100px;
    border: 4px solid #fff;
    border-radius: 50%;
    background: #f1f5f9;
    color: #94a3b8;
    font-size: 2.4rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    display: flex; align-items: center; justify-content: center;
}
.acct-edit .section-label {
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #94a3b8;
    padding-bottom: 8px;
    border-bottom: 2px solid #f1f5f9;
    margin-bottom: 16px;
}
.acct-edit .form-label {
    font-size: 0.78rem;
    font-weight: 600;
    color: #475569;
    margin-bottom: 4px;
}
.acct-edit .form-label i {
    font-size: 0.85rem;
    margin-right: 2px;
}
.acct-edit .form-control,
.acct-edit .form-select {
    font-size: 0.82rem;
    padding: 8px 12px;
    border-radius: 8px;
    border: 1.5px solid #e2e8f0;
    transition: all 0.2s;
}
.acct-edit .form-control:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
}
.acct-edit .form-text {
    font-size: 0.7rem;
    color: #94a3b8;
}
.acct-edit .social-input-group {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 12px 14px;
    transition: all 0.2s;
}
.acct-edit .social-input-group:focus-within {
    background: #fff;
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99,102,241,0.08);
}
.acct-edit .social-input-group .input-icon {
    width: 32px; height: 32px;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.95rem;
    flex-shrink: 0;
}
.acct-edit .social-input-group .form-control {
    border: none;
    background: transparent;
    padding: 4px 0;
    font-size: 0.8rem;
}
.acct-edit .social-input-group .form-control:focus {
    box-shadow: none;
}
.acct-edit .btn-submit {
    background: linear-gradient(135deg, #6366f1, #4f46e5);
    color: #fff;
    border: none;
    padding: 10px 28px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.82rem;
    box-shadow: 0 4px 15px rgba(99,102,241,0.3);
    transition: all 0.2s;
}
.acct-edit .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(99,102,241,0.4);
    color: #fff;
}
.acct-edit .btn-cancel {
    padding: 10px 22px;
    border-radius: 10px;
    font-weight: 500;
    font-size: 0.82rem;
    color: #64748b;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    transition: all 0.2s;
}
.acct-edit .btn-cancel:hover {
    background: #f1f5f9;
    color: #334155;
}
.acct-edit .form-check-input:checked {
    background-color: #ef4444;
    border-color: #ef4444;
}

@media (max-width: 767.98px) {
    .acct-edit { font-size: 0.8rem; }
    .acct-edit .edit-banner { height: 60px; border-radius: 12px 12px 0 0; }
    .acct-edit .avatar-preview,
    .acct-edit .avatar-placeholder { width: 80px; height: 80px; font-size: 1.8rem; border-width: 3px; }
    .acct-edit .form-label { font-size: 0.73rem; }
    .acct-edit .form-control { font-size: 0.76rem; padding: 7px 10px; }
    .acct-edit .form-text { font-size: 0.65rem; }
    .acct-edit .social-input-group { padding: 10px 12px; }
    .acct-edit .social-input-group .input-icon { width: 28px; height: 28px; font-size: 0.85rem; }
    .acct-edit .social-input-group .form-control { font-size: 0.74rem; }
    .acct-edit .btn-submit { padding: 8px 20px; font-size: 0.76rem; }
    .acct-edit .btn-cancel { padding: 8px 16px; font-size: 0.76rem; }
}
</style>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show alert-modern mx-3" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="container-fluid py-3 acct-edit">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="fw-bold mb-0" style="font-size:0.95rem;">
                    <i class="bi bi-pencil-square me-2" style="color:#6366f1;"></i>Edit Account
                </h5>
                <a href="{{ route('admin.account.index') }}" class="btn-cancel text-decoration-none">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            {{-- Delete Image Form (hidden, outside main form) --}}
            @if(isset($account) && $account->image)
                <form action="{{ route('admin.account.deleteImage') }}" method="POST" id="deleteImageForm" style="display:none;">
                    @csrf
                </form>
            @endif

            <form action="{{ route('admin.account.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Profile Card --}}
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-3">
                    <div class="edit-banner"></div>
                    <div class="card-body px-4 pb-4">
                        <div class="avatar-section d-flex align-items-end gap-4 flex-wrap mb-4">
                            <div class="flex-shrink-0">
                                <img id="preview"
                                     @if(isset($account) && $account->image) src="{{ asset('storage/' . $account->image) }}" @endif
                                     class="avatar-preview"
                                     style="{{ !isset($account) || !$account->image ? 'display:none' : '' }}">
                                <div id="previewPlaceholder"
                                     @if(isset($account) && $account->image) style="display:none;" @endif
                                     class="avatar-placeholder">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <input type="file" accept="image/*" id="image" name="image"
                                       class="form-control" onchange="previewImage(event)">
                                <div class="form-text mt-1">Recommended: Square image, at least 200x200px.</div>
                                @if(isset($account) && $account->image)
                                    <button type="button" onclick="confirmDeleteImage()" class="btn btn-sm mt-2" style="color:#ef4444; font-size:0.75rem; padding:4px 10px; border:1px dashed #fecaca; border-radius:8px; background:#fef2f2;">
                                        <i class="bi bi-trash3 me-1"></i> Remove
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Basic Info --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-4 py-3">
                        <div class="section-label">Basic Information</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control"
                                       value="{{ $account->name ?? '' }}" placeholder="Enter your full name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">
                                    <i class="bi bi-envelope" style="color:#6366f1;"></i> Email
                                </label>
                                <input type="email" id="email" name="email" class="form-control"
                                       value="{{ $account->email ?? '' }}" placeholder="hello@example.com">
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">
                                    <i class="bi bi-whatsapp" style="color:#25D366;"></i> WhatsApp
                                </label>
                                <input type="text" id="phone" name="phone" class="form-control"
                                       value="{{ $account->phone ?? '' }}" placeholder="+8801XXXXXXXXX">
                                <div class="form-text">Used for the WhatsApp floating button.</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Social Links --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-4 py-3">
                        <div class="section-label">Social Links</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label"><i class="bi bi-github"></i> GitHub</label>
                                <div class="social-input-group d-flex align-items-center gap-2">
                                    <div class="input-icon"><i class="bi bi-github"></i></div>
                                    <input type="url" name="github" class="form-control"
                                           value="{{ $account->github ?? '' }}" placeholder="https://github.com/username">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><i class="bi bi-linkedin" style="color:#0a66c2;"></i> LinkedIn</label>
                                <div class="social-input-group d-flex align-items-center gap-2">
                                    <div class="input-icon"><i class="bi bi-linkedin" style="color:#0a66c2;"></i></div>
                                    <input type="url" name="linkedin" class="form-control"
                                           value="{{ $account->linkedin ?? '' }}" placeholder="https://linkedin.com/in/username">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><i class="bi bi-facebook" style="color:#1877f2;"></i> Facebook</label>
                                <div class="social-input-group d-flex align-items-center gap-2">
                                    <div class="input-icon"><i class="bi bi-facebook" style="color:#1877f2;"></i></div>
                                    <input type="url" name="facebook" class="form-control"
                                           value="{{ $account->facebook ?? '' }}" placeholder="https://facebook.com/username">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><i class="bi bi-instagram" style="color:#E4405F;"></i> Instagram</label>
                                <div class="social-input-group d-flex align-items-center gap-2">
                                    <div class="input-icon"><i class="bi bi-instagram" style="color:#E4405F;"></i></div>
                                    <input type="url" name="instagram" class="form-control"
                                           value="{{ $account->instagram ?? '' }}" placeholder="https://instagram.com/username">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><i class="bi bi-twitter-x"></i> Twitter / X</label>
                                <div class="social-input-group d-flex align-items-center gap-2">
                                    <div class="input-icon"><i class="bi bi-twitter-x"></i></div>
                                    <input type="url" name="twitter" class="form-control"
                                           value="{{ $account->twitter ?? '' }}" placeholder="https://twitter.com/username">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><i class="bi bi-youtube" style="color:#dc2626;"></i> YouTube</label>
                                <div class="social-input-group d-flex align-items-center gap-2">
                                    <div class="input-icon"><i class="bi bi-youtube" style="color:#dc2626;"></i></div>
                                    <input type="url" name="youtube" class="form-control"
                                           value="{{ $account->youtube ?? '' }}" placeholder="https://youtube.com/@channel">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Freelance Profiles --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-4 py-3">
                        <div class="section-label"><i class="bi bi-briefcase me-1"></i> Freelance Profiles</div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:1em;height:1em;vertical-align:middle;margin-right:2px"><rect width="24" height="24" rx="5" fill="#1DBF73"/><text x="12" y="17" text-anchor="middle" fill="white" font-weight="700" font-size="14" font-family="Arial,sans-serif">f</text></svg> Fiverr
                                </label>
                                <div class="social-input-group d-flex align-items-center gap-2">
                                    <div class="input-icon" style="background:#f0fdf4;">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:1.1em;height:1.1em"><rect width="24" height="24" rx="5" fill="#1DBF73"/><text x="12" y="17" text-anchor="middle" fill="white" font-weight="700" font-size="14" font-family="Arial,sans-serif">f</text></svg>
                                    </div>
                                    <input type="url" name="fiverr" class="form-control"
                                           value="{{ $account->fiverr ?? '' }}" placeholder="fiverr.com/username">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label"><i class="fab fa-upwork" style="color:#6FDA44;"></i> Upwork</label>
                                <div class="social-input-group d-flex align-items-center gap-2">
                                    <div class="input-icon" style="background:#f0fdf4;"><i class="fab fa-upwork" style="color:#6FDA44;"></i></div>
                                    <input type="url" name="upwork" class="form-control"
                                           value="{{ $account->upwork ?? '' }}" placeholder="upwork.com/freelancers/you">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label"><i class="fas fa-user-tie" style="color:#29B2FE;"></i> Freelancer</label>
                                <div class="social-input-group d-flex align-items-center gap-2">
                                    <div class="input-icon" style="background:#eff6ff;"><i class="fas fa-user-tie" style="color:#29B2FE;"></i></div>
                                    <input type="url" name="freelancer" class="form-control"
                                           value="{{ $account->freelancer ?? '' }}" placeholder="freelancer.com/u/username">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CV Upload --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-4 py-3">
                        <div class="section-label"><i class="bi bi-file-earmark-pdf me-1"></i> CV / Resume</div>
                        <input type="file" accept=".pdf,.doc,.docx" id="cv" name="cv" class="form-control">
                        <div class="form-text mt-1">Maximum 5MB. Accepted formats: PDF, DOC, DOCX.</div>
                        @if(isset($account) && $account->cv)
                            <div class="mt-3 d-flex align-items-center gap-3 flex-wrap">
                                <a href="{{ asset('storage/' . $account->cv) }}" target="_blank"
                                   class="btn btn-sm rounded-3 px-3" style="font-size:0.78rem; color:#6366f1; background:#eef2ff; border:1px solid #c7d2fe;">
                                    <i class="bi bi-eye me-1"></i> View Current CV
                                </a>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remove_cv" id="removeCv" value="1">
                                    <label class="form-check-label" style="font-size:0.75rem; color:#ef4444;" for="removeCv">Remove existing CV</label>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end gap-2 mt-4 mb-3">
                    <a href="{{ route('admin.account.index') }}" class="btn-cancel text-decoration-none">Cancel</a>
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-circle me-1"></i> Update Profile
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
function previewImage(event) {
    var input = event.target;
    var preview = document.getElementById('preview');
    var placeholder = document.getElementById('previewPlaceholder');
    if (input.files && input.files[0]) {
        preview.src = URL.createObjectURL(input.files[0]);
        preview.style.display = 'block';
        if (placeholder) placeholder.style.display = 'none';
    }
}
function confirmDeleteImage() {
    Swal.fire({
        title: 'Delete Profile Picture?',
        text: 'This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#64748b',
        confirmButtonText: '<i class="bi bi-trash3 me-1"></i> Yes, delete!',
        cancelButtonText: '<i class="bi bi-x-lg me-1"></i> Cancel',
        reverseButtons: true,
        customClass: {
            popup: 'rounded-4',
            confirmButton: 'btn btn-danger rounded-3 px-4 py-2',
            cancelButton: 'btn btn-light border rounded-3 px-4 py-2',
        },
        buttonsStyling: false
    }).then(function(result) {
        if (result.isConfirmed) {
            document.getElementById('deleteImageForm').submit();
        }
    });
}
</script>

@endsection
