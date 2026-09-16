@forelse($projects as $project)
    <div class="col-12 col-md-6 col-xxl-4">
        <div class="proj-card">

            {{-- Thumb + Title + Order --}}
            <div class="d-flex align-items-start gap-3">
                <div class="proj-thumb">
                    @if($project->image)
                        <img src="{{ config('app.storage_url') }}{{ $project->image }}" alt="{{ $project->title }}">
                    @else
                        <i class="bi bi-folder2-open"></i>
                    @endif
                </div>
                <div class="flex-grow-1 pe-1 min-w-0">
                    <div class="proj-title text-truncate">{{ $project->title }}</div>
                    @if($project->category)
                        <div class="proj-cat"><i class="bi bi-tag me-1"></i>{{ $project->category }}</div>
                    @endif
                </div>
                <span class="order-badge" title="Sort order"><i class="bi bi-arrow-down-up"></i>{{ $project->sort_order }}</span>
            </div>

            {{-- Tech Stack --}}
            @if(!empty($project->getTechStackArray()))
                <div class="d-flex flex-wrap gap-1.5 pt-3 proj-tech">
                    @foreach($project->getTechStackArray() as $tech)
                        <span class="tech-tag"><i class="bi bi-code-slash me-1"></i>{{ $tech }}</span>
                    @endforeach
                </div>
            @endif

            {{-- Status + Actions --}}
            <div class="proj-actions">
                <a href="{{ route('admin.projects.toggleStatus', $project->id) }}"
                   class="status-badge {{ $project->is_active ? 'status-active' : 'status-inactive' }}"
                   data-title="{{ $project->title }}">
                    <span class="status-dot"></span>
                    {{ $project->is_active ? 'Active' : 'Inactive' }}
                </a>
                <div class="d-flex gap-1 align-items-center">
                    <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn-icon btn-icon-edit" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <button type="button"
                            class="btn-icon btn-icon-del delete-btn"
                            data-id="{{ $project->id }}"
                            data-title="{{ $project->title }}" title="Delete">
                        <i class="bi bi-trash"></i>
                    </button>
                    <form id="delete-form-{{ $project->id }}"
                          action="{{ route('admin.projects.destroy', $project->id) }}"
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
                <i class="bi bi-folder2-open"></i>
                <div class="fw-semibold mb-2">No Projects Found</div>
                <p class="text-muted small mb-0">Try adjusting your search terms.</p>
            </div>
        </div>
    </div>
@endforelse