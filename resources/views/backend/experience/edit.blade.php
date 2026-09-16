@extends('backend.app')

@section('content')
<style>
.exf { font-size: 0.88rem; }
.exf .section-label {
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #94a3b8;
    padding-bottom: 8px;
    border-bottom: 2px solid #f1f5f9;
    margin-bottom: 16px;
}
.exf .form-label {
    font-size: 0.78rem;
    font-weight: 600;
    color: #475569;
    margin-bottom: 4px;
}
.exf .form-control {
    font-size: 0.82rem;
    padding: 8px 12px;
    border-radius: 8px;
    border: 1.5px solid #e2e8f0;
    transition: all 0.2s;
}
.exf .form-control:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
}
.exf .form-text { font-size: 0.7rem; }
.exf .invalid-feedback { font-size: 0.72rem; }
.exf .form-check-input:checked {
    background-color: #6366f1;
    border-color: #6366f1;
}
.exf .btn-submit {
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
.exf .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(99,102,241,0.4);
    color: #fff;
}
.exf .btn-cancel {
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
.exf .btn-cancel:hover {
    background: #f1f5f9;
    color: #334155;
}

@media (max-width: 767.98px) {
    .exf { font-size: 0.8rem; }
    .exf .section-label { font-size: 0.68rem; }
    .exf .form-label { font-size: 0.73rem; }
    .exf .form-control { font-size: 0.76rem; padding: 7px 10px; }
    .exf .form-text { font-size: 0.65rem; }
    .exf .btn-submit { padding: 8px 20px; font-size: 0.76rem; }
    .exf .btn-cancel { padding: 8px 16px; font-size: 0.76rem; }
}
</style>

<div class="container-fluid py-3 exf">
    <div class="row justify-content-center">
        <div class="col-md-11 col-lg-9">

            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h5 class="fw-bold mb-1" style="font-size:0.95rem;">
                        <i class="bi bi-briefcase me-2" style="color:#6366f1;"></i>Edit Experience
                    </h5>
                    <p class="text-muted small mb-0">Update details for <strong>{{ $experience->company }}</strong>.</p>
                </div>
                <a href="{{ route('admin.experiences.index') }}" class="btn-cancel text-decoration-none">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            <form action="{{ route('admin.experiences.update', $experience->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Company & Position --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-4 py-3">
                        <div class="section-label"><i class="bi bi-building me-1"></i> Company & Position</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="company" class="form-label">Company <span class="text-danger">*</span></label>
                                <input type="text" id="company" name="company"
                                       class="form-control @error('company') is-invalid @enderror"
                                       value="{{ old('company', $experience->company) }}" required>
                                @error('company')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="position" class="form-label">Position <span class="text-danger">*</span></label>
                                <input type="text" id="position" name="position"
                                       class="form-control @error('position') is-invalid @enderror"
                                       value="{{ old('position', $experience->position) }}" required>
                                @error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" name="description" rows="5"
                                          class="form-control @error('description') is-invalid @enderror"
                                          placeholder="Describe your responsibilities and achievements...">{{ old('description', $experience->description) }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Duration --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-4 py-3">
                        <div class="section-label"><i class="bi bi-calendar3 me-1"></i> Duration</div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="start_date" class="form-label">Start Date <span class="text-danger">*</span></label>
                                <input type="date" id="start_date" name="start_date"
                                       class="form-control @error('start_date') is-invalid @enderror"
                                       value="{{ old('start_date', $experience->start_date ? $experience->start_date->format('Y-m-d') : '') }}" required>
                                @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" id="end_date" name="end_date"
                                       class="form-control @error('end_date') is-invalid @enderror"
                                       value="{{ old('end_date', $experience->end_date ? $experience->end_date->format('Y-m-d') : '') }}"
                                       {{ ($experience->is_current || old('is_current')) ? 'disabled' : '' }}>
                                @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4 d-flex align-items-end pb-1">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_current" name="is_current"
                                           value="1"
                                           {{ old('is_current', $experience->is_current) ? 'checked' : '' }}
                                           onchange="toggleEndDate(this)">
                                    <label class="form-check-label fw-medium" for="is_current">Currently Working</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Location & Settings --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-4 py-3">
                        <div class="section-label"><i class="bi bi-sliders me-1"></i> Location & Settings</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" id="location" name="location"
                                       class="form-control @error('location') is-invalid @enderror"
                                       value="{{ old('location', $experience->location) }}" placeholder="e.g. Dhaka, Bangladesh">
                                @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label for="sort_order" class="form-label">Sort Order</label>
                                <input type="number" id="sort_order" name="sort_order" min="0"
                                       class="form-control @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', $experience->sort_order) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3 d-flex align-items-end pb-1">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                           value="1" {{ old('is_active', $experience->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-medium" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.experiences.index') }}" class="btn-cancel text-decoration-none">Cancel</a>
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-circle me-1"></i> Update Experience
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@section('scripts')
<script>
function toggleEndDate(checkbox) {
    var endDate = document.getElementById('end_date');
    if (!endDate) return;
    endDate.disabled = checkbox.checked;
    if (checkbox.checked) endDate.value = '';
}
</script>
@endsection

@endsection