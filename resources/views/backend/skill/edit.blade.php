@extends('backend.app')

@section('content')
<style>
.skf { font-size: 0.88rem; }
.skf .section-label {
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #94a3b8;
    padding-bottom: 8px;
    border-bottom: 2px solid #f1f5f9;
    margin-bottom: 16px;
}
.skf .form-label {
    font-size: 0.78rem;
    font-weight: 600;
    color: #475569;
    margin-bottom: 4px;
}
.skf .form-control {
    font-size: 0.82rem;
    padding: 8px 12px;
    border-radius: 8px;
    border: 1.5px solid #e2e8f0;
    transition: all 0.2s;
}
.skf .form-control:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
}
.skf .form-text { font-size: 0.7rem; }
.skf .invalid-feedback { font-size: 0.72rem; }
.skf .form-check-input:checked {
    background-color: #6366f1;
    border-color: #6366f1;
}
.skf .btn-submit {
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
.skf .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(99,102,241,0.4);
    color: #fff;
}
.skf .btn-cancel {
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
.skf .btn-cancel:hover {
    background: #f1f5f9;
    color: #334155;
}

@media (max-width: 767.98px) {
    .skf { font-size: 0.8rem; }
    .skf .section-label { font-size: 0.68rem; }
    .skf .form-label { font-size: 0.73rem; }
    .skf .form-control { font-size: 0.76rem; padding: 7px 10px; }
    .skf .form-text { font-size: 0.65rem; }
    .skf .btn-submit { padding: 8px 20px; font-size: 0.76rem; }
    .skf .btn-cancel { padding: 8px 16px; font-size: 0.76rem; }
}
</style>

<div class="container-fluid py-3 skf">
    <div class="row justify-content-center">
        <div class="col-md-11 col-lg-9">

            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h5 class="fw-bold mb-1" style="font-size:0.95rem;">
                        <i class="bi bi-pencil-square me-2" style="color:#6366f1;"></i>Edit Skill
                    </h5>
                    <p class="text-muted small mb-0">Update details for <strong>{{ $skill->name }}</strong>.</p>
                </div>
                <a href="{{ route('admin.skills.index') }}" class="btn-cancel text-decoration-none">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            <form action="{{ route('admin.skills.update', $skill->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Skill Info --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-4 py-3">
                        <div class="section-label"><i class="bi bi-lightning-charge me-1"></i> Skill Info</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Skill Name <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', $skill->name) }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="icon" class="form-label">Icon (Bootstrap Icons class)</label>
                                <input type="text" id="icon" name="icon"
                                       class="form-control @error('icon') is-invalid @enderror"
                                       value="{{ old('icon', $skill->icon) }}" placeholder="e.g. bi-fire, bi-code-slash">
                                <div class="form-text mt-1">Browse at <a href="https://icons.getbootstrap.com" target="_blank">icons.getbootstrap.com</a></div>
                                @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Level & Settings --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-4 py-3">
                        <div class="section-label"><i class="bi bi-sliders me-1"></i> Level & Settings</div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="percentage" class="form-label">Percentage <span class="text-danger">*</span></label>
                                <input type="number" id="percentage" name="percentage" min="0" max="100"
                                       class="form-control @error('percentage') is-invalid @enderror"
                                       value="{{ old('percentage', $skill->percentage) }}" required>
                                <div class="form-text mt-1">Value between 0 and 100</div>
                                @error('percentage')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label for="sort_order" class="form-label">Sort Order</label>
                                <input type="number" id="sort_order" name="sort_order" min="0"
                                       class="form-control @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', $skill->sort_order) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4 d-flex align-items-end pb-1">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                           value="1" {{ old('is_active', $skill->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-medium" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Preview --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-4 py-3">
                        <div class="section-label"><i class="bi bi-eye me-1"></i> Preview</div>
                        <div class="text-center">
                            <div class="d-inline-flex align-items-center gap-3 p-3 rounded-3" style="background:#f8fafc; border:1px dashed #e2e8f0;">
                                <i class="bi {{ $skill->icon ?: 'bi-star' }}" id="iconPreview" style="font-size:2rem; color:#6366f1;"></i>
                                <div class="text-start">
                                    <div class="fw-semibold" id="previewName">{{ $skill->name }}</div>
                                    <div class="progress mt-1" style="width:180px; height:6px; border-radius:10px; background:#e2e8f0;">
                                        <div class="progress-bar rounded-pill" style="width:{{ $skill->percentage }}%; background:linear-gradient(90deg,#6366f1,#818cf8);" id="previewBar"></div>
                                    </div>
                                </div>
                                <span class="badge rounded-pill px-3 py-1 fw-semibold" style="background:rgba(99,102,241,0.1); color:#6366f1;" id="previewPercent">{{ $skill->percentage }}%</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.skills.index') }}" class="btn-cancel text-decoration-none">Cancel</a>
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-circle me-1"></i> Update Skill
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@section('scripts')
<script>
var iconInput = document.getElementById('icon');
if (iconInput) iconInput.addEventListener('input', function() {
    document.getElementById('iconPreview').className = 'bi ' + (this.value || 'bi-star');
});
</script>
@endsection

@endsection