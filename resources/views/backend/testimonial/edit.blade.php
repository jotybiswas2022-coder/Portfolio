@extends('backend.app')

@section('content')
<style>
.tmf { font-size: 0.88rem; }
.tmf .section-label {
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #94a3b8;
    padding-bottom: 8px;
    border-bottom: 2px solid #f1f5f9;
    margin-bottom: 16px;
}
.tmf .form-label {
    font-size: 0.78rem;
    font-weight: 600;
    color: #475569;
    margin-bottom: 4px;
}
.tmf .form-control {
    font-size: 0.82rem;
    padding: 8px 12px;
    border-radius: 8px;
    border: 1.5px solid #e2e8f0;
    transition: all 0.2s;
}
.tmf .form-control:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
}
.tmf .form-text { font-size: 0.7rem; }
.tmf .invalid-feedback { font-size: 0.72rem; }
.tmf .form-check-input:checked {
    background-color: #6366f1;
    border-color: #6366f1;
}
.tmf .star-btn { font-size: 1.5rem; cursor: pointer; transition: color 0.15s, transform 0.15s; }
.tmf .star-btn:hover { transform: scale(1.1); }
.tmf .avatar-preview {
    width: 80px; height: 80px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
}
.tmf .avatar-preview img { width: 100%; height: 100%; object-fit: cover; }
.tmf .btn-submit {
    background: linear-gradient(135deg, #6366f1, #4f46e5);
    color: #fff;
    border: none;
    padding: 10px 30px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.82rem;
    box-shadow: 0 4px 15px rgba(99,102,241,0.3);
    transition: all 0.2s;
}
.tmf .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(99,102,241,0.4);
    color: #fff;
}
.tmf .btn-cancel {
    padding: 10px 22px;
    border-radius: 10px;
    font-weight: 500;
    font-size: 0.82rem;
    color: #64748b;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    transition: all 0.2s;
    text-decoration: none;
    display: inline-block;
}
.tmf .btn-cancel:hover {
    background: #f1f5f9;
    color: #334155;
}

@media (max-width: 767.98px) {
    .tmf { font-size: 0.8rem; }
    .tmf .section-label { font-size: 0.68rem; }
    .tmf .form-label { font-size: 0.73rem; }
    .tmf .form-control { font-size: 0.76rem; padding: 7px 10px; }
    .tmf .form-text { font-size: 0.65rem; }
    .tmf .star-btn { font-size: 1.25rem; }
    .tmf .btn-submit { padding: 8px 20px; font-size: 0.76rem; }
    .tmf .btn-cancel { padding: 8px 16px; font-size: 0.76rem; }
}
</style>

