@forelse($experiences as $exp)
    <div class="col-12 col-sm-6 col-xl-4">
        <div class="exp-card">

            {{-- Company + Position + Current --}}
            <div class="d-flex align-items-start gap-3">
                <div class="company-tile">
                    {{ strtoupper(substr($exp->company, 0, 1)) }}
                </div>
                <div class="flex-grow-1 pe-1">
                    <div class="exp-company">{{ $exp->company }}</div>
                    <div class="exp-position mt-1">
                        @if($exp->is_current)
                            <span class="current-badge"><i class="bi bi-lightning-charge-fill me-1"></i>Current</span>
                        @endif
                        {{ $exp->position }}
                    </div>
                </div>
                <span class="order-badge"><i class="bi bi-arrow-down-up me-1"></i>{{ $exp->sort_order }}</span>
            </div>

            {{-- Meta --}}
            <div class="d-flex flex-wrap gap-2">
                <span class="exp-meta"><i class="bi bi-calendar3 me-1"></i>{{ $exp->duration }}</span>
                @if($exp->location)
                    <span class="exp-meta"><i class="bi bi-geo-alt me-1"></i>{{ $exp->location }}</span>
                @endif
            </div>

            {{-- Description --}}
            @if($exp->description)
                <p class="exp-desc">{{ Str::limit($exp->description, 110) }}</p>
            @endif

            {{-- Status + Actions --}}
            <div class="d-flex align-items-center justify-content-between mt-auto pt-2" style="border-top:1px dashed #f1f5f9;">
                <a href="{{ route('admin.experiences.toggleStatus', $exp->id) }}"
                   class="status-badge {{ $exp->is_active ? 'status-active' : 'status-inactive' }}"
                   data-title="{{ $exp->company }}">
                    {{ $exp->is_active ? 'Active' : 'Inactive' }}
                </a>
                <div class="exp-actions d-flex gap-1">
                    <a href="{{ route('admin.experiences.edit', $exp->id) }}"
                       class="btn-icon btn-icon-edit" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <button type="button"
                            class="btn-icon btn-icon-del delete-btn"
                            data-id="{{ $exp->id }}"
                            data-title="{{ $exp->company }}" title="Delete">
                        <i class="bi bi-trash"></i>
                    </button>
                    <form id="delete-form-{{ $exp->id }}"
                          action="{{ route('admin.experiences.destroy', $exp->id) }}"
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
                <div class="fw-semibold mb-2">No Experiences Found</div>
                <p class="text-muted small">Try adjusting your search terms.</p>
            </div>
        </div>
    </div>
@endforelse
