@extends('backend.app')

@section('content')
<style>
.edf { font-size: 0.88rem; }
.edf .section-label {
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #94a3b8;
    padding-bottom: 8px;
    border-bottom: 2px solid #f1f5f9;
    margin-bottom: 16px;
}
.edf .form-label {
    font-size: 0.78rem;
    font-weight: 600;
    color: #475569;
    margin-bottom: 4px;
}
.edf .form-control {
    font-size: 0.82rem;
    padding: 8px 12px;
    border-radius: 8px;
    border: 1.5px solid #e2e8f0;
    transition: all 0.2s;
}
.edf .form-control:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
}
.edf .form-text { font-size: 0.7rem; }
.edf .invalid-feedback { font-size: 0.72rem; }
.edf .form-check-input:checked {
    background-color: #6366f1;
    border-color: #6366f1;
}
.edf .btn-submit {
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
.edf .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(99,102,241,0.4);
    color: #fff;
}
.edf .btn-cancel {
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
.edf .btn-cancel:hover {
    background: #f1f5f9;
    color: #334155;
}

@media (max-width: 767.98px) {
    .edf { font-size: 0.8rem; }
    .edf .section-label { font-size: 0.68rem; }
    .edf .form-label { font-size: 0.73rem; }
    .edf .form-control { font-size: 0.76rem; padding: 7px 10px; }
    .edf .form-text { font-size: 0.65rem; }
    .edf .btn-submit { padding: 8px 20px; font-size: 0.76rem; }
    .edf .btn-cancel { padding: 8px 16px; font-size: 0.76rem; }
}
</style>

<div class="container-fluid py-3 edf">
    <div class="row justify-content-center">
        <div class="col-md-11 col-lg-9">

            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h5 class="fw-bold mb-1" style="font-size:0.95rem;">
                        <i class="bi bi-plus-circle me-2" style="color:#6366f1;"></i>Add Qualification
                    </h5>
                    <p class="text-muted small mb-0">Add a new educational qualification to your portfolio.</p>
                </div>
                <a href="{{ route('admin.education.index') }}" class="btn-cancel text-decoration-none">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            <form action="{{ route('admin.education.store') }}" method="POST">
                @csrf

                {{-- Degree & Institution --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-4 py-3">
                        <div class="section-label"><i class="bi bi-mortarboard me-1"></i> Degree & Institution</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="degree_name" class="form-label">Degree Name <span class="text-danger">*</span></label>
                                <input type="text" id="degree_name" name="degree_name"
                                       class="form-control @error('degree_name') is-invalid @enderror"
                                       value="{{ old('degree_name') }}" placeholder="e.g. B.Sc. in Computer Science" required>
                                @error('degree_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="institution" class="form-label">Institution <span class="text-danger">*</span></label>
                                <input type="text" id="institution" name="institution"
                                       class="form-control @error('institution') is-invalid @enderror"
                                       value="{{ old('institution') }}" placeholder="e.g. University of Dhaka" required>
                                @error('institution')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Study Details --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-4 py-3">
                        <div class="section-label"><i class="bi bi-journal-text me-1"></i> Study Details</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="board_or_university" class="form-label">Board / University</label>
                                <input type="text" id="board_or_university" name="board_or_university"
                                       class="form-control @error('board_or_university') is-invalid @enderror"
                                       value="{{ old('board_or_university') }}" placeholder="e.g. Dhaka Board">
                                @error('board_or_university')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="duration" class="form-label">Duration <span class="text-danger">*</span></label>
                                <input type="text" id="duration" name="duration"
                                       class="form-control @error('duration') is-invalid @enderror"
                                       value="{{ old('duration') }}" placeholder="e.g. 2018 - 2022" required>
                                @error('duration')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Result & Settings --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-4 py-3">
                        <div class="section-label"><i class="bi bi-sliders me-1"></i> Result & Settings</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="result" class="form-label">Result / Grade</label>
                                <input type="text" id="result" name="result"
                                       class="form-control @error('result') is-invalid @enderror"
                                       value="{{ old('result') }}" placeholder="e.g. CGPA 3.80 / 4.00">
                                @error('result')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label for="display_order" class="form-label">Display Order</label>
                                <input type="number" id="display_order" name="display_order" min="0"
                                       class="form-control @error('display_order') is-invalid @enderror"
                                       value="{{ old('display_order', 0) }}">
                                @error('display_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3 d-flex align-items-end pb-1">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                           value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-medium" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.education.index') }}" class="btn-cancel text-decoration-none">Cancel</a>
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-circle me-1"></i> Create Qualification
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection