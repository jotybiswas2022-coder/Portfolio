@forelse($gigs as $gig)
    <tr>
        <td class="ps-4 fw-semibold text-muted">{{ $loop->iteration }}</td>
        <td class="text-center">
            @if($gig->image)
                <img src="{{ config('app.storage_url') }}{{ $gig->image }}"
                     alt="{{ $gig->title }}"
                     style="width:45px;height:35px;object-fit:cover;border-radius:6px;">
            @else
                <span class="text-muted small">—</span>
            @endif
        </td>
        <td class="fw-semibold">{{ $gig->title }}</td>
        <td>
            <span class="badge bg-secondary">{{ $gig->basic_name }}</span>
            <span class="fw-bold ms-1" style="color:#059669;">{{ $gig->basic_price }}</span>
        </td>
        <td>
            <span class="badge bg-primary">{{ $gig->standard_name }}</span>
            <span class="fw-bold ms-1" style="color:#059669;">{{ $gig->standard_price }}</span>
        </td>
        <td>
            <span class="badge bg-warning text-dark">{{ $gig->premium_name }}</span>
            <span class="fw-bold ms-1" style="color:#059669;">{{ $gig->premium_price }}</span>
        </td>
        <td><span class="badge rounded-pill px-3 py-1" style="background:#f1f5f9; color:#475569; font-weight:500;">{{ $gig->sort_order }}</span></td>
        <td>
            <a href="{{ route('admin.gigs.toggleStatus', $gig->id) }}"
               class="badge rounded-pill px-3 py-1 text-decoration-none status-badge {{ $gig->is_active ? 'active-badge' : 'inactive-badge' }}"
               data-title="{{ $gig->title }}">
                {{ $gig->is_active ? 'Active' : 'Inactive' }}
            </a>
        </td>
        <td>
            <div class="d-flex gap-1">
                <a href="{{ route('admin.gigs.edit', $gig->id) }}"
                   class="btn btn-sm btn-outline-primary rounded-3 px-2">
                    <i class="bi bi-pencil"></i>
                </a>
                <button type="button"
                        class="btn btn-sm btn-outline-danger rounded-3 px-2 delete-btn"
                        data-id="{{ $gig->id }}"
                        data-title="{{ $gig->title }}">
                    <i class="bi bi-trash"></i>
                </button>
                <form id="delete-form-{{ $gig->id }}"
                      action="{{ route('admin.gigs.destroy', $gig->id) }}"
                      method="POST" class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="9" class="text-center py-5">
            <div class="empty-state">
                <i class="bi bi-search" style="font-size:2rem; color:#94a3b8; display:block; margin-bottom:0.5rem;"></i>
                <div class="fw-semibold mb-2">No Gigs Found</div>
                <p class="text-muted small">Try adjusting your search terms.</p>
            </div>
        </td>
    </tr>
@endforelse
