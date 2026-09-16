@forelse($skills as $skill)
    <div class="col-12 col-md-6 col-xxl-4">
        <div class="skill-card">

            {{-- Icon + Name + Order --}}
            <div class="d-flex align-items-start gap-3">
                <div class="skill-tile">
                    @if($skill->icon)
                        <i class="bi {{ $skill->icon }}"></i>
                    @else
                        <i class="bi bi-star"></i>
                    @endif
                </div>
                <div class="flex-grow-1 pe-1 min-w-0">
                    <div class="skill-name text-truncate">{{ $skill->name }}</div>
                    <div class="small text-muted skill-meta"><i class="bi bi-graph-up-arrow"></i>{{ $skill->percentage }}% proficiency</div>
                </div>
                <span class="order-badge" title="Sort order"><i class="bi bi-arrow-down-up"></i>{{ $skill->sort_order }}</span>
            </div>

            {{-- Progress --}}
            <div class="skill-progress">
                <div style="width:{{ $skill->percentage }}%; background:linear-gradient(90deg,#6366f1,#818cf8);" role="progressbar" aria-valuenow="{{ $skill->percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

            {{-- Status + Actions --}}
            <div class="skill-actions">
                <a href="{{ route('admin.skills.toggleStatus', $skill->id) }}"
                   class="status-badge {{ $skill->is_active ? 'status-active' : 'status-inactive' }}"
                   data-title="{{ $skill->name }}">
                    <span class="status-dot"></span>
                    {{ $skill->is_active ? 'Active' : 'Inactive' }}
                </a>
                <div class="d-flex gap-1 align-items-center">
                    <a href="{{ route('admin.skills.edit', $skill->id) }}"
                       class="btn-icon btn-icon-edit" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <button type="button"
                            class="btn-icon btn-icon-del delete-btn"
                            data-id="{{ $skill->id }}"
                            data-title="{{ $skill->name }}" title="Delete">
                        <i class="bi bi-trash"></i>
                    </button>
                    <form id="delete-form-{{ $skill->id }}"
                          action="{{ route('admin.skills.destroy', $skill->id) }}"
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
                <i class="bi bi-lightning-charge"></i>
                <div class="fw-semibold mb-2">No Skills Found</div>
                <p class="text-muted small mb-0">Try adjusting your search terms.</p>
            </div>
        </div>
    </div>
@endforelse