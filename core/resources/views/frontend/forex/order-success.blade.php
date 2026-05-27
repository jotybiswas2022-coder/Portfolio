@extends('frontend.forex.layouts.app')

@section('title', 'Order Details — Core Trading Solutions')

@section('content')
<style>
/* ===== ORDER DETAILS PAGE ===== */
.order-page{min-height:100vh;padding-top:6rem;padding-bottom:4rem;position:relative;overflow:hidden}
.order-inner{max-width:56rem;margin:0 auto;padding:0 1rem;position:relative;z-index:10}
@media (min-width:640px){.order-inner{padding:0 1.5rem}}
@media (min-width:1024px){.order-inner{padding:0 2rem}}
.order-back{display:inline-flex;align-items:center;gap:0.5rem;color:rgba(234,234,234,0.4);text-decoration:none;font-size:0.875rem;margin-bottom:1.5rem;transition:all 0.2s}
.order-back:hover{color:#00AEEF}

/* Success Banner */
.order-success-banner{background:linear-gradient(135deg,rgba(0,255,159,0.04),rgba(0,174,239,0.02));border:1px solid rgba(0,255,159,0.12);border-radius:1rem;padding:2rem;margin-bottom:2rem;text-align:center;position:relative;overflow:hidden}
.order-success-banner-glow{position:absolute;top:-50%;left:-50%;width:200%;height:200%;background:radial-gradient(circle,rgba(0,255,159,0.03) 0%,transparent 60%);pointer-events:none;animation:orderPulse 4s ease-in-out infinite}
@keyframes orderPulse{0%,100%{opacity:0.5;transform:scale(1)}50%{opacity:1;transform:scale(1.1)}}
.order-success-icon{width:3.5rem;height:3.5rem;margin:0 auto 1rem;border-radius:50%;background:linear-gradient(135deg,rgba(0,255,159,0.2),rgba(0,255,159,0.05));display:flex;align-items:center;justify-content:center;position:relative}
.order-success-icon-inner{position:absolute;inset:0;border-radius:50%;background:rgba(0,255,159,0.05);animation:ping 2s cubic-bezier(0,0,0.2,1) infinite}
.order-success-icon svg{width:1.5rem;height:1.5rem;color:#00FF9F;position:relative;z-index:1}

/* Order Header Card */
.order-header-card{background:rgba(17,17,17,0.6);border:1px solid rgba(255,255,255,0.06);border-radius:1rem;padding:1.5rem;margin-bottom:1.5rem;transition:all 0.3s}
.order-header-card:hover{border-color:rgba(0,174,239,0.12)}
.order-header-top{display:flex;align-items:flex-start;justify-content:space-between;gap:1rem;flex-wrap:wrap;margin-bottom:1rem;padding-bottom:1rem;border-bottom:1px solid rgba(255,255,255,0.06)}
.order-header-number{display:flex;flex-direction:column;gap:0.125rem}
.order-header-number span:first-child{color:#00AEEF;font-family:'JetBrains Mono',monospace;font-size:1.125rem;font-weight:700}
.order-header-number span:last-child{color:rgba(234,234,234,0.3);font-size:0.8125rem}
.order-header-meta{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
@media (max-width:480px){.order-header-meta{grid-template-columns:1fr}}
.order-meta-item{display:flex;flex-direction:column;gap:0.25rem}
.order-meta-label{color:rgba(234,234,234,0.3);font-size:0.75rem;text-transform:uppercase;letter-spacing:0.05em}
.order-meta-value{color:#EAEAEA;font-size:0.9375rem;font-weight:500}

/* Items / Packages Section */
.order-section-title{display:flex;align-items:center;gap:0.625rem;color:#EAEAEA;font-weight:600;font-size:1rem;margin-bottom:1rem}
.order-section-title span{width:0.25rem;height:1rem;background:#00AEEF;border-radius:50px;display:inline-block}
.order-items{display:flex;flex-direction:column;gap:0.75rem;margin-bottom:1.5rem}
.order-item-card{display:flex;align-items:center;gap:1rem;background:rgba(13,13,13,0.4);border:1px solid rgba(255,255,255,0.04);border-radius:0.75rem;padding:1rem 1.25rem;transition:all 0.3s}
.order-item-card:hover{border-color:rgba(0,174,239,0.1);background:rgba(13,13,13,0.6)}
.order-item-icon{width:2.5rem;height:2.5rem;border-radius:0.625rem;background:linear-gradient(135deg,rgba(0,174,239,0.1),rgba(0,255,159,0.05));display:flex;align-items:center;justify-content:center;flex-shrink:0}
.order-item-icon svg{width:1.25rem;height:1.25rem;color:#00AEEF}
.order-item-info{flex:1;min-width:0}
.order-item-name{color:#EAEAEA;font-weight:500;font-size:0.9375rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.order-item-qty{color:rgba(234,234,234,0.3);font-size:0.75rem;margin-top:0.125rem}
.order-item-price{color:#EAEAEA;font-weight:600;font-family:'JetBrains Mono',monospace;font-size:0.875rem;flex-shrink:0}

/* Pricing Breakdown */
.order-pricing{background:rgba(13,13,13,0.4);border:1px solid rgba(255,255,255,0.04);border-radius:0.75rem;padding:1.25rem;margin-bottom:1.5rem}
.order-pricing-row{display:flex;align-items:center;justify-content:space-between;padding:0.5rem 0}
.order-pricing-row+.order-pricing-row{border-top:1px solid rgba(255,255,255,0.04)}
.order-pricing-label{color:rgba(234,234,234,0.4);font-size:0.875rem}
.order-pricing-value{color:rgba(234,234,234,0.7);font-family:'JetBrains Mono',monospace;font-size:0.875rem}
.order-pricing-total{border-top:1px solid rgba(255,255,255,0.1)!important;padding-top:0.75rem!important;margin-top:0.25rem}
.order-pricing-total .order-pricing-label{color:#EAEAEA;font-weight:600;font-size:1rem}
.order-pricing-total .order-pricing-value{color:#00FF9F;font-weight:700;font-size:1.125rem}

/* Customer Info */
.order-customer{display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;margin-bottom:1.5rem}
@media (max-width:480px){.order-customer{grid-template-columns:1fr}}
.order-customer-card{background:rgba(13,13,13,0.4);border:1px solid rgba(255,255,255,0.04);border-radius:0.75rem;padding:1rem 1.25rem;transition:all 0.3s}
.order-customer-card:hover{border-color:rgba(0,174,239,0.1)}

/* Timeline */
.order-timeline{background:rgba(17,17,17,0.6);border:1px solid rgba(255,255,255,0.06);border-radius:1rem;padding:1.5rem;margin-bottom:1.5rem}
.order-timeline-steps{display:flex;align-items:flex-start;gap:0;position:relative;padding:0.5rem 0}
.order-timeline-step{flex:1;text-align:center;position:relative}
.order-timeline-dot{width:1rem;height:1rem;border-radius:50%;margin:0 auto 0.5rem;position:relative;z-index:1;transition:all 0.3s}
.order-timeline-dot.active{background:#00FF9F;box-shadow:0 0 12px rgba(0,255,159,0.3)}
.order-timeline-dot.current{background:#00AEEF;box-shadow:0 0 12px rgba(0,174,239,0.3)}
.order-timeline-dot.pending{background:#2a2a2a;border:2px solid rgba(255,255,255,0.06)}
.order-timeline-line{position:absolute;top:0.5rem;left:calc(50% + 0.5rem);right:calc(-50% + 0.5rem);height:2px;background:#2a2a2a;z-index:0}
.order-timeline-line.active{background:linear-gradient(90deg,#00FF9F,#00AEEF)}
.order-timeline-label{color:rgba(234,234,234,0.3);font-size:0.6875rem;font-weight:500;white-space:nowrap}
.order-timeline-label.active{color:#00FF9F}
.order-timeline-label.current{color:#00AEEF}

/* Mobile adjustments */
@media (max-width:480px){
    .order-timeline-label{font-size:0.625rem}
}

/* No order state */
.order-empty{text-align:center;padding:4rem 1rem}
.order-empty-icon{width:4rem;height:4rem;margin:0 auto 1.25rem;border-radius:50%;background:rgba(0,174,239,0.06);border:1px solid rgba(0,174,239,0.1);display:flex;align-items:center;justify-content:center}
.order-empty-icon svg{width:1.5rem;height:1.5rem;color:#00AEEF}
.order-empty-title{color:#EAEAEA;font-weight:600;font-size:1.125rem;margin-bottom:0.5rem}
.order-empty-desc{color:rgba(234,234,234,0.4);font-size:0.875rem;max-width:24rem;margin:0 auto 1.5rem;line-height:1.6}
</style>

<section class="order-page">
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div class="grid-bg" style="position:absolute;inset:0;opacity:0.3;pointer-events:none"></div>

    <div class="order-inner">
        @if($order)
            <!-- Back link -->
            <a href="{{ route('forex.my-orders') }}" class="order-back reveal">
                <svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Back to My Orders
            </a>

            <!-- Success Banner (only on first view after placing order) -->
            @if(session('success'))
            <div class="order-success-banner reveal">
                <div class="order-success-banner-glow"></div>
                <div class="order-success-icon">
                    <div class="order-success-icon-inner"></div>
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                </div>
                <h2 style="color:#EAEAEA;font-weight:700;font-size:1.25rem;margin-bottom:0.375rem;position:relative;z-index:1">Order Placed Successfully!</h2>
                <p style="color:rgba(234,234,234,0.5);font-size:0.875rem;margin:0;position:relative;z-index:1">{{ session('success') }}</p>
            </div>
            @endif

            <!-- Order Header -->
            <div class="order-header-card reveal" style="transition-delay:0.05s">
                <div class="order-header-top">
                    <div class="order-header-number">
                        <span>{{ $order->order_number }}</span>
                        <span>Order #</span>
                    </div>
                    @php
                        $statusColors = [
                            'pending' => ['bg' => 'rgba(245,158,11,0.1)', 'border' => 'rgba(245,158,11,0.2)', 'dot' => '#f59e0b', 'text' => '#f59e0b'],
                            'processing' => ['bg' => 'rgba(0,174,239,0.1)', 'border' => 'rgba(0,174,239,0.2)', 'dot' => '#00AEEF', 'text' => '#00AEEF'],
                            'completed' => ['bg' => 'rgba(0,255,159,0.1)', 'border' => 'rgba(0,255,159,0.15)', 'dot' => '#00FF9F', 'text' => '#00FF9F'],
                            'cancelled' => ['bg' => 'rgba(239,68,68,0.1)', 'border' => 'rgba(239,68,68,0.2)', 'dot' => '#ef4444', 'text' => '#ef4444'],
                        ];
                        $sc = $statusColors[$order->status] ?? $statusColors['pending'];
                    @endphp
                    <span style="display:inline-flex;align-items:center;gap:0.375rem;padding:0.375rem 1rem;border-radius:9999px;font-size:0.75rem;font-weight:600;background:{{ $sc['bg'] }};border:1px solid {{ $sc['border'] }};color:{{ $sc['text'] }}">
                        <span style="width:0.4375rem;height:0.4375rem;border-radius:50%;background:{{ $sc['dot'] }}"></span>
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
                <div class="order-header-meta">
                    <div class="order-meta-item">
                        <span class="order-meta-label">Order Date</span>
                        <span class="order-meta-value">{{ $order->created_at->format('F d, Y') }}</span>
                    </div>
                    <div class="order-meta-item">
                        <span class="order-meta-label">Payment Status</span>
                        <span class="order-meta-value" style="color:#00FF9F;display:flex;align-items:center;gap:0.375rem">
                            <svg style="width:0.875rem;height:0.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            @if($order->status === 'pending') Awaiting Confirmation
                            @elseif($order->status === 'cancelled') Cancelled
                            @else Completed
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Purchased Items / Packages -->
            <div class="reveal" style="transition-delay:0.1s">
                <div class="order-section-title">
                    <span></span>
                    Purchased Items ({{ count($order->items ?? []) }})
                </div>
                <div class="order-items">
                    @foreach($order->items as $item)
                    <div class="order-item-card">
                        <div class="order-item-icon">
                            @php $itemName = strtolower($item['name'] ?? ''); @endphp
                            @if(str_contains($itemName, 'bundle') || str_contains($itemName, 'starter') || str_contains($itemName, 'premium') || str_contains($itemName, 'advanced'))
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            @elseif(str_contains($itemName, 'dark'))
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            @else
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            @endif
                        </div>
                        <div class="order-item-info">
                            <div class="order-item-name">{{ $item['name'] ?? 'Item' }}</div>
                            <div class="order-item-qty">Qty: {{ $item['qty'] ?? 1 }}</div>
                        </div>
                        <span class="order-item-price">${{ number_format(($item['price'] ?? 0) * ($item['qty'] ?? 1), 2) }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Pricing Breakdown -->
            <div class="order-pricing reveal" style="transition-delay:0.15s">
                <div style="margin-bottom:0.5rem;color:rgba(234,234,234,0.4);font-size:0.75rem;text-transform:uppercase;letter-spacing:0.05em">Pricing Summary</div>
                <div class="order-pricing-row">
                    <span class="order-pricing-label">Subtotal</span>
                    <span class="order-pricing-value">${{ number_format($order->subtotal, 2) }}</span>
                </div>
                <div class="order-pricing-row">
                    <span class="order-pricing-label" style="display:flex;align-items:center;gap:0.375rem">
                        <svg style="width:0.875rem;height:0.875rem;color:#00FF9F" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        One-Time Payment
                    </span>
                    <span class="order-pricing-value" style="color:#00FF9F">Lifetime Access</span>
                </div>
                <div class="order-pricing-row order-pricing-total">
                    <span class="order-pricing-label">Total Paid</span>
                    <span class="order-pricing-value">${{ number_format($order->total, 2) }}</span>
                </div>
            </div>

            <!-- Customer Information -->
            <div class="reveal" style="transition-delay:0.2s">
                <div class="order-section-title">
                    <span></span>
                    Customer Details
                </div>
                <div class="order-customer">
                    @if($order->customer_name)
                    <div class="order-customer-card">
                        <div style="display:flex;align-items:center;gap:0.625rem;margin-bottom:0.5rem">
                            <div style="width:1.75rem;height:1.75rem;border-radius:50%;background:linear-gradient(135deg,#00AEEF,#00FF9F);display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:700;color:#0D0D0D">{{ substr($order->customer_name, 0, 1) }}</div>
                            <span style="color:#EAEAEA;font-weight:500;font-size:0.875rem">{{ $order->customer_name }}</span>
                        </div>
                        <span style="color:rgba(234,234,234,0.3);font-size:0.75rem">Full Name</span>
                    </div>
                    @endif
                    @if($order->customer_email)
                    <div class="order-customer-card">
                        <div style="display:flex;align-items:center;gap:0.625rem;margin-bottom:0.5rem">
                            <svg style="width:1.25rem;height:1.25rem;color:#00AEEF;flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span style="color:#EAEAEA;font-size:0.875rem">{{ $order->customer_email }}</span>
                        </div>
                        <span style="color:rgba(234,234,234,0.3);font-size:0.75rem">Email Address</span>
                    </div>
                    @endif
                    @if($order->notes)
                    <div class="order-customer-card" style="grid-column:1/-1">
                        <div style="display:flex;align-items:flex-start;gap:0.625rem">
                            <svg style="width:1.25rem;height:1.25rem;color:#f59e0b;flex-shrink:0;margin-top:0.125rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                            <div>
                                <span style="color:#EAEAEA;font-size:0.875rem">{{ $order->notes }}</span>
                                <div style="color:rgba(234,234,234,0.3);font-size:0.75rem;margin-top:0.25rem">Order Notes</div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Order Timeline -->
            @php
                $timelineSteps = [
                    ['key' => 'placed', 'label' => 'Placed'],
                    ['key' => 'processing', 'label' => 'Processing'],
                    ['key' => 'completed', 'label' => 'Completed'],
                ];
                $currentStatus = $order->status;
                $statusOrder = ['pending' => 0, 'processing' => 1, 'completed' => 2, 'cancelled' => -1];
                $stepIndex = $statusOrder[$currentStatus] ?? 0;
            @endphp
            <div class="order-timeline reveal" style="transition-delay:0.25s">
                <div class="order-section-title" style="margin-bottom:1.5rem">
                    <span></span>
                    Order Timeline
                </div>
                <div class="order-timeline-steps">
                    @foreach($timelineSteps as $i => $step)
                    <div class="order-timeline-step">
                        @php
                            $isActive = $i <= $stepIndex;
                            $isCurrent = $i === $stepIndex;
                        @endphp
                        @if($currentStatus === 'cancelled')
                            @php
                                $isActive = $i === 0;
                                $isCurrent = false;
                            @endphp
                        @endif
                        <div class="order-timeline-dot {{ $isActive ? ($isCurrent ? 'current' : 'active') : 'pending' }}"></div>
                        <div class="order-timeline-label {{ $isActive ? ($isCurrent ? 'current' : 'active') : '' }}">{{ $step['label'] }}</div>
                        @if(!$loop->last)
                        <div class="order-timeline-line {{ $stepIndex > $i && $currentStatus !== 'cancelled' ? 'active' : '' }}"></div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @if($currentStatus === 'cancelled')
                <div style="text-align:center;margin-top:1rem;padding:0.75rem;background:rgba(239,68,68,0.06);border:1px solid rgba(239,68,68,0.1);border-radius:0.5rem;color:#ef4444;font-size:0.8125rem;display:flex;align-items:center;justify-content:center;gap:0.5rem">
                    <svg style="width:1rem;height:1rem;flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                    This order has been cancelled
                </div>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="reveal" style="transition-delay:0.3s;display:flex;flex-wrap:wrap;gap:0.75rem;justify-content:center;margin-top:1.5rem">
                <a href="{{ route('forex.home') }}#pricing" class="btn-primary" style="display:inline-flex;align-items:center;gap:0.5rem;text-decoration:none">
                    <svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                    Continue Shopping
                </a>
                <a href="{{ route('forex.my-orders') }}" class="btn-outline" style="display:inline-flex;align-items:center;gap:0.5rem;text-decoration:none">
                    <svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    All Orders
                </a>
            </div>

        @else
            <!-- Empty / No Order State (fallback) -->
            <div class="order-empty reveal">
                <div class="order-empty-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h2 class="order-empty-title">Order Not Found</h2>
                <p class="order-empty-desc">The order you're looking for could not be found. It may have been removed or the link may be invalid.</p>
                <a href="{{ route('forex.home') }}#pricing" class="btn-primary" style="display:inline-flex;align-items:center;gap:0.5rem;text-decoration:none">
                    Browse Expert Advisors
                    <svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        @endif
    </div>
</section>
@endsection
