@extends('backend.app')

@section('content')
<div class="container py-4">
    <div class="card-modern" style="max-width: 700px; margin: 0 auto;">
        <div class="card-header">
            <i class="bi bi-person-circle me-2"></i> Account Profile
        </div>
        <div class="card-body">
            <div class="d-flex align-items-center flex-wrap gap-4">
                <!-- Profile Image -->
                <div>
                    @if(isset($account) && $account->image)
                        <img src="{{ config('app.storage_url') }}{{ $account->image }}" 
                             alt="{{ $account->name ?? 'User' }}"
                             style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid var(--admin-primary);">
                    @else
                        <div style="width: 100px; height: 100px; border-radius: 50%; background: linear-gradient(135deg, #6366f1, #8b5cf6); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; border: 3px solid var(--admin-primary);">
                            {{ isset($account->name) ? strtoupper(substr($account->name, 0, 1)) : 'U' }}
                        </div>
                    @endif
                </div>

                <!-- Account Info -->
                <div style="flex: 1;">
                    <h3 class="fw-bold mb-2">{{ $account->name ?? 'Not set' }}</h3>
                    @if(isset($account) && $account->cv)
                        <a href="{{ config('app.storage_url') }}{{ $account->cv }}" 
                           target="_blank" class="btn btn-sm btn-outline-danger rounded-3">
                            <i class="bi bi-file-earmark-pdf-fill me-1"></i> View CV
                        </a>
                    @else
                        <p class="text-muted small mb-0"><i class="bi bi-file-earmark me-1"></i>No CV uploaded</p>
                    @endif
                </div>

                <!-- Edit Button -->
                <div>
                    <a href="{{ url('/admin/account/edit') }}" class="btn btn-admin btn-admin-primary">
                        <i class="bi bi-pencil-square me-1"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
