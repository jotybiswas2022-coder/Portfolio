@extends('frontend.forex.layouts.app')

@section('title', 'My Orders — Core Trading Solutions')

@section('content')
<style>
.my-orders-page{min-height:100vh;padding-top:6rem;padding-bottom:4rem;position:relative;overflow:hidden}
.my-orders-inner{max-width:64rem;margin:0 auto;padding:0 1rem;position:relative;z-index:10}
@media (min-width:640px){.my-orders-inner{padding:0 1.5rem}}
@media (min-width:1024px){.my-orders-inner{padding:0 2rem}}
.my-orders-header{margin-bottom:2.5rem;text-align:center}
.my-orders-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:0.75rem;margin-bottom:2.5rem}
@media (max-width:480px){.my-orders-stats{grid-template-columns:1fr}}
.my-orders-stat-card{background:rgba(17,17,17,0.6);border:1px solid rgba(255,255,255,0.06);border-radius:0.75rem;padding:1rem;text-align:center;transition:all 0.3s}
.my-orders-stat-card:hover{border-color:rgba(0,174,239,0.2)}
.my-orders-stat-value{color:#EAEAEA;font-weight:700;font-size:1.375rem;font-family:'JetBrains Mono',monospace;margin-bottom:0.125rem}
.my-orders-stat-label{color:rgba(234,234,234,0.4);font-size:0.75rem}
.my-orders-list{display:flex;flex-direction:column;gap:0.75rem}
.my-orders-card{background:rgba(17,17,17,0.6);border:1px solid rgba(255,255,255,0.06);border-radius:1rem;padding:1.25rem;transition:all 0.3s}
.my-orders-card:hover{border-color:rgba(0,174,239,0.15);background:rgba(17,17,17,0.8)}
.my-orders-card-top{display:flex;align-items:flex-start;justify-content:space-between;gap:1rem;margin-bottom:0.75rem;flex-wrap:wrap}
.my-orders-card-order{display:flex;flex-direction:column;gap:0.125rem}
.my-orders-card-number{color:#00AEEF;font-family:'JetBrains Mono',monospace;font-size:0.875rem;font-weight:600}
.my-orders-card-date{color:rgba(234,234,234,0.3);font-size:0.75rem}
.my-orders-card-bottom{display:flex;align-items:center;justify-content:space-between;gap:0.75rem;flex-wrap:wrap;padding-top:0.75rem;border-top:1px solid rgba(255,255,255,0.06)}
.my-orders-card-items{color:rgba(234,234,234,0.5);font-size:0.8125rem}
.my-orders-card-total{color:#EAEAEA;font-weight:600;font-family:'JetBrains Mono',monospace;font-size:0.9375rem}
.my-orders-card-arrow{color:rgba(234,234,234,0.2);transition:all 0.3s;width:1.25rem;height:1.25rem;flex-shrink:0}
.my-orders-card:hover .my-orders-card-arrow{color:#00AEEF;transform:translateX(3px)}
.my-orders-empty{text-align:center;padding:4rem 1rem}
.my-orders-empty-icon{width:4rem;height:4rem;margin:0 auto 1.25rem;border-radius:50%;background:rgba(0,174,239,0.06);border:1px solid rgba(0,174,239,0.1);display:flex;align-items:center;justify-content:center}
.my-orders-empty-icon svg{width:1.5rem;height:1.5rem;color:#00AEEF}
.my-orders-empty-title{color:#EAEAEA;font-weight:600;font-size:1.125rem;margin-bottom:0.5rem}
.my-orders-empty-desc{color:rgba(234,234,234,0.4);font-size:0.875rem;max-width:24rem;margin:0 auto 1.5rem;line-height:1.6}
/* Pagination styles */
.my-orders-pagination{display:flex;align-items:center;justify-content:center;gap:0.375rem;margin-top:2rem}
.my-orders-pagination a,.my-orders-pagination span{display:inline-flex;align-items:center;justify-content:center;min-width:2.25rem;height:2.25rem;padding:0 0.5rem;font-size:0.8125rem;font-weight:500;border-radius:0.5rem;transition:all 0.2s;text-decoration:none}
.my-orders-pagination a{color:rgba(234,234,234,0.5);background:rgba(17,17,17,0.6);border:1px solid rgba(255,255,255,0.06)}
.my-orders-pagination a:hover{color:#fff;border-color:rgba(0,174,239,0.25);background:rgba(0,174,239,0.06)}
.my-orders-pagination span:not(.dots){color:#fff;background:linear-gradient(135deg,#00AEEF,#0095CC);border:none}
.my-orders-pagination .dots{color:rgba(234,234,234,0.2);background:transparent;border:none;min-width:1.5rem}
</style>

<section class="my-orders-page">
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div class="grid-bg" style="position:absolute;inset:0;opacity:0.3;pointer-events:none"></div>

    <div class="my-orders-inner">
        <!-- Header -->
        <div class="my-orders-header reveal">
            <div class="badge">
                <span class="badge-dot"></span>
                Account
            </div>
            <h1 class="section-title">My <span class="gradient-text">Orders</span></h1>
            <p class="section-subtitle">Your purchased Expert Advisors and bundles</p>
        </div>

        @if($orders->count() > 0)
            <!-- Stats Cards -->
            <div class="my-orders-stats reveal" style="transition-delay:0.05s">
                @php
                    $totalSpent = \App\Models\Order::where('user_id', Auth::id())->sum('total');
                    $completedCount = \App\Models\Order::where('user_id', Auth::id())->whereIn('status', ['completed', 'processing'])->count();
                    $pendingCount = \App\Models\Order::where('user_id', Auth::id())->where('status', 'pending')->count();
                @endphp
                <div class="my-orders-stat-card">
                    <div class="my-orders-stat-value">{{ $orders->total() }}</div>
                    <div class="my-orders-stat-label">Total Orders</div>
                </div>
                <div class="my-orders-stat-card">
                    <div class="my-orders-stat-value" style="color:#00FF9F">${{ number_format($totalSpent, 0) }}</div>
                    <div class="my-orders-stat-label">Total Spent</div>
                </div>
                <div class="my-orders-stat-card">
                    <div class="my-orders-stat-value" style="color:#00AEEF">{{ $completedCount }}</div>
                    <div class="my-orders-stat-label">Completed</div>
                </div>
            </div>

            <!-- Orders List -->
            <div class="my-orders-list">
                @foreach($orders as $order)
                <a href="{{ route('order.success', ['order' => $order->order_number]) }}" class="my-orders-card reveal group" style="text-decoration:none;display:block;transition-delay:{{ $loop->index * 0.03 }}s">
                    <div class="my-orders-card-top">
                        <div class="my-orders-card-order">
                            <span class="my-orders-card-number">{{ $order->order_number }}</span>
                            <span class="my-orders-card-date">{{ $order->created_at->format('M d, Y — h:i A') }}</span>
                        </div>
                        @php
                            $statusColors = [
                                'pending' => ['bg' => 'rgba(245,158,11,0.1)', 'border' => 'rgba(245,158,11,0.2)', 'dot' => '#f59e0b'],
                                'processing' => ['bg' => 'rgba(0,174,239,0.1)', 'border' => 'rgba(0,174,239,0.2)', 'dot' => '#00AEEF'],
                                'completed' => ['bg' => 'rgba(0,255,159,0.1)', 'border' => 'rgba(0,255,159,0.15)', 'dot' => '#00FF9F'],
                                'cancelled' => ['bg' => 'rgba(239,68,68,0.1)', 'border' => 'rgba(239,68,68,0.2)', 'dot' => '#ef4444'],
                            ];
                            $sc = $statusColors[$order->status] ?? $statusColors['pending'];
                        @endphp
                        <span style="display:inline-flex;align-items:center;gap:0.375rem;padding:0.25rem 0.75rem;border-radius:9999px;font-size:0.6875rem;font-weight:600;background:{{ $sc['bg'] }};border:1px solid {{ $sc['border'] }};color:{{ $sc['dot'] }}">
                            <span style="width:0.375rem;height:0.375rem;border-radius:50%;background:{{ $sc['dot'] }}"></span>
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                    <div class="my-orders-card-bottom">
                        <span class="my-orders-card-items">
                            {{ count($order->items ?? []) }} item{{ count($order->items ?? []) !== 1 ? 's' : '' }}
                            @if($order->items && count($order->items) > 0)
                                — <span style="color:rgba(234,234,234,0.35)">{{ implode(', ', array_column(array_slice($order->items, 0, 2), 'name')) }}{{ count($order->items) > 2 ? '…' : '' }}</span>
                            @endif
                        </span>
                        <div style="display:flex;align-items:center;gap:0.5rem">
                            <span class="my-orders-card-total">${{ number_format($order->total, 2) }}</span>
                            <svg class="my-orders-card-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($orders->hasPages())
            <div class="my-orders-pagination">
                {{ $orders->links() }}
            </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="my-orders-empty reveal">
                <div class="my-orders-empty-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </div>
                <h2 class="my-orders-empty-title">No Orders Yet</h2>
                <p class="my-orders-empty-desc">You haven't purchased any Expert Advisors yet. Explore our collection and start your trading journey today.</p>
                <a href="{{ route('forex.home') }}#pricing" class="btn-primary" style="display:inline-flex;align-items:center;gap:0.5rem;text-decoration:none">
                    Browse EAs
                    <svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        @endif
    </div>
</section>
@endsection
