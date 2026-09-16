@forelse($services as $service)
    <div class="col-12 col-sm-6 col-xxl-4">
        <div class="sv-card">
            {{-- Icon + Order --}}
            <div class="d-flex align-items-start justify-content-between">
                <div class="icon-tile">
                    @if($service->icon)
                        <i class="bi {{ $service->icon }}"></i>
                    @else
                        <i class="bi bi-briefcase"></i>
                    @endif
                </div>
                <span class="order-badge"><i class="bi bi-arrow-down-up me-1"></i>{{ $service->sort_order }}</span>
            </div>

            {{-- Title + Description --}}
            <div class="flex-grow-1">
                <h6 class="sv-title">{{ $service->title }}</h6>
                <p class="sv-desc mt-1">{{ Str::limit($service->short_description, 80) ?: 'No description provided.' }}</p>
            </div>

            {{-- Status + Actions --}}
            <div class="d-flex align-items-center justify-content-between sv-actions">
                <a href="{{ route('admin.services.toggleStatus', $service->id) }}"
                   class="status-badge {{ $service->is_active ? 'active-badge' : 'inactive-badge' }}"
                   data-title="{{ $service->title }}">
                    {{ $service->is_active ? 'Active' : 'Inactive' }}
                </a>
                <div class="d-flex gap-1">
                    <a href="{{ route('admin.services.edit', $service->id) }}"
                       class="btn-icon btn-icon-edit" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <button type="button"
                            class="btn-icon btn-icon-del delete-btn"
                            data-id="{{ $service->id }}"
                            data-title="{{ $service->title }}" title="Delete">
                        <i class="bi bi-trash"></i>
                    </button>
                    <form id="delete-form-{{ $service->id }}"
                          action="{{ route('admin.services.destroy', $service->id) }}"
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
                <div class="fw-semibold mb-2">No Services Found</div>
                <p class="text-muted" style="font-size:0.78rem;">Try adjusting your search terms.</p>
            </div>
        </div>
    </div>
@endforelse