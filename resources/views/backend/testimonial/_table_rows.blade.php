@forelse($testimonials as $testimonial)
    <div class="col-12 col-md-6 col-xxl-4">
        <div class="tst-card">

            {{-- Client + order --}}
            <div class="d-flex align-items-start gap-3">
                <div class="tst-avatar" style="width:48px; height:48px; min-width:48px;">
                    @if($testimonial->avatar)
                        <img src="{{ config('app.storage_url') }}{{ $testimonial->avatar }}" alt="{{ $testimonial->name }}">
                    @else
                        {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                    @endif
                </div>
                <div class="min-w-0 flex-grow-1">
                    <div class="tst-name text-truncate">{{ $testimonial->name }}</div>
                    <div class="tst-role text-truncate">{{ $testimonial->designation_display ?: '—' }}</div>
                    <div class="tst-stars mt-1">
                        @foreach($testimonial->stars as $filled)
                            <i class="bi {{ $filled ? 'bi-star-fill' : 'bi-star' }}"></i>
                        @endforeach
                    </div>
                </div>
                <span class="order-badge"><i class="bi bi-sort-down"></i> {{ $testimonial->sort_order }}</span>
            </div>

            {{-- Message preview --}}
            <div class="tst-msg">&ldquo;{{ $testimonial->message }}&rdquo;</div>
            <button type="button" class="tst-msg-btn view-msg-btn" data-modal-target="tstModal{{ $testimonial->id }}">
                <i class="bi bi-eye"></i> View Review
            </button>

            {{-- Footer: status + actions --}}
            <div class="tst-actions">
                <a href="{{ route('admin.testimonials.toggleStatus', $testimonial->id) }}"
                   class="status-badge text-decoration-none {{ $testimonial->is_active ? 'status-active' : 'status-inactive' }}"
                   data-title="{{ $testimonial->name }}">
                    <span class="status-dot"></span> {{ $testimonial->is_active ? 'Active' : 'Inactive' }}
                </a>
                <div class="d-flex gap-1">
                    <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="btn-icon btn-icon-edit" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <button type="button" class="btn-icon btn-icon-del delete-btn"
                            data-id="{{ $testimonial->id }}" data-title="{{ $testimonial->name }}" title="Delete">
                        <i class="bi bi-trash"></i>
                    </button>
                    <form id="delete-form-{{ $testimonial->id }}"
                          action="{{ route('admin.testimonials.destroy', $testimonial->id) }}"
                          method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>

            {{-- Review modal --}}
            <div class="modal fade" id="tstModal{{ $testimonial->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow rounded-4" style="overflow:hidden;">
                        <div class="modal-header tst-modal-header border-0 text-white">
                            <h5 class="modal-title fw-semibold" style="font-size:0.95rem;">
                                <i class="bi bi-chat-quote me-2"></i>{{ $testimonial->name }}'s Review
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body px-4 py-3">
                            <div class="mb-3 d-flex align-items-center gap-3">
                                <div class="tst-avatar" style="width:46px; height:46px; min-width:46px;">
                                    @if($testimonial->avatar)
                                        <img src="{{ config('app.storage_url') }}{{ $testimonial->avatar }}" alt="{{ $testimonial->name }}">
                                    @else
                                        {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <div class="fw-bold" style="font-size:0.88rem;">{{ $testimonial->name }}</div>
                                    <div class="small" style="color:var(--admin-text-muted);">{{ $testimonial->designation_display ?: '—' }}</div>
                                    <div style="color:#f59e0b; font-size:0.82rem;">
                                        @foreach($testimonial->stars as $filled)
                                            <i class="bi {{ $filled ? 'bi-star-fill' : 'bi-star' }}"></i>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <p class="mb-0" style="font-style:italic; line-height:1.75; color:#334155;">
                                &ldquo;{{ $testimonial->message }}&rdquo;
                            </p>
                        </div>
                        <div class="modal-footer border-0 px-4 pb-3 pt-0">
                            <button type="button" class="btn btn-light border rounded-3 px-4" style="font-size:0.8rem;" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@empty
    <div class="col-12">
        <div class="text-center py-5">
            <div class="empty-state">
                <i class="bi bi-search" style="font-size:2rem; color:#94a3b8; display:block; margin-bottom:0.5rem;"></i>
                <div class="fw-semibold mb-2">No Testimonials Found</div>
                <p class="text-muted small">Try adjusting your search terms.</p>
            </div>
        </div>
    </div>
@endforelse