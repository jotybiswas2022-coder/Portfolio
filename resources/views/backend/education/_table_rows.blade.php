@forelse($educations as $education)
    <div class="col-12 col-sm-6 col-xl-4">
        <div class="edu-card">

            {{-- Degree + Institution --}}
            <div class="d-flex align-items-start gap-3">
                <div class="degree-tile">
                    <i class="bi bi-mortarboard"></i>
                </div>
                <div class="flex-grow-1 pe-1">
                    <p class="edu-degree">{{ $education->degree_name }}</p>
                    <p class="edu-institution">{{ $education->institution }}
                        @if($education->board_or_university)
                            <span class="text-muted"> — {{ $education->board_or_university }}</span>
                        @endif
                    </p>
                </div>
                <span class="order-badge"><i class="bi bi-arrow-down-up me-1"></i>{{ $education->display_order }}</span>
            </div>

            {{-- Meta --}}
            <div class="d-flex flex-wrap gap-2">
                <span class="edu-meta"><i class="bi bi-calendar3 me-1"></i>{{ $education->duration }}</span>
                @if($education->result)
                    <span class="edu-result"><i class="bi bi-award me-1"></i>{{ $education->result }}</span>
                @endif
            </div>

            {{-- Status + Actions --}}
            <div class="d-flex align-items-center justify-content-between mt-auto pt-2" style="border-top:1px dashed #f1f5f9;">
                <a href="{{ route('admin.education.toggleStatus', $education->id) }}"
                   class="status-badge {{ $education->is_active ? 'status-active' : 'status-inactive' }}"
                   data-title="{{ $education->degree_name }}">
                    {{ $education->is_active ? 'Active' : 'Inactive' }}
                </a>
                <div class="edu-actions d-flex gap-1">
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
        <div class="text-center py-4">
            <div class="empty-state">
                <i class="bi bi-search" style="font-size:2rem; color:#94a3b8; display:block; margin-bottom:0.5rem;"></i>
                <div class="fw-semibold mb-2">No Qualifications Found</div>
                <p class="text-muted small" style="font-size:0.74rem;">Try adjusting your search terms.</p>
            </div>
        </div>
    </div>
@endforelse
