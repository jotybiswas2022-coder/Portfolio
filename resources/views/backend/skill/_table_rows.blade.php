@forelse($skills as $skill)
    <div class="col-12 col-sm-6 col-xl-4">
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
                <div class="flex-grow-1 pe-1">
                    <div class="skill-name">{{ $skill->name }}</div>
                    <div class="small text-muted">{{ $skill->percentage }}% proficiency</div>
                </div>
                <span class="order-badge"><i class="bi bi-arrow-down-up me-1"></i>{{ $skill->sort_order }}</span>
            </div>

            {{-- Progress --}}
            <div class="progress mt-3" style="height:8px; border-radius:10px; background:#eef2ff;">
                <div class="progress-bar rounded-pill" style="width:{{ $skill->percentage }}%; background:linear-gradient(90deg,#6366f1,#818cf8);" role="progressbar"></div>
            </div>

            {{-- Status + Actions --}}
            <div class="d-flex align-items-center justify-content-between mt-auto pt-2" style="border-top:1px dashed #f1f5f9;">
                <a href="{{ route('admin.skills.toggleStatus', $skill->id) }}"
                   class="status-badge {{ $skill->is_active ? 'status-active' : 'status-inactive' }}"
                   data-title="{{ $skill->name }}">
                    {{ $skill->is_active ? 'Active' : 'Inactive' }}
                </a>
                <div class="d-flex gap-1">
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
                <i class="bi bi-lightning-charge" style="font-size:2rem; color:#94a3b8; display:block; margin-bottom:0.5rem;"></i>
                <div class="fw-semibold mb-2">No Skills Found</div>
                <p class="text-muted small">Try adjusting your search terms.</p>
            </div>
        </div>
    </div>
@endforelse
