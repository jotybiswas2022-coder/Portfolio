@forelse($caseStudies as $caseStudy)
    <div class="col-12 col-md-6 col-xl-4">
        <div class="cs-card">
            {{-- Thumb + Title + Order --}}
            <div class="d-flex align-items-start gap-3">
                @if($caseStudy->image)
                    <img src="{{ config('app.storage_url') }}{{ $caseStudy->image }}"
                         alt="{{ $caseStudy->title }}" class="cs-thumb">
                @else
                    <div class="cs-thumb-placeholder"><i class="bi bi-image"></i></div>
                @endif
                <div class="flex-grow-1">
                    <h6 class="cs-title">{{ $caseStudy->title }}</h6>
                    <span class="cs-client"><i class="bi bi-person me-1"></i>{{ $caseStudy->client ?: 'No client' }}</span>
                </div>
                <span class="order-badge"><i class="bi bi-arrow-down-up me-1"></i>{{ $caseStudy->sort_order }}</span>
            </div>

            {{-- Category + Techs --}}
            <div class="d-flex flex-wrap gap-1">
                @if($caseStudy->category)
                    <span class="cat-badge">{{ $caseStudy->category }}</span>
                @endif
                @foreach($caseStudy->tech_list as $tech)
                    <span class="tech-badge">{{ $tech }}</span>
                @endforeach
            </div>

            {{-- Status + Actions --}}
            <div class="d-flex align-items-center justify-content-between sv-actions mt-auto">
                <a href="{{ route('admin.casestudies.toggleStatus', $caseStudy->id) }}"
                   class="status-badge {{ $caseStudy->is_active ? 'active-badge' : 'inactive-badge' }}"
                   data-title="{{ $caseStudy->title }}">
                    {{ $caseStudy->is_active ? 'Active' : 'Inactive' }}
                </a>
                <div class="d-flex gap-1">
                    <a href="{{ route('admin.casestudies.edit', $caseStudy->id) }}"
                       class="btn-icon btn-icon-edit" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <button type="button"
                            class="btn-icon btn-icon-del delete-btn"
                            data-id="{{ $caseStudy->id }}"
                            data-title="{{ $caseStudy->title }}" title="Delete">
                        <i class="bi bi-trash"></i>
                    </button>
                    <form id="delete-form-{{ $caseStudy->id }}"
                          action="{{ route('admin.casestudies.destroy', $caseStudy->id) }}"
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
                <div class="fw-semibold mb-2">No Case Studies Found</div>
                <p class="text-muted" style="font-size:0.78rem;">Try adjusting your search terms.</p>
            </div>
        </div>
    </div>
@endforelse