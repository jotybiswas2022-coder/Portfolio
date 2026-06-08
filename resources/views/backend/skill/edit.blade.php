@extends('backend.app')

@section('content')

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">

            <div class="card form-card">
                <div class="card-header">
                    <h5><i class="bi bi-pencil-square me-2"></i>Edit Skill: {{ $skill->name }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.skills.update', $skill->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Skill Name <span class="text-danger">*</span></label>
                            <input type="text" name="name"
                                   class="form-control form-control-lg shadow-sm @error('name') is-invalid @enderror"
                                   value="{{ old('name', $skill->name) }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Percentage <span class="text-danger">*</span></label>
                                <input type="number" name="percentage" min="0" max="100"
                                       class="form-control form-control-lg shadow-sm @error('percentage') is-invalid @enderror"
                                       value="{{ old('percentage', $skill->percentage) }}" required>
                                @error('percentage')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Sort Order</label>
                                <input type="number" name="sort_order" min="0"
                                       class="form-control form-control-lg shadow-sm @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', $skill->sort_order) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Icon (Bootstrap Icons class)</label>
                            <input type="text" name="icon" id="iconInput"
                                   class="form-control shadow-sm @error('icon') is-invalid @enderror"
                                   value="{{ old('icon', $skill->icon) }}">
                            <div class="form-text">
                                Use full class like <code>bi-fire</code> — 
                                <a href="https://icons.getbootstrap.com" target="_blank">Browse icons</a>
                            </div>
                            @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3 d-flex align-items-center">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                           {{ old('is_active', $skill->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="is_active">Active</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 text-end">
                                <div class="icon-preview border rounded p-3 d-inline-block">
                                    <div class="small text-muted mb-1">Preview:</div>
                                    <i class="bi {{ $skill->icon ?: 'bi-star' }} fs-2" id="iconPreview"></i>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2 mt-3">
                            <a href="{{ route('admin.skills.index') }}" class="btn btn-secondary btn-lg rounded-3 px-4">
                                <i class="bi bi-arrow-left me-1"></i> Back
                            </a>
                            <button type="submit" class="btn btn-dark btn-lg rounded-3 shadow-sm flex-grow-1">
                                <i class="bi bi-check-circle me-1"></i>
                                Update Skill
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
document.getElementById('iconInput').addEventListener('input', function() {
    const preview = document.getElementById('iconPreview');
    preview.className = 'bi ' + (this.value || 'bi-star') + ' fs-2';
});
</script>

@endsection
