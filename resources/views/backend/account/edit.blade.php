@extends('backend.app')

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show alert-modern mx-3" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            <div class="card form-card">
                <div class="card-header">
                    <h5><i class="bi bi-person-plus me-2"></i>Edit Account</h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('/admin/account/update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Name</label>
                            <input type="text" id="name" name="name"
                                   class="form-control form-control-lg shadow-sm"
                                   value="{{ $account->name ?? '' }}"
                                   placeholder="Enter name" required>
                        </div>

                        <!-- Phone / WhatsApp -->
                        <div class="mb-3">
                            <label for="phone" class="form-label fw-semibold">
                                <i class="bi bi-whatsapp text-success me-1"></i> WhatsApp Number
                            </label>
                            <input type="text" id="phone" name="phone"
                                   class="form-control form-control-lg shadow-sm"
                                   value="{{ $account->phone ?? '' }}"
                                   placeholder="e.g. +8801XXXXXXXXX">
                            <div class="form-text">This number will be used for the WhatsApp floating button.</div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="email" id="email" name="email"
                                   class="form-control form-control-lg shadow-sm"
                                   value="{{ $account->email ?? '' }}"
                                   placeholder="e.g. hello@example.com">
                        </div>

                        <!-- Profile Picture -->
                        <div class="mb-4">
                            <label for="image" class="form-label fw-semibold">Profile Picture</label>
                            <input type="file" accept="image/*" id="image" name="image"
                                   class="form-control shadow-sm" onchange="previewImage(event)">
                            <div class="mt-3 text-center">
                                <img id="preview"
                                     @if(isset($account) && $account->image)
                                         src="{{ config('app.storage_url') }}{{ $account->image }}" 
                                         style="display:block;"
                                     @else
                                         src=""
                                         style="display:none;"
                                     @endif
                                     class="img-fluid rounded-circle shadow-sm"
                                     style="max-width:120px; max-height:120px; object-fit:cover;">
                            </div>
                        </div>

                        <!-- Social Media Links -->
                        <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: #f8fafc;">
                            <div class="card-header" style="background: linear-gradient(135deg, #1e293b, #334155); color: #fff; border-radius: 12px 12px 0 0;">
                                <h6 class="mb-0"><i class="bi bi-share me-2"></i>Social Media Links</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="github" class="form-label fw-semibold"><i class="bi bi-github me-1"></i> GitHub</label>
                                    <input type="url" id="github" name="github" class="form-control shadow-sm"
                                           value="{{ $account->github ?? '' }}" placeholder="https://github.com/username">
                                </div>
                                <div class="mb-3">
                                    <label for="linkedin" class="form-label fw-semibold"><i class="bi bi-linkedin me-1"></i> LinkedIn</label>
                                    <input type="url" id="linkedin" name="linkedin" class="form-control shadow-sm"
                                           value="{{ $account->linkedin ?? '' }}" placeholder="https://linkedin.com/in/username">
                                </div>
                                <div class="mb-3">
                                    <label for="facebook" class="form-label fw-semibold"><i class="bi bi-facebook me-1"></i> Facebook</label>
                                    <input type="url" id="facebook" name="facebook" class="form-control shadow-sm"
                                           value="{{ $account->facebook ?? '' }}" placeholder="https://facebook.com/username">
                                </div>
                                <div class="mb-3">
                                    <label for="twitter" class="form-label fw-semibold"><i class="bi bi-twitter-x me-1"></i> Twitter / X</label>
                                    <input type="url" id="twitter" name="twitter" class="form-control shadow-sm"
                                           value="{{ $account->twitter ?? '' }}" placeholder="https://twitter.com/username">
                                </div>
                                <div class="mb-0">
                                    <label for="youtube" class="form-label fw-semibold"><i class="bi bi-youtube me-1 text-danger"></i> YouTube</label>
                                    <input type="url" id="youtube" name="youtube" class="form-control shadow-sm"
                                           value="{{ $account->youtube ?? '' }}" placeholder="https://youtube.com/@channel">
                                </div>
                            </div>
                        </div>

                        <!-- CV Upload -->
                        <div class="mb-4">
                            <label for="cv" class="form-label fw-semibold">
                                <i class="bi bi-file-pdf me-1 text-danger"></i> CV/Resume (PDF, DOC, DOCX)
                            </label>
                            <input type="file" accept=".pdf,.doc,.docx" id="cv" name="cv" class="form-control shadow-sm">
                            <div class="form-text">Maximum file size: 5MB. Allowed formats: PDF, DOC, DOCX.</div>
                            @if(isset($account) && $account->cv)
                                <div class="mt-2 d-flex align-items-center gap-3">
                                    <a href="{{ config('app.storage_url') }}{{ $account->cv }}" 
                                       target="_blank" class="btn btn-sm btn-outline-primary rounded-3">
                                        <i class="bi bi-eye me-1"></i> View Current CV
                                    </a>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remove_cv" id="removeCv" value="1">
                                        <label class="form-check-label text-danger" for="removeCv">Remove CV</label>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Submit -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark btn-lg rounded-3 shadow-sm">
                                <i class="bi bi-check-circle me-1"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('preview');
    if (input.files && input.files[0]) {
        preview.src = URL.createObjectURL(input.files[0]);
        preview.style.display = 'block';
    }
}
</script>

@endsection
