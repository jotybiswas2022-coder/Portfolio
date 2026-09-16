@extends('backend.app')

@section('content')
<style>
.cs-f { font-size: 0.88rem; }
.cs-f .section-label {
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #94a3b8;
    padding-bottom: 8px;
    border-bottom: 2px solid #f1f5f9;
    margin-bottom: 16px;
}
.cs-f .form-label {
    font-size: 0.78rem;
    font-weight: 600;
    color: #475569;
    margin-bottom: 4px;
}
.cs-f .form-control {
    font-size: 0.82rem;
    padding: 8px 12px;
    border-radius: 8px;
    border: 1.5px solid #e2e8f0;
    transition: all 0.2s;
}
.cs-f .form-control:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
}
.cs-f .form-text { font-size: 0.7rem; color: #94a3b8; }
.cs-f .invalid-feedback { font-size: 0.72rem; }
.cs-f .img-preview {
    width: 130px; height: 84px;
    border-radius: 12px;
    object-fit: cover;
    border: 1px solid #eef0f4;
}
.cs-f .img-placeholder {
    width: 130px; height: 84px;
    border-radius: 12px;
    background: #f1f5f9;
    color: #94a3b8;
    font-size: 1.8rem;
    display: flex; align-items: center; justify-content: center;
}
.cs-f .btn-submit {
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
.cs-f .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(99,102,241,0.4);
    color: #fff;
}
.cs-f .btn-cancel {
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
.cs-f .btn-cancel:hover {
    background: #f1f5f9;
    color: #334155;
}
.cs-f .form-check-input:checked {
    background-color: #6366f1;
    border-color: #6366f1;
}

@media (max-width: 767.98px) {
    .cs-f { font-size: 0.8rem; }
    .cs-f .form-label { font-size: 0.73rem; }
    .cs-f .form-control { font-size: 0.76rem; padding: 7px 10px; }
    .cs-f .form-text { font-size: 0.65rem; }
    .cs-f .invalid-feedback { font-size: 0.68rem; }
    .cs-f .img-preview,
    .cs-f .img-placeholder { width: 108px; height: 70px; font-size: 1.4rem; }
    .cs-f .btn-submit { padding: 8px 20px; font-size: 0.76rem; }
    .cs-f .btn-cancel { padding: 8px 16px; font-size: 0.76rem; }
}
</style>

<div class="container-fluid py-3 cs-f">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="fw-bold mb-0" style="font-size:0.95rem;">
                    <i class="bi bi-plus-circle me-2" style="color:#6366f1;"></i>Add Case Study
                </h5>
                <a href="{{ route('admin.casestudies.index') }}" class="btn-cancel">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            <form action="{{ route('admin.casestudies.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Basic Information --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-4 py-3">
                        <div class="section-label">Basic Information</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" id="title" name="title"
                                       class="form-control @error('title') is-invalid @enderror"
                                       value="{{ old('title') }}" placeholder="e.g. Enterprise CRM Migration" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label for="client" class="form-label">Client</label>
                                <input type="text" id="client" name="client"
                                       class="form-control @error('client') is-invalid @enderror"
                                       value="{{ old('client') }}" placeholder="e.g. ABC Corp">
                                @error('client')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label for="category" class="form-label">Category</label>
                                <input type="text" id="category" name="category"
                                       class="form-control @error('category') is-invalid @enderror"
                                       value="{{ old('category') }}" placeholder="e.g. Cloud Migration">
                                @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Case Study Details --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-4 py-3">
                        <div class="section-label">Case Study Details</div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="problem" class="form-label">Problem <span class="text-danger">*</span></label>
                                <textarea id="problem" name="problem" rows="5"
                                          class="form-control @error('problem') is-invalid @enderror"
                                          placeholder="What challenge did the client face?" required>{{ old('problem') }}</textarea>
                                @error('problem')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label for="solution" class="form-label">Solution <span class="text-danger">*</span></label>
                                <textarea id="solution" name="solution" rows="5"
                                          class="form-control @error('solution') is-invalid @enderror"
                                          placeholder="How did you solve it?" required>{{ old('solution') }}</textarea>
                                @error('solution')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label for="result" class="form-label">Result <span class="text-danger">*</span></label>
                                <textarea id="result" name="result" rows="5"
                                          class="form-control @error('result') is-invalid @enderror"
                                          placeholder="What measurable outcomes were achieved?" required>{{ old('result') }}</textarea>
                                @error('result')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Additional Information --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-4 py-3">
                        <div class="section-label"><i class="bi bi-gear me-1"></i> Additional Information</div>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="technologies" class="form-label">Technologies</label>
                                <input type="text" id="technologies" name="technologies"
                                       class="form-control @error('technologies') is-invalid @enderror"
                                       value="{{ old('technologies') }}" placeholder="e.g. Laravel, React, AWS, Docker">
                                <div class="form-text">Comma-separated list of technologies used.</div>
                                @error('technologies')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="url" class="form-label">Project URL</label>
                                <input type="url" id="url" name="url"
                                       class="form-control @error('url') is-invalid @enderror"
                                       value="{{ old('url') }}" placeholder="https://...">
                                @error('url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label for="sort_order" class="form-label">Sort Order</label>
                                <input type="number" id="sort_order" name="sort_order" min="0"
                                       class="form-control @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', 0) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                                    <label class="form-check-label" for="is_active" style="font-size:0.78rem; font-weight:500; color:#475569;">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Image --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-4 py-3">
                        <div class="section-label"><i class="bi bi-image me-1"></i> Case Study Image</div>
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <div>
                                <div id="previewPlaceholder" class="img-placeholder">
                                    <i class="bi bi-image"></i>
                                </div>
                                <img id="preview" src="" class="img-preview" style="display:none;">
                            </div>
                            <div class="flex-grow-1">
                                <input type="file" accept="image/*" id="image" name="image"
                                       class="form-control @error('image') is-invalid @enderror"
                                       onchange="previewImage(event)">
                                <div class="form-text">Recommended: Landscape 16:9, max 2MB.</div>
                                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end gap-2 mt-3 mb-3">
                    <a href="{{ route('admin.casestudies.index') }}" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-circle me-1"></i> Create Case Study
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
    const placeholder = document.getElementById('previewPlaceholder');
    if (input.files && input.files[0]) {
        preview.src = URL.createObjectURL(input.files[0]);
        preview.style.display = 'block';
        if (placeholder) placeholder.style.display = 'none';
    }
}
</script>
@endsection

@endsection