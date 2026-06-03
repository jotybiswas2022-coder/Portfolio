@extends('backend.app')

@section('content')

<div class="container-fluid py-3 py-md-4">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:12px;margin-bottom:12px;">
                <div>
                    <h4 style="margin:0;font-weight:800;font-size:1.5rem;background:linear-gradient(135deg,#667eea,#764ba2);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                        <i class="bi bi-speedometer2 me-2" style="-webkit-text-fill-color:#667eea;"></i>Analytics Dashboard
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

    {{-- ===== STAT CARDS ===== --}}
    <div class="row g-3 mb-4">
        @php
            $statCards = [
                ['icon' => 'droplet', 'count' => $donorsCount, 'label' => 'Total Donors', 'sub' => 'Registered donors', 'color' => '#e35e6f', 'trend' => '+'.App\Models\Profile::whereDate('created_at', '>=', \Carbon\Carbon::today()->subDays(7))->count().' this week'],
                ['icon' => 'heart-pulse', 'count' => $eligibleDonors, 'label' => 'Eligible Donors', 'sub' => 'Can donate now', 'color' => '#22c55e', 'trend' => number_format(($donorsCount > 0 ? ($eligibleDonors / $donorsCount) * 100 : 0), 1).'% of total'],
                ['icon' => 'exclamation-triangle', 'count' => $totalRequests, 'label' => 'Blood Requests', 'sub' => 'Total requests', 'color' => '#f59e0b', 'trend' => $pendingRequests.' pending'],
                ['icon' => 'check-circle', 'count' => $fulfilledRequests, 'label' => 'Fulfilled', 'sub' => 'Successfully fulfilled', 'color' => '#3b82f6', 'trend' => $totalRequests > 0 ? number_format(($fulfilledRequests / $totalRequests) * 100, 1).'% success rate' : '0% success rate'],
            ];
        @endphp
        @foreach($statCards as $card)
        <div class="col-6 col-xl-3">
            <div style="position:relative;padding:18px 20px;border-radius:18px;height:100%;background:linear-gradient(135deg,{{ $card['color'] }},{{ $card['color'] }}dd);box-shadow:0 8px 32px {{ $card['color'] }}33;transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1);cursor:pointer;overflow:hidden;"
                 onmouseover="this.style.transform='translateY(-5px) scale(1.02)';this.style.boxShadow='0 16px 48px {{ $card['color'] }}55'"
                 onmouseout="this.style.transform='';this.style.boxShadow='0 8px 32px {{ $card['color'] }}33'">
                <div style="position:absolute;top:-30px;right:-30px;width:120px;height:120px;border-radius:50%;background:rgba(255,255,255,0.08);pointer-events:none;"></div>
                <div style="display:flex;align-items:center;gap:14px;">
                    <div style="width:46px;height:46px;border-radius:13px;background:rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;backdrop-filter:blur(4px);flex-shrink:0;">
                        <i class="bi bi-{{ $card['icon'] }}" style="font-size:1.3rem;color:#fff;"></i>
                    </div>
                    <div>
                        <h3 class="stat-counter" style="margin:0;font-weight:800;font-size:1.6rem;color:#fff;line-height:1.2;" data-target="{{ $card['count'] }}">0</h3>
                        <p style="margin:0;font-size:0.78rem;font-weight:600;color:rgba(255,255,255,0.75);">{{ $card['label'] }}</p>
                    </div>
                </div>
                <div style="margin-top:8px;font-size:0.72rem;color:rgba(255,255,255,0.6);display:flex;align-items:center;gap:4px;">
                    <i class="bi bi-arrow-up-short"></i> {{ $card['trend'] }}
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- ===== CHARTS ROW 1 ===== --}}
    <div class="row g-3 mb-4">
        {{-- Blood Group Pie Chart --}}
        <div class="col-12 col-lg-6">
            <div style="background:#fff;border-radius:20px;box-shadow:0 4px 24px rgba(0,0,0,0.06);overflow:hidden;border:1px solid rgba(0,0,0,0.04);height:100%;">
                <div style="padding:16px 22px;border-bottom:1px solid #f0f0f5;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;">
                    <h6 style="margin:0;font-weight:700;font-size:0.9rem;color:#333;">
                        <i class="bi bi-pie-chart-fill me-2" style="color:#e35e6f;"></i>Blood Group Distribution
                    </h6>
                    <span style="font-size:0.72rem;color:#999;font-weight:500;">{{ $donorsCount }} total donors</span>
                </div>
                <div style="padding:14px;position:relative;">
                    <canvas id="bloodGroupChart" height="280"></canvas>
                    @if($donorsCount == 0)
                    <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,0.85);border-radius:20px;z-index:2;flex-direction:column;gap:8px;">
                        <i class="bi bi-inbox" style="font-size:2rem;color:#ccc;"></i>
                        <span style="color:#999;font-weight:500;font-size:0.85rem;">No donor data yet</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Donor Registration Trends --}}
        <div class="col-12 col-lg-6">
            <div style="background:#fff;border-radius:20px;box-shadow:0 4px 24px rgba(0,0,0,0.06);overflow:hidden;border:1px solid rgba(0,0,0,0.04);height:100%;">
                <div style="padding:16px 22px;border-bottom:1px solid #f0f0f5;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;">
                    <h6 style="margin:0;font-weight:700;font-size:0.9rem;color:#333;">
                        <i class="bi bi-graph-up-arrow me-2" style="color:#667eea;"></i>Donor Registration Trends
                    </h6>
                    <span style="font-size:0.72rem;color:#999;font-weight:500;">Last 30 days</span>
                </div>
                <div style="padding:14px;position:relative;">
                    <canvas id="donorTrendChart" height="280"></canvas>
                    @if(array_sum($donorTrends) == 0)
                    <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,0.85);border-radius:20px;z-index:2;flex-direction:column;gap:8px;">
                        <i class="bi bi-graph-down" style="font-size:2rem;color:#ccc;"></i>
                        <span style="color:#999;font-weight:500;font-size:0.85rem;">No registration data yet</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- ===== CHARTS ROW 2 ===== --}}
    <div class="row g-3 mb-4">
        {{-- Blood Request Status --}}
        <div class="col-12 col-lg-4">
            <div style="background:#fff;border-radius:20px;box-shadow:0 4px 24px rgba(0,0,0,0.06);overflow:hidden;border:1px solid rgba(0,0,0,0.04);height:100%;">
                <div style="padding:16px 22px;border-bottom:1px solid #f0f0f5;">
                    <h6 style="margin:0;font-weight:700;font-size:0.9rem;color:#333;">
                        <i class="bi bi-bar-chart-fill me-2" style="color:#f59e0b;"></i>Request Status Breakdown
                    </h6>
                </div>
                <div style="padding:14px;">
                    <canvas id="requestStatusChart" height="240"></canvas>
                </div>
            </div>
        </div>

        {{-- Urgency Breakdown --}}
        <div class="col-12 col-lg-4">
            <div style="background:#fff;border-radius:20px;box-shadow:0 4px 24px rgba(0,0,0,0.06);overflow:hidden;border:1px solid rgba(0,0,0,0.04);height:100%;">
                <div style="padding:16px 22px;border-bottom:1px solid #f0f0f5;">
                    <h6 style="margin:0;font-weight:700;font-size:0.9rem;color:#333;">
                        <i class="bi bi-activity me-2" style="color:#dc2626;"></i>Urgency Breakdown
                    </h6>
                </div>
                <div style="padding:14px;">
                    <canvas id="urgencyChart" height="240"></canvas>
                </div>
            </div>
        </div>

        {{-- Quick Stats Summary --}}
        <div class="col-12 col-lg-4">
            <div style="background:#fff;border-radius:20px;box-shadow:0 4px 24px rgba(0,0,0,0.06);overflow:hidden;border:1px solid rgba(0,0,0,0.04);height:100%;">
                <div style="padding:16px 22px;border-bottom:1px solid #f0f0f5;">
                    <h6 style="margin:0;font-weight:700;font-size:0.9rem;color:#333;">
                        <i class="bi bi-info-circle-fill me-2" style="color:#667eea;"></i>Quick Summary
                    </h6>
                </div>
                <div style="padding:14px 20px;">
                    @php
                        $summaryItems = [
                            ['icon' => 'droplet', 'label' => 'Total Donors', 'value' => $donorsCount, 'color' => '#e35e6f', 'bg' => '#fef2f2'],
                            ['icon' => 'heart-pulse', 'label' => 'Eligible to Donate', 'value' => $eligibleDonors, 'color' => '#22c55e', 'bg' => '#f0fdf4'],
                            ['icon' => 'exclamation-triangle', 'label' => 'Active Requests', 'value' => $pendingRequests + $matchedRequests, 'color' => '#f59e0b', 'bg' => '#fefce8'],
                            ['icon' => 'check-circle', 'label' => 'Fulfilled Requests', 'value' => $fulfilledRequests, 'color' => '#3b82f6', 'bg' => '#eff6ff'],
                            ['icon' => 'x-circle', 'label' => 'Cancelled', 'value' => $cancelledRequests, 'color' => '#6b7280', 'bg' => '#f3f4f6'],
                            ['icon' => 'clock', 'label' => 'Avg. Match Rate', 'value' => $totalRequests > 0 ? number_format(($matchedRequests / $totalRequests) * 100, 1).'%' : '0%', 'color' => '#8b5cf6', 'bg' => '#f5f3ff'],
                        ];
                    @endphp
                    <div style="display:flex;flex-direction:column;gap:8px;">
                        @foreach($summaryItems as $item)
                        <div style="display:flex;align-items:center;gap:10px;padding:8px 12px;border-radius:12px;background:{{ $item['bg'] }};transition:all 0.2s;"
                             onmouseover="this.style.transform='translateX(4px)'" onmouseout="this.style.transform=''">
                            <div style="width:34px;height:34px;border-radius:10px;background:{{ $item['color'] }}15;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="bi bi-{{ $item['icon'] }}" style="color:{{ $item['color'] }};font-size:0.9rem;"></i>
                            </div>
                            <span style="flex:1;font-size:0.8rem;font-weight:500;color:#666;">{{ $item['label'] }}</span>
                            <span style="font-weight:800;font-size:0.95rem;color:{{ $item['color'] }};">{{ $item['value'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== RECENT DATA ===== --}}
    <div class="row g-3">
        {{-- Recent Messages --}}
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

        {{-- Recent Donors --}}
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

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const bloodColors = {
        'A+': '#dc3545', 'A-': '#e35e6f',
        'B+': '#0d6efd', 'B-': '#5a9bf5',
        'AB+': '#8b5cf6', 'AB-': '#a78bfa',
        'O+': '#22c55e', 'O-': '#4ade80',
    };

    Chart.defaults.font.family = "'Inter', 'Segoe UI', sans-serif";
    Chart.defaults.font.size = 11;
    Chart.defaults.color = '#6b7280';

    // 1. Blood Group Pie Chart
    var pieCtx = document.getElementById('bloodGroupChart');
    if (pieCtx) {
        var bgLabels = @json($bloodGroups);
        var bgData = @json(array_values($bloodGroupCounts));
        var bgColors = bgLabels.map(function(g) { return bloodColors[g] || '#6b7280'; });

        new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: bgLabels,
                datasets: [{
                    data: bgData,
                    backgroundColor: bgColors,
                    borderColor: '#ffffff',
                    borderWidth: 3,
                    hoverOffset: 8,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '60%',
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            padding: 12,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            font: { size: 11, weight: '500' },
                            generateLabels: function(chart) {
                                var data = chart.data;
                                return data.labels.map(function(label, i) {
                                    var val = data.datasets[0].data[i];
                                    var total = data.datasets[0].data.reduce(function(a, b) { return a + b; }, 0);
                                    var pct = total > 0 ? ((val / total) * 100).toFixed(1) : '0';
                                    return {
                                        text: label + '  (' + val + ' - ' + pct + '%)',
                                        fillStyle: data.datasets[0].backgroundColor[i],
                                        strokeStyle: data.datasets[0].backgroundColor[i],
                                        pointStyle: 'circle',
                                        index: i
                                    };
                                });
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        titleFont: { weight: '600' },
                        bodyFont: { size: 12 },
                        padding: 12,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(ctx) {
                                var total = ctx.dataset.data.reduce(function(a, b) { return a + b; }, 0);
                                var pct = total > 0 ? ((ctx.parsed / total) * 100).toFixed(1) : '0';
                                return ' ' + ctx.parsed + ' donors (' + pct + '%)';
                            }
                        }
                    }
                }
            }
        });
    }

    // 2. Donor Registration Trend
    var trendCtx = document.getElementById('donorTrendChart');
    if (trendCtx) {
        var trendLabels = @json($trendLabels);
        var trendData = @json($donorTrends);
        var trendMax = Math.max(1, Math.max.apply(null, trendData));

        new Chart(trendCtx, {
            type: 'bar',
            data: {
                labels: trendLabels,
                datasets: [{
                    label: 'New Donors',
                    data: trendData,
                    backgroundColor: function(context) {
                        var chart = context.chart;
                        var ctx = chart.ctx;
                        var gradient = ctx.createLinearGradient(0, 0, 0, 300);
                        gradient.addColorStop(0, 'rgba(102,126,234,0.6)');
                        gradient.addColorStop(1, 'rgba(102,126,234,0.05)');
                        return gradient;
                    },
                    borderColor: '#667eea',
                    borderWidth: 1.5,
                    borderRadius: 4,
                    hoverBackgroundColor: '#667eea',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        padding: 10,
                        cornerRadius: 8,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: Math.ceil(trendMax * 1.3),
                        ticks: {
                            stepSize: Math.max(1, Math.ceil(trendMax / 4)),
                            font: { size: 10 }
                        },
                        grid: { color: 'rgba(0,0,0,0.04)' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { maxTicksLimit: 8, font: { size: 9 } }
                    }
                }
            }
        });
    }

    // 3. Request Status Doughnut
    var statusCtx = document.getElementById('requestStatusChart');
    if (statusCtx) {
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Matched', 'Fulfilled', 'Cancelled'],
                datasets: [{
                    data: [{{ $pendingRequests }}, {{ $matchedRequests }}, {{ $fulfilledRequests }}, {{ $cancelledRequests }}],
                    backgroundColor: ['#f59e0b', '#3b82f6', '#22c55e', '#6b7280'],
                    borderColor: '#ffffff',
                    borderWidth: 3,
                    hoverOffset: 6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '55%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 10,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            font: { size: 10, weight: '500' }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        padding: 10,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(ctx) {
                                var total = ctx.dataset.data.reduce(function(a, b) { return a + b; }, 0);
                                var pct = total > 0 ? ((ctx.parsed / total) * 100).toFixed(1) : '0';
                                return ' ' + ctx.parsed + ' (' + pct + '%)';
                            }
                        }
                    }
                }
            }
        });
    }

    // 4. Urgency Bar Chart
    var urgencyCtx = document.getElementById('urgencyChart');
    if (urgencyCtx) {
        new Chart(urgencyCtx, {
            type: 'bar',
            data: {
                labels: ['Critical', 'Urgent', 'Normal'],
                datasets: [{
                    label: 'Active Requests',
                    data: [{{ $criticalRequests }}, {{ $urgentRequests }}, {{ $normalRequests }}],
                    backgroundColor: ['rgba(220,38,38,0.7)', 'rgba(245,158,11,0.7)', 'rgba(59,130,246,0.7)'],
                    borderColor: ['#dc2626', '#f59e0b', '#3b82f6'],
                    borderWidth: 2,
                    borderRadius: 6,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        padding: 10,
                        cornerRadius: 8,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1, font: { size: 10 } },
                        grid: { color: 'rgba(0,0,0,0.04)' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 11, weight: '600' } }
                    }
                }
            }
        });
    }

    // Animated Stat Counters
    function animateCounter(el) {
        var target = parseInt(el.dataset.target);
        if (isNaN(target) || target === 0) {
            el.textContent = '0';
            return;
        }
        var duration = 1500;
        var step = Math.max(1, Math.floor(target / 30));
        var current = 0;
        var increment = setInterval(function() {
            current += step;
            if (current >= target) {
                el.textContent = target;
                clearInterval(increment);
            } else {
                el.textContent = current;
            }
        }, duration / 30);
    }

    var counterObserver = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                counterObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('.stat-counter').forEach(function(el) {
        counterObserver.observe(el);
    });
});
</script>

@endsection