<div class="container-fluid py-3 tmf">
    <div class="row justify-content-center">
        <div class="col-md-11 col-lg-9">

            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h5 class="fw-bold mb-1" style="font-size:0.95rem;">
                        <i class="bi bi-pencil-square me-2" style="color:#6366f1;"></i>Edit Testimonial
                    </h5>
                    <p class="text-muted small mb-0">Update details for <strong>{{ $testimonial->name }}</strong>.</p>
                </div>
                <a href="{{ route('admin.testimonials.index') }}" class="btn-cancel text-decoration-none">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            {{-- Delete Avatar Form (outside the main form to avoid nested form issue) --}}
            @if($testimonial->avatar)
                <form action="{{ route('admin.testimonials.deleteImage', $testimonial->id) }}" method="POST" id="deleteImageForm" style="display:none;">
                    @csrf
                </form>
            @endif

            <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Client Information --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-4 py-3">
                        <div class="section-label"><i class="bi bi-person me-1"></i> Client Information</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Client Name <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', $testimonial->name) }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label for="designation" class="form-label">Designation</label>
                                <input type="text" id="designation" name="designation"
                                       class="form-control @error('designation') is-invalid @enderror"
                                       value="{{ old('designation', $testimonial->designation) }}" placeholder="e.g. CEO">
                                @error('designation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label for="company" class="form-label">Company</label>
                                <input type="text" id="company" name="company"
                                       class="form-control @error('company') is-invalid @enderror"
                                       value="{{ old('company', $testimonial->company) }}" placeholder="e.g. Acme Inc.">
                                @error('company')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Review --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-4 py-3">
                        <div class="section-label"><i class="bi bi-chat-quote me-1"></i> Review</div>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="message" class="form-label">Review Message <span class="text-danger">*</span></label>
                                <textarea id="message" name="message" rows="4"
                                          class="form-control @error('message') is-invalid @enderror"
                                          required>{{ old('message', $testimonial->message) }}</textarea>
                                @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Rating</label>
                                <div class="star-picker d-flex align-items-center gap-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star-fill star-btn" data-value="{{ $i }}"
                                           style="color: {{ old('rating', $testimonial->rating) >= $i ? '#f59e0b' : '#d1d5db' }};"></i>
                                    @endfor
                                    <input type="hidden" name="rating" id="ratingInput" value="{{ old('rating', $testimonial->rating) }}">
                                </div>
                                @error('rating')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label for="sort_order" class="form-label">Sort Order</label>
                                <input type="number" id="sort_order" name="sort_order" min="0"
                                       class="form-control @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', $testimonial->sort_order) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4 d-flex align-items-end pb-1">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                           {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-medium" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Client Avatar --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-4 py-3">
                        <div class="section-label"><i class="bi bi-image me-1"></i> Client Avatar</div>
                        <div class="d-flex align-items-start gap-3 flex-wrap">
                            <div class="avatar-preview">
                                @if($testimonial->avatar)
                                    <img src="{{ config('app.storage_url') }}{{ $testimonial->avatar }}" alt="{{ $testimonial->name }}">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center" style="background:#f1f5f9; color:#94a3b8; font-size:2rem;">
                                        <i class="bi bi-person"></i>
                                    </div>
                                @endif
                            </div>
                            <div style="min-width:220px;">
                                <input type="file" accept="image/*" id="avatar" name="avatar"
                                       class="form-control @error('avatar') is-invalid @enderror"
                                       onchange="previewImage(event)">
                                @error('avatar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <img id="preview" src="" style="display:none; width:80px; height:80px; object-fit:cover; margin-top:10px;"
                                     class="rounded-circle shadow-sm">
                                @if($testimonial->avatar)
                                    <button type="button" onclick="confirmDeleteImage()" class="btn btn-sm btn-outline-danger rounded-3 mt-2" style="font-size:0.72rem;">
                                        <i class="bi bi-trash3 me-1"></i> Delete Avatar
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.testimonials.index') }}" class="btn-cancel text-decoration-none">Cancel</a>
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-circle me-1"></i> Update Testimonial
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@section('scripts')
<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('preview');
    if (input.files && input.files[0]) {
        preview.src = URL.createObjectURL(input.files[0]);
        preview.style.display = 'block';
    }
}
function confirmDeleteImage() {
    Swal.fire({
        title: 'Delete Client Avatar?',
        text: 'This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#64748b',
        confirmButtonText: '<i class="bi bi-trash3 me-1"></i> Yes, delete it!',
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

document.querySelectorAll('.star-btn').forEach(function(star) {
    star.addEventListener('click', function() {
        var value = parseInt(this.getAttribute('data-value'));
        document.getElementById('ratingInput').value = value;
        document.querySelectorAll('.star-btn').forEach(function(s) {
            var v = parseInt(s.getAttribute('data-value'));
            s.style.color = v <= value ? '#f59e0b' : '#d1d5db';
        });
    });
    star.addEventListener('mouseenter', function() {
        var value = parseInt(this.getAttribute('data-value'));
        document.querySelectorAll('.star-btn').forEach(function(s) {
            var v = parseInt(s.getAttribute('data-value'));
            s.style.color = v <= value ? '#fbbf24' : '#d1d5db';
        });
    });
    star.addEventListener('mouseleave', function() {
        var current = parseInt(document.getElementById('ratingInput').value);
        document.querySelectorAll('.star-btn').forEach(function(s) {
            var v = parseInt(s.getAttribute('data-value'));
            s.style.color = v <= current ? '#f59e0b' : '#d1d5db';
        });
    });
});
</script>
@endsection

@endsection