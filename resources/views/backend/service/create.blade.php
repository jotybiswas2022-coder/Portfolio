@extends('backend.app')

@section('content')
<style>
.sv-f { font-size: 0.88rem; }
.sv-f .section-label {
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #94a3b8;
    padding-bottom: 8px;
    border-bottom: 2px solid #f1f5f9;
    margin-bottom: 16px;
}
.sv-f .form-label {
    font-size: 0.78rem;
    font-weight: 600;
    color: #475569;
    margin-bottom: 4px;
}
.sv-f .form-control {
    font-size: 0.82rem;
    padding: 8px 12px;
    border-radius: 8px;
    border: 1.5px solid #e2e8f0;
    transition: all 0.2s;
}
.sv-f .form-control:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
}
.sv-f .form-text { font-size: 0.7rem; color: #94a3b8; }
.sv-f .invalid-feedback { font-size: 0.72rem; }
.sv-f .icon-preview-box {
    width: 56px; height: 56px;
    border-radius: 13px;
    background: linear-gradient(135deg, rgba(99,102,241,0.12), rgba(139,92,246,0.12));
    color: #6366f1;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.5rem;
    flex-shrink: 0;
}
.sv-f .btn-submit {
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
.sv-f .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(99,102,241,0.4);
    color: #fff;
}
.sv-f .btn-cancel {
    padding: 10px 22px;
    border-radius: 10px;
    font-weight: 500;
    font-size: 0.82rem;
    color: #64748b;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    transition: all 0.2s;
}
.sv-f .btn-cancel:hover {
    background: #f1f5f9;
    color: #334155;
}
.sv-f .form-check-input:checked {
    background-color: #6366f1;
    border-color: #6366f1;
}

@media (max-width: 767.98px) {
    .sv-f { font-size: 0.8rem; }
    .sv-f .form-label { font-size: 0.73rem; }
    .sv-f .form-control { font-size: 0.76rem; padding: 7px 10px; }
    .sv-f .form-text { font-size: 0.65rem; }
    .sv-f .invalid-feedback { font-size: 0.68rem; }
    .sv-f .icon-preview-box { width: 48px; height: 48px; font-size: 1.3rem; }
    .sv-f .btn-submit { padding: 8px 20px; font-size: 0.76rem; }
    .sv-f .btn-cancel { padding: 8px 16px; font-size: 0.76rem; }
}
</style>

<div class="container-fluid py-3 sv-f">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="fw-bold mb-0" style="font-size:0.95rem;">
                    <i class="bi bi-plus-circle me-2" style="color:#6366f1;"></i>Add Service
                </h5>
                <a href="{{ route('admin.services.index') }}" class="btn-cancel text-decoration-none">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            <form action="{{ route('admin.services.store') }}" method="POST">
                @csrf

                {{-- Basic Info --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-4 py-3">
                        <div class="section-label">Service Information</div>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="title" class="form-label">Service Title <span class="text-danger">*</span></label>
                                <input type="text" id="title" name="title"
                                       class="form-control @error('title') is-invalid @enderror"
                                       value="{{ old('title') }}" placeholder="e.g. Web Development" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="short_description" class="form-label">Short Description</label>
                                <textarea id="short_description" name="short_description" rows="4"
                                          class="form-control @error('short_description') is-invalid @enderror"
                                          placeholder="Brief description for the service card (max 500 characters)">{{ old('short_description') }}</textarea>
                                @error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="description" class="form-label">Full Description</label>
                                <textarea id="description" name="description" rows="4"
                                          class="form-control @error('description') is-invalid @enderror"
                                          placeholder="Detailed description of the service">{{ old('description') }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Icon & Settings --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-4 py-3">
                        <div class="section-label"><i class="bi bi-sliders me-1"></i> Icon & Settings</div>
                        <div class="row g-3 align-items-end">
                            <div class="col-md-6">
                                <label for="iconInput" class="form-label">Icon (Bootstrap Icons class)</label>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="flex-grow-1">
                                        <input type="text" id="iconInput" name="icon"
                                               class="form-control @error('icon') is-invalid @enderror"
                                               value="{{ old('icon') }}" placeholder="e.g. bi-code-slash">
                                    </div>
                                    <div class="icon-preview-box">
                                        <i class="bi {{ old('icon') ?: 'bi-star' }}" id="iconPreview"></i>
                                    </div>
                                </div>
                                <div class="form-text mt-1">Browse at <a href="https://icons.getbootstrap.com" target="_blank">icons.getbootstrap.com</a></div>
                                @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label for="sort_order" class="form-label">Sort Order</label>
                                <input type="number" id="sort_order" name="sort_order" min="0"
                                       class="form-control @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', 0) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                                    <label class="form-check-label" for="is_active" style="font-size:0.78rem; font-weight:500; color:#475569;">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end gap-2 mt-4 mb-3">
                    <a href="{{ route('admin.services.index') }}" class="btn-cancel text-decoration-none">Cancel</a>
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-circle me-1"></i> Create Service
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@section('scripts')
<script>
document.getElementById('iconInput').addEventListener('input', function() {
    document.getElementById('iconPreview').className = 'bi ' + (this.value || 'bi-star');
});
</script>
@endsection

@endsection