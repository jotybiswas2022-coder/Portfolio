@extends('backend.app')

@section('content')

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            <div class="card form-card">
                <div class="card-header">
                    <h5><i class="bi bi-plus-circle me-2"></i>Add Work Experience</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.experiences.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Company <span class="text-danger">*</span></label>
                                <input type="text" name="company"
                                       class="form-control form-control-lg shadow-sm @error('company') is-invalid @enderror"
                                       value="{{ old('company') }}" placeholder="e.g. Google Inc." required>
                                @error('company')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Position <span class="text-danger">*</span></label>
                                <input type="text" name="position"
                                       class="form-control form-control-lg shadow-sm @error('position') is-invalid @enderror"
                                       value="{{ old('position') }}" placeholder="e.g. Senior Developer" required>
                                @error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" rows="4"
                                      class="form-control shadow-sm @error('description') is-invalid @enderror"
                                      placeholder="Describe your responsibilities and achievements...">{{ old('description') }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Start Date <span class="text-danger">*</span></label>
                                <input type="date" name="start_date"
                                       class="form-control form-control-lg shadow-sm @error('start_date') is-invalid @enderror"
                                       value="{{ old('start_date') }}" required>
                                @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">End Date</label>
                                <input type="date" name="end_date" id="end_date"
                                       class="form-control form-control-lg shadow-sm @error('end_date') is-invalid @enderror"
                                       value="{{ old('end_date') }}">
                                <div class="form-text">Leave blank if currently working</div>
                                @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4 mb-3 d-flex align-items-end">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_current" name="is_current"
                                           value="1" onchange="toggleEndDate(this)">
                                    <label class="form-check-label fw-semibold" for="is_current">Currently Working</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Location</label>
                                <input type="text" name="location"
                                       class="form-control shadow-sm @error('location') is-invalid @enderror"
                                       value="{{ old('location') }}" placeholder="e.g. Dhaka, Bangladesh">
                                @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-semibold">Sort Order</label>
                                <input type="number" name="sort_order" min="0"
                                       class="form-control shadow-sm @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', 0) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3 mb-3 d-flex align-items-end">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                                    <label class="form-check-label fw-semibold" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2 mt-3">
                            <a href="{{ route('admin.experiences.index') }}" class="btn btn-secondary btn-lg rounded-3 px-4">
                                <i class="bi bi-arrow-left me-1"></i> Back
                            </a>
                            <button type="submit" class="btn btn-dark btn-lg rounded-3 shadow-sm flex-grow-1">
                                <i class="bi bi-check-circle me-1"></i> Create Experience
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

@endsection
