@extends('backend.app')

@section('content')
<style>
.form-section .form-label {
    font-size: 0.82rem;
    font-weight: 600;
    color: var(--admin-text);
    margin-bottom: 0.35rem;
}
.form-section .form-control {
    font-size: 0.85rem;
    padding: 0.6rem 0.85rem;
    border-radius: 8px;
}
.form-section .form-switch .form-check-input { cursor: pointer; }
.form-section .form-switch .form-check-input:checked {
    background-color: var(--admin-primary);
    border-color: var(--admin-primary);
}
@media (max-width: 575.98px) {
    .form-section .form-label { font-size: 0.76rem; }
    .form-section .form-control { font-size: 0.8rem; padding: 0.55rem 0.75rem; }
    .form-section .form-text { font-size: 0.68rem; }
}
</style>

<div class="container-fluid py-3">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">

            {{-- Header --}}
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-4">
                <div>
                    <h4 class="fw-bold mb-1"><i class="bi bi-plus-circle me-2" style="color:var(--admin-primary);"></i>Add New Qualification</h4>
                    <p class="text-muted small mb-0">Add a new educational qualification to your portfolio.</p>
                </div>
                <a href="{{ route('admin.education.index') }}" class="btn btn-admin btn-admin-outline">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            <form action="{{ route('admin.education.store') }}" method="POST">
                @csrf

                <div class="form-card mb-4 slide-up">
                    <div class="card-header">
                        <h5><i class="bi bi-info-circle me-2"></i>Qualification Information</h5>
                    </div>
                    <div class="card-body form-section">
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label class="form-label">Degree Name <span class="text-danger">*</span></label>
                                <input type="text" name="degree_name"
                                       class="form-control @error('degree_name') is-invalid @enderror"
                                       value="{{ old('degree_name') }}" placeholder="e.g. B.Sc. in Computer Science" required>
                                @error('degree_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label">Institution <span class="text-danger">*</span></label>
                                <input type="text" name="institution"
                                       class="form-control @error('institution') is-invalid @enderror"
                                       value="{{ old('institution') }}" placeholder="e.g. University of Dhaka" required>
                                @error('institution')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label">Board / University</label>
                                <input type="text" name="board_or_university"
                                       class="form-control @error('board_or_university') is-invalid @enderror"
                                       value="{{ old('board_or_university') }}" placeholder="e.g. Dhaka Board">
                                @error('board_or_university')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label">Duration <span class="text-danger">*</span></label>
                                <input type="text" name="duration"
                                       class="form-control @error('duration') is-invalid @enderror"
                                       value="{{ old('duration') }}" placeholder="e.g. 2018 - 2022" required>
                                @error('duration')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label">Result / Grade</label>
                                <input type="text" name="result"
                                       class="form-control @error('result') is-invalid @enderror"
                                       value="{{ old('result') }}" placeholder="e.g. CGPA 3.80 / 4.00">
                                @error('result')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="form-label">Display Order</label>
                                <input type="number" name="display_order" min="0"
                                       class="form-control @error('display_order') is-invalid @enderror"
                                       value="{{ old('display_order', 0) }}">
                                @error('display_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-6 col-md-3 d-flex align-items-end pb-1">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                                    <label class="form-check-label fw-medium" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 slide-up" style="animation-delay:0.15s;">
                    <a href="{{ route('admin.education.index') }}" class="btn btn-admin btn-admin-outline">Cancel</a>
                    <button type="submit" class="btn btn-admin btn-admin-primary px-4">
                        <i class="bi bi-check-circle me-1"></i> Create Qualification
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection