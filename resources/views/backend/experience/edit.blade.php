@extends('backend.app')

@section('content')

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-dark text-white rounded-top-4">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil-square me-2"></i>
                        Edit: {{ $experience->position }} @ {{ $experience->company }}
                    </h5>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.experiences.update', $experience->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Company <span class="text-danger">*</span></label>
                                <input type="text" name="company"
                                       class="form-control form-control-lg shadow-sm @error('company') is-invalid @enderror"
                                       value="{{ old('company', $experience->company) }}" required>
                                @error('company')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Position <span class="text-danger">*</span></label>
                                <input type="text" name="position"
                                       class="form-control form-control-lg shadow-sm @error('position') is-invalid @enderror"
                                       value="{{ old('position', $experience->position) }}" required>
                                @error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" rows="4"
                                      class="form-control shadow-sm @error('description') is-invalid @enderror">{{ old('description', $experience->description) }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Start Date <span class="text-danger">*</span></label>
                                <input type="date" name="start_date"
                                       class="form-control form-control-lg shadow-sm @error('start_date') is-invalid @enderror"
                                       value="{{ old('start_date', $experience->start_date ? $experience->start_date->format('Y-m-d') : '') }}" required>
                                @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">End Date</label>
                                <input type="date" name="end_date" id="end_date"
                                       class="form-control form-control-lg shadow-sm @error('end_date') is-invalid @enderror"
                                       value="{{ old('end_date', $experience->end_date ? $experience->end_date->format('Y-m-d') : '') }}"
                                       {{ $experience->is_current ? 'disabled' : '' }}>
                                @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4 mb-3 d-flex align-items-end">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_current" name="is_current"
                                           value="1" {{ old('is_current', $experience->is_current) ? 'checked' : '' }}
                                           onchange="toggleEndDate(this)">
                                    <label class="form-check-label fw-semibold" for="is_current">Currently Working</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Location</label>
                                <input type="text" name="location"
                                       class="form-control shadow-sm @error('location') is-invalid @enderror"
                                       value="{{ old('location', $experience->location) }}">
                                @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-semibold">Sort Order</label>
                                <input type="number" name="sort_order" min="0"
                                       class="form-control shadow-sm @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', $experience->sort_order) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3 mb-3 d-flex align-items-end">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                           {{ old('is_active', $experience->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2 mt-3">
                            <a href="{{ route('admin.experiences.index') }}" class="btn btn-secondary btn-lg rounded-3 px-4">
                                <i class="bi bi-arrow-left me-1"></i> Back
                            </a>
                            <button type="submit" class="btn btn-dark btn-lg rounded-3 shadow-sm flex-grow-1">
                                <i class="bi bi-check-circle me-1"></i>
                                Update Experience
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
function toggleEndDate(checkbox) {
    document.getElementById('end_date').disabled = checkbox.checked;
    if (checkbox.checked) document.getElementById('end_date').value = '';
}
</script>

<style>
.card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
.card:hover { transform: translateY(-3px); box-shadow: 0 12px 24px rgba(0,0,0,0.15); }
@media (prefers-color-scheme: dark) {
    .card { background-color: #1c1c1e; }
    .card-body, .card-header { color: #f1f1f1; }
    input.form-control, textarea.form-control {
        background-color: #2c2c2e; color: #f1f1f1; border-color: #444;
    }
    input.form-control:focus, textarea.form-control:focus {
        background-color: #2c2c2e; color: #f1f1f1; border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13,110,253,.25);
    }
}
</style>

@endsection
