@extends('backend.app')

@section('content')

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card form-card">
                <div class="card-header">
                    <h5><i class="bi bi-plus-circle me-2"></i>Write New Post</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="title" class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                                <input type="text" id="title" name="title"
                                       class="form-control form-control-lg shadow-sm @error('title') is-invalid @enderror"
                                       value="{{ old('title') }}" placeholder="Enter post title" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="category" class="form-label fw-semibold">Category</label>
                                <input type="text" id="category" name="category"
                                       class="form-control form-control-lg shadow-sm @error('category') is-invalid @enderror"
                                       value="{{ old('category') }}" placeholder="e.g. Laravel, Tutorial">
                                @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label fw-semibold">Content <span class="text-danger">*</span></label>
                            <textarea id="content" name="content" rows="14"
                                      class="form-control shadow-sm @error('content') is-invalid @enderror"
                                      placeholder="Write your post content here..." required>{{ old('content') }}</textarea>
                            @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="excerpt" class="form-label fw-semibold">Excerpt (Short Summary)</label>
                            <textarea id="excerpt" name="excerpt" rows="2"
                                      class="form-control shadow-sm @error('excerpt') is-invalid @enderror"
                                      placeholder="Brief summary of the post (optional)">{{ old('excerpt') }}</textarea>
                            @error('excerpt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tags" class="form-label fw-semibold">Tags</label>
                                <input type="text" id="tags" name="tags"
                                       class="form-control shadow-sm @error('tags') is-invalid @enderror"
                                       value="{{ old('tags') }}" placeholder="e.g. Laravel, PHP, Tutorial">
                                <div class="form-text">Separate with commas</div>
                                @error('tags')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="featured_image" class="form-label fw-semibold">Featured Image</label>
                                <input type="file" accept="image/*" id="featured_image" name="featured_image"
                                       class="form-control shadow-sm @error('featured_image') is-invalid @enderror"
                                       onchange="previewImage(event)">
                                @error('featured_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-2 mb-3 d-flex align-items-end">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1" checked>
                                    <label class="form-check-label fw-semibold" for="is_published">Publish</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 text-center" id="previewContainer" style="display:none;">
                            <img id="preview" src="" class="img-fluid rounded shadow-sm" style="max-width:400px; max-height:200px;">
                        </div>

                        <div class="d-flex gap-2 mt-3">
                            <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary btn-lg rounded-3 px-4">
                                <i class="bi bi-arrow-left me-1"></i> Back
                            </a>
                            <button type="submit" class="btn btn-dark btn-lg rounded-3 shadow-sm flex-grow-1">
                                <i class="bi bi-check-circle me-1"></i> Create Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('preview');
    const container = document.getElementById('previewContainer');
    if (input.files && input.files[0]) {
        preview.src = URL.createObjectURL(input.files[0]);
        container.style.display = 'block';
    }
}
</script>

@endsection
