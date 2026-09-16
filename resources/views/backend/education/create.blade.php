@extends('backend.app')

@section('content')
<style>
.education-form-page h4 { letter-spacing: -0.3px; }
.education-form-page .text-muted { color: var(--admin-text-muted) !important; }

.form-section .form-label {
    font-size: 0.82rem;
    font-weight: 600;
    color: var(--admin-text);
    margin-bottom: 0.4rem;
}
.form-section .form-control {
    font-size: 0.88rem;
    padding: 0.72rem 0.9rem;
    border-radius: 10px;
    border: 1.5px solid var(--admin-border);
    box-shadow: none;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.form-section .form-control:focus {
    border-color: var(--admin-primary);
    box-shadow: 0 0 0 4px rgba(99,102,241,0.1);
}
.form-section .form-switch .form-check-input {
    width: 2.4em;
    height: 1.3em;
    cursor: pointer;
    border-color: var(--admin-border);
}
.form-section .form-switch .form-check-input:focus { box-shadow: none; }
.form-section .form-switch .form-check-input:checked {
    background-color: var(--admin-primary);
    border-color: var(--admin-primary);
}
.form-icon { color: var(--admin-primary); }

/* Mobile sticky action bar */
.form-actions-bar {
    position: sticky;
    bottom: 0;
    margin: 0 -12px -12px;
    padding: 0.8rem 1rem calc(0.8rem + env(safe-area-inset-bottom));
    background: rgba(255,255,255,0.92);
    backdrop-filter: blur(8px);
    border-top: 1px solid var(--admin-border);
    display: flex;
    align-items: center;
    gap: 0.6rem;
}
.form-actions-bar .btn { flex: 1; white-space: nowrap; }
.form-actions-bar .btn-outline { flex: 0 0 auto; }

@media (max-width: 767.98px) {
    .education-form-page .form-card { border-radius: 14px; }
    .form-section .form-label { font-size: 0.78rem; }
    .form-section .form-control { font-size: 0.95rem; padding: 0.8rem 0.9rem; }
    .form-section .form-text { font-size: 0.7rem; }
}
</style>

<div class="container-fluid py-3 education-form-page">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">

            {{-- Header --}}
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-4">
                <div>
                    <h4 class="fw-bold mb-1"><i class="bi bi-plus-circle me-2 form-icon"></i>Add New Qualification</h4>
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

                {{-- Actions: sticky bottom bar on mobile, inline on desktop --}}
                <div class="d-none d-md-flex justify-content-end gap-2 slide-up" style="animation-delay:0.15s;">
                    <a href="{{ route('admin.education.index') }}" class="btn btn-admin btn-admin-outline">Cancel</a>
                    <button type="submit" class="btn btn-admin btn-admin-primary px-4">
                        <i class="bi bi-check-circle me-1"></i> Create Qualification
                    </button>
                </div>

                <div class="form-actions-bar d-md-none">
                    <a href="{{ route('admin.education.index') }}" class="btn btn-light border btn-outline">
                        <i class="bi bi-x-lg me-1"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-admin btn-admin-primary">
                        <i class="bi bi-check-circle me-1"></i> Create Qualification
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection