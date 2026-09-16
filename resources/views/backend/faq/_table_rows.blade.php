@forelse($faqs as $faq)
    <div class="col-12 col-md-6 col-xxl-4">
        <div class="faq-card">

            {{-- Question + order --}}
            <div class="d-flex align-items-start gap-3">
                <div class="faq-icon"><i class="bi bi-question-lg"></i></div>
                <div class="min-w-0 flex-grow-1">
                    <div class="faq-q">{{ $faq->question }}</div>
                </div>
                <span class="order-badge"><i class="bi bi-sort-down"></i> {{ $faq->sort_order }}</span>
            </div>

            {{-- Answer preview --}}
            <div class="faq-a">
                <i class="bi bi-chat-dots me-2"></i>{{ Str::limit(strip_tags($faq->answer), 160) }}
            </div>

            {{-- Footer: status + actions --}}
            <div class="faq-actions">
                <a href="{{ route('admin.faqs.toggleStatus', $faq->id) }}"
                   class="status-badge text-decoration-none {{ $faq->is_active ? 'status-active' : 'status-inactive' }}"
                   data-title="{{ $faq->question }}">
                    <span class="status-dot"></span> {{ $faq->is_active ? 'Active' : 'Inactive' }}
                </a>
                <div class="d-flex gap-1">
                    <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="btn-icon btn-icon-edit" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <button type="button" class="btn-icon btn-icon-del delete-btn"
                            data-id="{{ $faq->id }}" data-title="{{ $faq->question }}" title="Delete">
                        <i class="bi bi-trash"></i>
                    </button>
                    <form id="delete-form-{{ $faq->id }}"
                          action="{{ route('admin.faqs.destroy', $faq->id) }}"
                          method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>

        </div>
    </div>
@empty
    <div class="col-12">
        <div class="text-center py-5">
            <div class="empty-state">
                <i class="bi bi-search" style="font-size:2rem; color:#94a3b8; display:block; margin-bottom:0.5rem;"></i>
                <div class="fw-semibold mb-2">No FAQs Found</div>
                <p class="text-muted small">Try adjusting your search terms.</p>
            </div>
        </div>
    </div>
@endforelse