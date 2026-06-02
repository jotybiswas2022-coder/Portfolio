@extends('backend.app')

@section('content')

{{-- trending design — all inline CSS, no style block --}}

<div class="container-fluid py-3 py-md-4">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:12px;margin-bottom:12px;">
                <div>
                    <h4 style="margin:0;font-weight:800;font-size:1.5rem;background:linear-gradient(135deg,#667eea,#764ba2);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                        <i class="bi bi-speedometer2 me-2" style="-webkit-text-fill-color:#667eea;"></i>Dashboard
                    </h4>
                    <p style="margin:4px 0 0;font-size:0.85rem;color:#6c757d;">
                        <i class="bi bi-calendar3 me-1"></i> {{ now()->timezone('Asia/Dhaka')->format('l, d F Y') }}
                    </p>
                </div>
                <div style="display:flex;align-items:center;gap:8px;background:linear-gradient(135deg,#f8f9ff,#eef1ff);padding:8px 18px;border-radius:50px;border:1px solid rgba(102,126,234,0.15);">
                    <div style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,#667eea,#764ba2);display:flex;align-items:center;justify-content:center;color:#fff;font-size:0.85rem;font-weight:700;">
                        {{ strtoupper(substr($account->name ?? 'A', 0, 1)) }}
                    </div>
                    <span style="font-weight:600;font-size:0.85rem;color:#444;">{{ $account->name ?? 'Admin' }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Summary Cards --}}
    <div class="row g-3 mb-4">
        @php
            $cards = [
                ['icon' => 'shield-check', 'count' => $accountsCount, 'label' => 'Total Admins', 'sub' => 'System administrators', 'color' => '#667eea'],
                ['icon' => 'envelope-paper', 'count' => $contactsCount, 'label' => 'Total Messages', 'sub' => 'Contact submissions', 'color' => '#f093fb'],
                ['icon' => 'droplet', 'count' => $donorsCount, 'label' => 'Total Donors', 'sub' => 'Registered donors', 'color' => '#e35e6f'],
            ];
        @endphp
        @foreach($cards as $card)
        <div class="col-6 col-md-4">
            <div style="position:relative;padding:20px 22px;border-radius:20px;height:100%;background:linear-gradient(135deg,{{ $card['color'] }},{{ $card['color'] }}dd);box-shadow:0 8px 32px {{ $card['color'] }}33;transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1);cursor:pointer;overflow:hidden;"
                 onmouseover="this.style.transform='translateY(-6px) scale(1.02)';this.style.boxShadow='0 16px 48px {{ $card['color'] }}55'"
                 onmouseout="this.style.transform='';this.style.boxShadow='0 8px 32px {{ $card['color'] }}33'">
                <div style="position:absolute;top:-30px;right:-30px;width:120px;height:120px;border-radius:50%;background:rgba(255,255,255,0.08);pointer-events:none;"></div>
                <div style="position:absolute;bottom:-20px;left:-20px;width:80px;height:80px;border-radius:50%;background:rgba(255,255,255,0.05);pointer-events:none;"></div>
                <div style="display:flex;align-items:center;gap:14px;">
                    <div style="width:50px;height:50px;border-radius:14px;background:rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;backdrop-filter:blur(4px);flex-shrink:0;">
                        <i class="bi bi-{{ $card['icon'] }}" style="font-size:1.5rem;color:#fff;"></i>
                    </div>
                    <div>
                        <h3 style="margin:0;font-weight:800;font-size:1.8rem;color:#fff;line-height:1.2;">{{ $card['count'] }}</h3>
                        <p style="margin:0;font-size:0.8rem;font-weight:600;color:rgba(255,255,255,0.75);">{{ $card['label'] }}</p>
                    </div>
                </div>
                <div style="margin-top:10px;font-size:0.75rem;color:rgba(255,255,255,0.6);">
                    <i class="bi bi-arrow-up-short"></i> {{ $card['sub'] }}
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Recent Data --}}
    <div class="row g-3">

        {{-- Messages --}}
        <div class="col-12 col-lg-7">
            <div style="background:#fff;border-radius:20px;box-shadow:0 4px 24px rgba(0,0,0,0.06);height:100%;overflow:hidden;border:1px solid rgba(0,0,0,0.04);">
                <div style="display:flex;align-items:center;justify-content:space-between;padding:18px 22px 0;">
                    <h6 style="margin:0;font-weight:700;font-size:0.95rem;color:#333;">
                        <i class="bi bi-chat-dots me-2" style="color:#667eea;"></i>Recent Messages
                    </h6>
                    <a href="{{ url('/admin/contact') }}" style="font-size:0.8rem;padding:5px 16px;border-radius:50px;border:1px solid #667eea;color:#667eea;text-decoration:none;font-weight:600;transition:all 0.3s;"
                       onmouseover="this.style.background='#667eea';this.style.color='#fff'"
                       onmouseout="this.style.background='transparent';this.style.color='#667eea'">
                        View All <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <div style="padding:8px 22px 16px;">
                    @if($contacts->isEmpty())
                        <div style="text-align:center;padding:40px 0;color:#999;">
                            <i class="bi bi-inbox" style="font-size:2.5rem;display:block;margin-bottom:8px;"></i>
                            <span style="font-weight:500;">No messages found</span>
                        </div>
                    @else
                        @foreach($contacts as $contact)
                            <div style="display:flex;align-items:flex-start;gap:12px;padding:14px 0;{{ !$loop->last ? 'border-bottom:1px solid #f0f0f5;' : '' }}border-radius:12px;transition:all 0.2s;margin:0 -6px;padding-left:6px;padding-right:6px;"
                                 onmouseover="this.style.background='#f8f9ff'"
                                 onmouseout="this.style.background='transparent'">
                                <div style="width:40px;height:40px;border-radius:50%;background:linear-gradient(135deg,#667eea,#764ba2);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:0.85rem;flex-shrink:0;box-shadow:0 4px 12px rgba(102,126,234,0.25);">
                                    {{ strtoupper(substr($contact->name, 0, 1)) }}
                                </div>
                                <div style="flex-grow:1;min-width:0;">
                                    <div style="display:flex;justify-content:space-between;align-items:center;gap:8px;">
                                        <h6 style="margin:0;font-weight:600;font-size:0.85rem;color:#333;">{{ $contact->name }}</h6>
                                        <small style="color:#adb5bd;white-space:nowrap;font-size:0.75rem;">{{ \Carbon\Carbon::parse($contact->created_at)->timezone('Asia/Dhaka')->diffForHumans() }}</small>
                                    </div>
                                    <p style="margin:2px 0 0;font-size:0.78rem;color:#999;">{{ $contact->email }}</p>
                                    <p style="margin:4px 0 0;font-size:0.82rem;color:#666;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $contact->message }}</p>
                                    <button style="background:none;border:none;color:#667eea;font-size:0.78rem;font-weight:600;padding:0;margin-top:4px;cursor:pointer;" data-bs-toggle="modal" data-bs-target="#messageModal{{ $contact->id }}">
                                        Read more <i class="bi bi-chevron-right" style="font-size:0.7rem;"></i>
                                    </button>
                                </div>
                            </div>

                            {{-- Modal --}}
                            <div class="modal fade" id="messageModal{{ $contact->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                                    <div style="background:#fff;border-radius:20px;border:none;box-shadow:0 24px 80px rgba(0,0,0,0.2);overflow:hidden;">
                                        <div style="background:linear-gradient(135deg,#667eea,#764ba2);padding:16px 22px;display:flex;align-items:center;justify-content:space-between;">
                                            <h5 style="margin:0;color:#fff;font-weight:600;font-size:0.95rem;">
                                                <i class="bi bi-person-circle me-2"></i>{{ $contact->name }}
                                            </h5>
                                            <button type="button" style="background:none;border:none;color:#fff;font-size:1.2rem;cursor:pointer;opacity:0.8;" data-bs-dismiss="modal">&times;</button>
                                        </div>
                                        <div style="padding:18px 22px;">
                                            <div style="display:flex;gap:8px;margin-bottom:14px;flex-wrap:wrap;">
                                                <span style="font-size:0.78rem;padding:4px 12px;border-radius:50px;background:#f0f0f5;color:#555;">
                                                    <i class="bi bi-envelope me-1"></i>{{ $contact->email }}
                                                </span>
                                                <span style="font-size:0.78rem;padding:4px 12px;border-radius:50px;background:#f0f0f5;color:#555;">
                                                    <i class="bi bi-calendar me-1"></i>{{ \Carbon\Carbon::parse($contact->created_at)->timezone('Asia/Dhaka')->format('d M Y, h:i A') }}
                                                </span>
                                            </div>
                                            <p style="margin:0;font-size:0.9rem;color:#444;line-height:1.6;">{{ $contact->message }}</p>
                                        </div>
                                        <div style="padding:0 22px 18px;display:flex;justify-content:flex-end;">
                                            <button type="button" style="padding:7px 24px;border-radius:50px;border:1px solid #ddd;background:#fff;color:#666;font-size:0.85rem;cursor:pointer;" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        {{-- Donors --}}
        <div class="col-12 col-lg-5">
            <div style="background:#fff;border-radius:20px;box-shadow:0 4px 24px rgba(0,0,0,0.06);height:100%;overflow:hidden;border:1px solid rgba(0,0,0,0.04);">
                <div style="display:flex;align-items:center;justify-content:space-between;padding:18px 22px 0;">
                    <h6 style="margin:0;font-weight:700;font-size:0.95rem;color:#333;">
                        <i class="bi bi-people me-2" style="color:#e35e6f;"></i>Recent Donors
                    </h6>
                    <a href="{{ url('/admin/donor_list') }}" style="font-size:0.8rem;padding:5px 16px;border-radius:50px;border:1px solid #e35e6f;color:#e35e6f;text-decoration:none;font-weight:600;transition:all 0.3s;"
                       onmouseover="this.style.background='#e35e6f';this.style.color='#fff'"
                       onmouseout="this.style.background='transparent';this.style.color='#e35e6f'">
                        View All <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <div style="padding:8px 22px 16px;">
                    @if($donors->isEmpty())
                        <div style="text-align:center;padding:40px 0;color:#999;">
                            <i class="bi bi-person-plus" style="font-size:2.5rem;display:block;margin-bottom:8px;"></i>
                            <span style="font-weight:500;">No donors found</span>
                        </div>
                    @else
                        @php
                            $bloodColors = [
                                'A+' => '#dc3545', 'A-' => '#e35e6f',
                                'B+' => '#0d6efd', 'B-' => '#5a9bf5',
                                'AB+'=> '#6f42c1', 'AB-'=> '#9b72cf',
                                'O+' => '#198754', 'O-' => '#4caf7d',
                            ];
                        @endphp
                        @foreach($donors as $donor)
                            @php $bgColor = $bloodColors[$donor->blood] ?? '#dc3545'; @endphp
                            <div style="display:flex;align-items:center;gap:12px;padding:10px 0;{{ !$loop->last ? 'border-bottom:1px solid #f0f0f5;' : '' }}border-radius:12px;transition:all 0.2s;margin:0 -6px;padding-left:6px;padding-right:6px;"
                                 onmouseover="this.style.background='#fff5f5'"
                                 onmouseout="this.style.background='transparent'">
                                <div style="width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.75rem;color:#fff;flex-shrink:0;background:{{ $bgColor }};box-shadow:0 4px 12px {{ $bgColor }}44;">
                                    {{ $donor->blood }}
                                </div>
                                <div style="flex-grow:1;min-width:0;">
                                    <h6 style="margin:0;font-weight:600;font-size:0.85rem;color:#333;">{{ $donor->name }}</h6>
                                    <small style="color:#999;font-size:0.78rem;">{{ $donor->number ?? 'N/A' }} &middot; {{ $donor->division ?? 'N/A' }}</small>
                                </div>
                                <small style="color:#adb5bd;white-space:nowrap;font-size:0.72rem;">{{ \Carbon\Carbon::parse($donor->created_at)->timezone('Asia/Dhaka')->diffForHumans() }}</small>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

@endsection