@extends('backend.app')

@section('content')
<style>
.fqf { font-size: 0.88rem; }
.fqf .section-label {
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #94a3b8;
    padding-bottom: 8px;
    border-bottom: 2px solid #f1f5f9;
    margin-bottom: 16px;
}
.fqf .form-label {
    font-size: 0.78rem;
    font-weight: 600;
    color: #475569;
    margin-bottom: 4px;
}
.fqf .form-control {
    font-size: 0.82rem;
    padding: 8px 12px;
    border-radius: 8px;
    border: 1.5px solid #e2e8f0;
    transition: all 0.2s;
}
.fqf .form-control:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
}
.fqf .form-text { font-size: 0.7rem; }
.fqf .invalid-feedback { font-size: 0.72rem; }
.fqf .form-check-input:checked {
    background-color: #6366f1;
    border-color: #6366f1;
}
.fqf .btn-submit {
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
.fqf .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(99,102,241,0.4);
    color: #fff;
}
.fqf .btn-cancel {
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
.fqf .btn-cancel:hover {
    background: #f1f5f9;
    color: #334155;
}

@media (max-width: 767.98px) {
    .fqf { font-size: 0.8rem; }
    .fqf .section-label { font-size: 0.68rem; }
    .fqf .form-label { font-size: 0.73rem; }
    .fqf .form-control { font-size: 0.76rem; padding: 7px 10px; }
    .fqf .form-text { font-size: 0.65rem; }
    .fqf .btn-submit { padding: 8px 20px; font-size: 0.76rem; }
    .fqf .btn-cancel { padding: 8px 16px; font-size: 0.76rem; }
}
</style>

<div class="container-fluid py-3 fqf">
    <div class="row justify-content-center">
        <div class="col-md-11 col-lg-9">

            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h5 class="fw-bold mb-1" style="font-size:0.95rem;">
                        <i class="bi bi-pencil-square me-2" style="color:#6366f1;"></i>Edit FAQ
                    </h5>
                    <p class="text-muted small mb-0">Update this frequently asked question.</p>
                </div>
                <a href="{{ route('admin.faqs.index') }}" class="btn-cancel text-decoration-none">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            <form action="{{ route('admin.faqs.update', $faq->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Question --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-4 py-3">
                        <div class="section-label"><i class="bi bi-question-lg me-1"></i> Question</div>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="question" class="form-label">Question <span class="text-danger">*</span></label>
                                <input type="text" id="question" name="question"
                                       class="form-control @error('question') is-invalid @enderror"
                                       value="{{ old('question', $faq->question) }}" required>
                                @error('question')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Answer --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-4 py-3">
                        <div class="section-label"><i class="bi bi-chat-dots me-1"></i> Answer</div>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="answer" class="form-label">Answer <span class="text-danger">*</span></label>
                                <textarea id="answer" name="answer" rows="5"
                                          class="form-control @error('answer') is-invalid @enderror"
                                          required>{{ old('answer', $faq->answer) }}</textarea>
                                @error('answer')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Settings --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body px-4 py-3">
                        <div class="section-label"><i class="bi bi-gear me-1"></i> Settings</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="sort_order" class="form-label">Sort Order</label>
                                <input type="number" id="sort_order" name="sort_order" min="0"
                                       class="form-control @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', $faq->sort_order) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 d-flex align-items-end pb-1">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                           {{ old('is_active', $faq->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-medium" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.faqs.index') }}" class="btn-cancel text-decoration-none">Cancel</a>
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-circle me-1"></i> Update FAQ
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection