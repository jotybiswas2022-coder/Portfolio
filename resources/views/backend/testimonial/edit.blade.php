@extends('backend.app')

@section('content')

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            <div class="card form-card">
                <div class="card-header">
                    <h5><i class="bi bi-pencil-square me-2"></i>Edit Testimonial: {{ $testimonial->name }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Name -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-semibold">Client Name <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name"
                                       class="form-control shadow-sm @error('name') is-invalid @enderror"
                                       value="{{ old('name', $testimonial->name) }}"
                                       placeholder="e.g. John Doe" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Sort Order -->
                            <div class="col-md-3 mb-3">
                                <label for="sort_order" class="form-label fw-semibold">Sort Order</label>
                                <input type="number" id="sort_order" name="sort_order" min="0"
                                       class="form-control shadow-sm @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', $testimonial->sort_order) }}">
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Rating (Visual Star Picker) -->
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-semibold">Rating</label>
                                <div class="star-picker" id="starPicker">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star-fill star-btn" data-value="{{ $i }}" 
                                           style="color: {{ old('rating', $testimonial->rating) >= $i ? '#f59e0b' : '#d1d5db' }}; font-size: 1.6rem; cursor: pointer; transition: all 0.15s ease;"></i>
                                    @endfor
                                    <input type="hidden" name="rating" id="ratingInput" value="{{ old('rating', $testimonial->rating) }}">
                                </div>
                                @error('rating')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Designation -->
                            <div class="col-md-6 mb-3">
                                <label for="designation" class="form-label fw-semibold">Designation</label>
                                <input type="text" id="designation" name="designation"
                                       class="form-control shadow-sm @error('designation') is-invalid @enderror"
                                       value="{{ old('designation', $testimonial->designation) }}"
                                       placeholder="e.g. CEO">
                                @error('designation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Company -->
                            <div class="col-md-6 mb-3">
                                <label for="company" class="form-label fw-semibold">Company</label>
                                <input type="text" id="company" name="company"
                                       class="form-control shadow-sm @error('company') is-invalid @enderror"
                                       value="{{ old('company', $testimonial->company) }}"
                                       placeholder="e.g. Acme Inc.">
                                @error('company')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Message -->
                        <div class="mb-3">
                            <label for="message" class="form-label fw-semibold">Review Message <span class="text-danger">*</span></label>
                            <textarea id="message" name="message" rows="4"
                                      class="form-control shadow-sm @error('message') is-invalid @enderror"
                                      placeholder="What did the client say about your work?" required>{{ old('message', $testimonial->message) }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row align-items-end">
                            <!-- Avatar -->
                            <div class="col-md-9 mb-3">
                                <label for="avatar" class="form-label fw-semibold">Client Avatar</label>
                                @if($testimonial->avatar)
                                    <div class="mb-2">
                                        <img src="{{ config('app.storage_url') }}{{ $testimonial->avatar }}"
                                             alt="{{ $testimonial->name }}"
                                             class="rounded-circle shadow-sm"
                                             style="width:80px; height:80px; object-fit:cover;">
                                    </div>
                                @endif
                                <input type="file" accept="image/*" id="avatar" name="avatar"
                                       class="form-control shadow-sm @error('avatar') is-invalid @enderror"
                                       onchange="previewImage(event)">
                                @error('avatar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="mt-2">
                                    <img id="preview" src="" style="display:none; width:80px; height:80px; object-fit:cover;"
                                         class="rounded-circle shadow-sm">
                                </div>
                            </div>

                            <!-- Active Status -->
                            <div class="col-md-3 mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                           value="1" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="d-flex gap-2 mt-2">
                            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary btn-lg rounded-3 px-4">
                                <i class="bi bi-arrow-left me-1"></i> Back
                            </a>
                            <button type="submit" class="btn btn-dark btn-lg rounded-3 shadow-sm flex-grow-1">
                                <i class="bi bi-check-circle me-1"></i>
                                Update Testimonial
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

// Star Rating Picker
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
