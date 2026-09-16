@extends('backend.app')

@section('content')
<style>
.gjf { font-size: 0.88rem; }
.gjf .section-label {
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #94a3b8;
    padding-bottom: 8px;
    border-bottom: 2px solid #f1f5f9;
    margin-bottom: 16px;
}
.gjf .section-label .pkg-badge {
    display: inline-block;
    font-size: 0.62rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.4px;
    padding: 2px 8px;
    border-radius: 999px;
    margin-right: 6px;
    vertical-align: 1px;
}
.gjf .pkg-basic { background: #f1f5f9; color: #64748b; }
.gjf .pkg-standard { background: rgba(99,102,241,0.1); color: #6366f1; }
.gjf .pkg-premium { background: rgba(217,119,6,0.12); color: #b45309; }
.gjf .form-label {
    font-size: 0.78rem;
    font-weight: 600;
    color: #475569;
    margin-bottom: 4px;
}
.gjf .form-control {
    font-size: 0.82rem;
    padding: 8px 12px;
    border-radius: 8px;
    border: 1.5px solid #e2e8f0;
    transition: all 0.2s;
}
.gjf .form-control:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
}
.gjf .form-text { font-size: 0.7rem; }
.gjf .invalid-feedback { font-size: 0.72rem; }
.gjf .form-check-input:checked {
    background-color: #6366f1;
    border-color: #6366f1;
}
.gjf .btn-submit {
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
.gjf .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(99,102,241,0.4);
    color: #fff;
}
.gjf .btn-cancel {
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
.gjf .btn-cancel:hover {
    background: #f1f5f9;
    color: #334155;
}

@media (max-width: 767.98px) {
    .gjf { font-size: 0.8rem; }
    .gjf .section-label { font-size: 0.68rem; }
    .gjf .form-label { font-size: 0.73rem; }
    .gjf .form-control { font-size: 0.76rem; padding: 7px 10px; }
    .gjf .form-text { font-size: 0.65rem; }
    .gjf .btn-submit { padding: 8px 20px; font-size: 0.76rem; }
    .gjf .btn-cancel { padding: 8px 16px; font-size: 0.76rem; }
}
</style>

<div class="container-fluid py-3 gjf">
    <div class="row justify-content-center">
        <div class="col-md-11 col-lg-9">

            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h5 class="fw-bold mb-1" style="font-size:0.95rem;">
                        <i class="bi bi-plus-circle me-2" style="color:#6366f1;"></i>Add Gig
                    </h5>
                    <p class="text-muted small mb-0">Create a new service package with three pricing tiers.</p>
                </div>
                <a href="{{ route('admin.gigs.index') }}" class="btn-cancel text-decoration-none">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            <form action="{{ route('admin.gigs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Gig Details --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-4 py-3">
                        <div class="section-label"><i class="bi bi-music-note-list me-1"></i> Gig Details</div>
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label for="title" class="form-label">Gig Title <span class="text-danger">*</span></label>
                                <input type="text" id="title" name="title"
                                       class="form-control @error('title') is-invalid @enderror"
                                       value="{{ old('title') }}" placeholder="e.g. Web Development Package" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label for="sort_order" class="form-label">Sort Order</label>
                                <input type="number" id="sort_order" name="sort_order" min="0"
                                       class="form-control @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', 0) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label for="short_description" class="form-label">Short Description</label>
                                <input type="text" id="short_description" name="short_description"
                                       class="form-control @error('short_description') is-invalid @enderror"
                                       value="{{ old('short_description') }}" placeholder="Brief overview of this gig">
                                @error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label">Full Description</label>
                                <textarea id="description" name="description" rows="4"
                                          class="form-control @error('description') is-invalid @enderror"
                                          placeholder="Detailed description of what this gig includes">{{ old('description') }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 col-md-8">
                                <label for="image" class="form-label">Gig Image</label>
                                <input type="file" accept="image/*" id="image" name="image"
                                       class="form-control @error('image') is-invalid @enderror"
                                       onchange="previewImage(event)">
                                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <div class="mt-2">
                                    <img id="preview" src="" style="display:none; max-width:300px; max-height:180px; object-fit:cover;" class="rounded shadow-sm">
                                </div>
                            </div>
                            <div class="col-12 col-md-4 d-flex align-items-end pb-1">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                           value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-medium" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Basic Package --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-4 py-3">
                        <div class="section-label"><span class="pkg-badge pkg-basic">Basic</span> Package</div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="basic_name" class="form-label">Plan Name</label>
                                <input type="text" id="basic_name" name="basic_name"
                                       class="form-control @error('basic_name') is-invalid @enderror"
                                       value="{{ old('basic_name', 'Basic') }}" placeholder="Basic">
                                @error('basic_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label for="basic_price" class="form-label">Price <span class="text-danger">*</span></label>
                                <input type="text" id="basic_price" name="basic_price"
                                       class="form-control @error('basic_price') is-invalid @enderror"
                                       value="{{ old('basic_price') }}" placeholder="$99" required>
                                @error('basic_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label for="basic_features" class="form-label">Features (one per line)</label>
                                <textarea id="basic_features" name="basic_features" rows="4"
                                          class="form-control @error('basic_features') is-invalid @enderror"
                                          placeholder="1 Basic Design&#10;5 Pages&#10;Responsive Layout">{{ old('basic_features') }}</textarea>
                                @error('basic_features')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Standard Package --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-4 py-3">
                        <div class="section-label"><span class="pkg-badge pkg-standard">Standard</span> Package</div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="standard_name" class="form-label">Plan Name</label>
                                <input type="text" id="standard_name" name="standard_name"
                                       class="form-control @error('standard_name') is-invalid @enderror"
                                       value="{{ old('standard_name', 'Standard') }}" placeholder="Standard">
                                @error('standard_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label for="standard_price" class="form-label">Price <span class="text-danger">*</span></label>
                                <input type="text" id="standard_price" name="standard_price"
                                       class="form-control @error('standard_price') is-invalid @enderror"
                                       value="{{ old('standard_price') }}" placeholder="$199" required>
                                @error('standard_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label for="standard_features" class="form-label">Features (one per line)</label>
                                <textarea id="standard_features" name="standard_features" rows="4"
                                          class="form-control @error('standard_features') is-invalid @enderror"
                                          placeholder="1 Premium Design&#10;10 Pages&#10;Responsive Layout&#10;SEO Optimized">{{ old('standard_features') }}</textarea>
                                @error('standard_features')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Premium Package --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-4 py-3">
                        <div class="section-label"><span class="pkg-badge pkg-premium">Premium</span> Package</div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="premium_name" class="form-label">Plan Name</label>
                                <input type="text" id="premium_name" name="premium_name"
                                       class="form-control @error('premium_name') is-invalid @enderror"
                                       value="{{ old('premium_name', 'Premium') }}" placeholder="Premium">
                                @error('premium_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label for="premium_price" class="form-label">Price <span class="text-danger">*</span></label>
                                <input type="text" id="premium_price" name="premium_price"
                                       class="form-control @error('premium_price') is-invalid @enderror"
                                       value="{{ old('premium_price') }}" placeholder="$399" required>
                                @error('premium_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label for="premium_features" class="form-label">Features (one per line)</label>
                                <textarea id="premium_features" name="premium_features" rows="4"
                                          class="form-control @error('premium_features') is-invalid @enderror"
                                          placeholder="1 Custom Design&#10;Unlimited Pages&#10;Responsive Layout&#10;SEO Optimized&#10;E-Commerce Integration">{{ old('premium_features') }}</textarea>
                                @error('premium_features')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.gigs.index') }}" class="btn-cancel text-decoration-none">Cancel</a>
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-circle me-1"></i> Create Gig
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
    if (input.files && input.files[0]) {
        preview.src = URL.createObjectURL(input.files[0]);
        preview.style.display = 'inline-block';
    }
}
</script>
@endsection

@endsection