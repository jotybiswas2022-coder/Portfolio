@extends('backend.app')

@section('content')
<style>
.form-section { margin-bottom: 0; }
.form-section .form-label {
    font-size: 0.82rem;
    font-weight: 600;
    color: var(--admin-text);
    margin-bottom: 0.35rem;
}
.form-section .form-text {
    font-size: 0.72rem;
    color: var(--admin-text-muted);
}
.image-dropzone {
    border: 2px dashed var(--admin-border);
    border-radius: 12px;
    padding: 2rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s;
    background: rgba(99,102,241,0.02);
}
.image-dropzone:hover {
    border-color: var(--admin-primary);
    background: rgba(99,102,241,0.04);
}
.image-dropzone i { font-size: 2rem; color: var(--admin-primary); margin-bottom: 0.5rem; display: block; }
@media (max-width: 767.98px) {
    .form-section .form-label { font-size: 0.75rem; }
    .form-section .form-control, .form-section .form-select { font-size: 0.78rem; padding: 0.4rem 0.6rem; }
    .form-section .form-text { font-size: 0.68rem; }
}
</style>

<div class="container-fluid py-3">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">

            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="fw-bold mb-1"><i class="bi bi-plus-circle me-2" style="color:var(--admin-primary);"></i>Add New Project</h4>
                    <p class="text-muted small mb-0">Create a new project to showcase in your portfolio.</p>
                </div>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-admin btn-admin-outline">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Basic Info --}}
                <div class="form-card mb-4 slide-up">
                    <div class="card-header">
                        <h5><i class="bi bi-info-circle me-2"></i>Basic Information</h5>
                    </div>
                    <div class="card-body form-section">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" id="title" name="title"
                                       class="form-control @error('title') is-invalid @enderror"
                                       value="{{ old('title') }}" placeholder="e.g. E-Commerce Platform" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label for="category" class="form-label">Category</label>
                                <input type="text" id="category" name="category"
                                       class="form-control @error('category') is-invalid @enderror"
                                       value="{{ old('category') }}" placeholder="e.g. Web App">
                                @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" name="description" rows="4"
                                          class="form-control @error('description') is-invalid @enderror"
                                          placeholder="Describe your project...">{{ old('description') }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tech Stack & Status --}}
                <div class="form-card mb-4 slide-up" style="animation-delay:0.1s;">
                    <div class="card-header">
                        <h5><i class="bi bi-gear me-2"></i>Tech Stack & Status</h5>
                    </div>
                    <div class="card-body form-section">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="tech_stack" class="form-label">Tech Stack</label>
                                <input type="text" id="tech_stack" name="tech_stack"
                                       class="form-control @error('tech_stack') is-invalid @enderror"
                                       value="{{ old('tech_stack') }}" placeholder="e.g. Laravel, MySQL, Stripe">
                                <div class="form-text mt-1">Separate technologies with commas.</div>
                                @error('tech_stack')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label for="sort_order" class="form-label">Sort Order</label>
                                <input type="number" id="sort_order" name="sort_order" min="0"
                                       class="form-control @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', 0) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3 d-flex align-items-end pb-1">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                                    <label class="form-check-label fw-medium" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Links --}}
                <div class="form-card mb-4 slide-up" style="animation-delay:0.15s;">
                    <div class="card-header">
                        <h5><i class="bi bi-link-45deg me-2"></i>Project Links</h5>
                    </div>
                    <div class="card-body form-section">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="live_link" class="form-label"><i class="bi bi-globe me-1"></i> Live Link</label>
                                <input type="url" id="live_link" name="live_link"
                                       class="form-control @error('live_link') is-invalid @enderror"
                                       value="{{ old('live_link') }}" placeholder="https://example.com">
                                @error('live_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="github_link" class="form-label"><i class="bi bi-github me-1"></i> GitHub Link</label>
                                <input type="url" id="github_link" name="github_link"
                                       class="form-control @error('github_link') is-invalid @enderror"
                                       value="{{ old('github_link') }}" placeholder="https://github.com/username/repo">
                                @error('github_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Project Image --}}
                <div class="form-card mb-4 slide-up" style="animation-delay:0.2s;">
                    <div class="card-header">
                        <h5><i class="bi bi-image me-2"></i>Project Image</h5>
                    </div>
                    <div class="card-body form-section">
                        <input type="file" accept="image/*" id="image" name="image"
                               class="form-control @error('image') is-invalid @enderror"
                               onchange="previewImage(event)">
                        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div class="mt-3">
                            <img id="preview" src="" style="display:none; max-width:320px; max-height:200px; object-fit:cover;"
                                 class="rounded shadow-sm">
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end gap-2 slide-up" style="animation-delay:0.25s;">
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-admin btn-admin-outline">Cancel</a>
                    <button type="submit" class="btn btn-admin btn-admin-primary px-4">
                        <i class="bi bi-check-circle me-1"></i> Create Project
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
