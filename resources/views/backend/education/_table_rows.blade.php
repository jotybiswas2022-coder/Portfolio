@forelse($educations as $education)
    <div class="col-12 col-md-6 col-xxl-4">
        <div class="edu-card">

            {{-- Degree + Institution --}}
            <div class="d-flex align-items-start gap-3">
                <div class="degree-tile">
                    <i class="bi bi-mortarboard"></i>
                </div>
                <div class="flex-grow-1 pe-1 min-w-0">
                    <div class="edu-degree text-truncate">{{ $education->degree_name }}</div>
                    <div class="edu-institution text-truncate">
                        {{ $education->institution }}
                        @if($education->board_or_university)
                            <span class="text-muted"> &middot; {{ $education->board_or_university }}</span>
                        @endif
                    </div>
                </div>
                <span class="order-badge" title="Display order">
                    <i class="bi bi-arrow-down-up"></i>{{ $education->display_order }}
                </span>
            </div>

            {{-- Meta --}}
            <div class="edu-meta-row">
                <span class="edu-meta"><i class="bi bi-calendar3"></i>{{ $education->duration }}</span>
                @if($education->result)
                    <span class="edu-result"><i class="bi bi-award"></i>{{ $education->result }}</span>
                @endif
            </div>

            {{-- Status + Actions --}}
            <div class="edu-actions">
                <a href="{{ route('admin.education.toggleStatus', $education->id) }}"
                   class="status-badge {{ $education->is_active ? 'status-active' : 'status-inactive' }}"
                   data-title="{{ $education->degree_name }}">
                    <span class="status-dot"></span>
                    {{ $education->is_active ? 'Active' : 'Inactive' }}
                </a>
                <div class="d-flex gap-1 align-items-center">
                    <a href="{{ route('admin.education.edit', $education->id) }}"
                       class="btn-icon btn-icon-edit" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <button type="button"
                            class="btn-icon btn-icon-del delete-btn"
                            data-id="{{ $education->id }}"
                            data-title="{{ $education->degree_name }}" title="Delete">
                        <i class="bi bi-trash"></i>
                    </button>
                    <form id="delete-form-{{ $education->id }}"
                          action="{{ route('admin.education.destroy', $education->id) }}"
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
                <i class="bi bi-search"></i>
                <div class="fw-semibold mb-2">No Qualifications Found</div>
                <p class="text-muted small mb-0">Try adjusting your search terms.</p>
            </div>
        </div>
    </div>
@endforelse