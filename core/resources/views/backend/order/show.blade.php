@extends('backend.app')

@section('title', 'Order #' . $order->order_number . ' — Admin')

@section('content')
<div class="order-show-page">

    {{-- Back Link --}}
    <a href="{{ route('admin.orders.index') }}" class="order-back-link">
        <i class="bi bi-arrow-left"></i>
        Back to Orders
    </a>

    {{-- Header --}}
    <div class="order-show-header">
        <div class="order-show-header-left">
            <div class="order-show-header-icon">
                <i class="bi bi-receipt"></i>
            </div>
            <div>
                <h4 class="order-show-title">Order <span class="order-show-number">#{{ $order->order_number }}</span></h4>
                <p class="order-show-sub">Placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}</p>
            </div>
        </div>
        <div class="order-show-header-right">

            {{-- Status Update Form --}}
            <form method="POST" action="{{ route('admin.orders.status', $order->id) }}" class="order-status-form">
                @csrf
                <div class="order-status-select-wrap">
                    <i class="bi bi-pencil-square order-status-icon"></i>
                    <select name="status" class="order-status-select" onchange="this.form.submit()">
                        @foreach($statuses as $s)
                            <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>
            </form>

            {{-- Current Status Badge --}}
            <span class="status-badge status-{{ $order->status }}">
                <span class="status-dot"></span>
                {{ ucfirst($order->status) }}
            </span>
        </div>
    </div>

    {{-- Grid: Customer Info + Order Summary --}}
    <div class="order-show-grid">

        {{-- Customer Info --}}
        <div class="order-info-card">
            <div class="order-info-card-header">
                <i class="bi bi-person-circle"></i>
                <span>Customer Information</span>
            </div>
            <div class="order-info-card-body">
                <div class="order-info-row">
                    <span class="order-info-label">Name</span>
                    <span class="order-info-value">{{ $order->customer_name ?? 'Guest' }}</span>
                </div>
                <div class="order-info-divider"></div>
                <div class="order-info-row">
                    <span class="order-info-label">Email</span>
                    <span class="order-info-value">
                        @if($order->customer_email)
                            <a href="mailto:{{ $order->customer_email }}" class="order-info-email">{{ $order->customer_email }}</a>
                        @else
                            <span style="color:var(--osub)">N/A</span>
                        @endif
                    </span>
                </div>
                @if($order->user_id)
                <div class="order-info-divider"></div>
                <div class="order-info-row">
                    <span class="order-info-label">User ID</span>
                    <span class="order-info-value" style="color:var(--omuted)">#{{ $order->user_id }}</span>
                </div>
                @endif
                @if($order->notes)
                <div class="order-info-divider"></div>
                <div class="order-info-row">
                    <span class="order-info-label">Notes</span>
                    <span class="order-info-value">{{ $order->notes }}</span>
                </div>
                @endif
            </div>
        </div>

        {{-- Order Summary --}}
        <div class="order-info-card">
            <div class="order-info-card-header">
                <i class="bi bi-calculator"></i>
                <span>Order Summary</span>
            </div>
            <div class="order-info-card-body">
                <div class="order-summary-rows">
                    <div class="order-summary-row">
                        <span class="order-summary-label">Subtotal</span>
                        <span class="order-summary-value">${{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <div class="order-summary-row">
                        <span class="order-summary-label">Items</span>
                        <span class="order-summary-value">{{ count($order->items) }}</span>
                    </div>
                    <div class="order-summary-divider"></div>
                    <div class="order-summary-row order-summary-total">
                        <span class="order-summary-total-label">Total</span>
                        <span class="order-summary-total-value">${{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Order Items --}}
    <div class="order-items-card">
        <div class="order-items-card-header">
            <i class="bi bi-box-seam"></i>
            <span>Items ({{ count($order->items) }})</span>
        </div>
        <div class="order-items-list">
            @foreach($order->items as $item)
                <div class="order-item-row">
                    <div class="order-item-info">
                        <div class="order-item-name">{{ $item['name'] ?? 'Item' }}</div>
                        <div class="order-item-meta">Qty: {{ $item['qty'] ?? 1 }}</div>
                    </div>
                    <div class="order-item-pricing">
                        <div class="order-item-price">${{ number_format($item['price'] ?? 0, 2) }}</div>
                        <div class="order-item-total">${{ number_format(($item['price'] ?? 0) * ($item['qty'] ?? 1), 2) }}</div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="order-items-footer">
            <span class="order-items-footer-label">Total</span>
            <span class="order-items-footer-value">${{ number_format($order->total, 2) }}</span>
        </div>
    </div>
</div>

<style>
.order-show-page {
    --obg: #0f172a;
    --ord: rgba(255,255,255,0.04);
    --otext: #f1f5f9;
    --omuted: #94a3b8;
    --osub: #64748b;
    --oborder: rgba(255,255,255,0.08);
    --oprimary: #60A5FA;
    --oprimary-dim: rgba(96,165,250,0.12);
    --ohover: rgba(255,255,255,0.06);
    --ostatus-pending: #f59e0b;
    --ostatus-processing: #60A5FA;
    --ostatus-completed: #10b981;
    --ostatus-cancelled: #ef4444;

    padding: 24px 28px; height: 100%;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    color: var(--otext);
}

/* Back Link */
.order-back-link {
    display: inline-flex; align-items: center; gap: 6px;
    color: var(--omuted); font-size: 14px; font-weight: 500;
    text-decoration: none; margin-bottom: 20px;
    padding: 6px 14px; border-radius: 8px;
    background: var(--ord); border: 1px solid var(--oborder);
    transition: all 0.2s ease;
}
.order-back-link:hover {
    color: var(--otext);
    background: var(--ohover);
    gap: 8px;
}

/* Header */
.order-show-header {
    background: var(--ord); border: 1px solid var(--oborder);
    border-radius: 14px; padding: 18px 22px;
    backdrop-filter: blur(8px); margin-bottom: 20px;
    display: flex; flex-wrap: wrap; justify-content: space-between;
    align-items: center; gap: 16px;
}
.order-show-header-left { display: flex; align-items: center; gap: 14px; }
.order-show-header-icon {
    width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg, rgba(96,165,250,0.15), rgba(96,165,250,0.05));
    border: 1px solid rgba(96,165,250,0.12); border-radius: 12px;
    font-size: 20px; color: var(--oprimary); flex-shrink: 0;
}
.order-show-title { font-size: 18px; font-weight: 700; margin: 0 0 2px 0; }
.order-show-number { color: var(--oprimary); }
.order-show-sub { font-size: 13px; color: var(--omuted); margin: 0; }
.order-show-header-right { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }

.status-badge {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 6px 16px; border-radius: 999px;
    font-size: 13px; font-weight: 600;
}
.status-dot { width: 7px; height: 7px; border-radius: 50%; background: currentColor; }
.status-pending { background: rgba(245,158,11,0.1); color: var(--ostatus-pending); border: 1px solid rgba(245,158,11,0.15); }
.status-processing { background: rgba(96,165,250,0.1); color: var(--ostatus-processing); border: 1px solid rgba(96,165,250,0.15); }
.status-completed { background: rgba(16,185,129,0.1); color: var(--ostatus-completed); border: 1px solid rgba(16,185,129,0.15); }
.status-cancelled { background: rgba(239,68,68,0.1); color: var(--ostatus-cancelled); border: 1px solid rgba(239,68,68,0.15); }

/* Status Select */
.order-status-form { margin: 0; }
.order-status-select-wrap {
    position: relative; display: inline-flex; align-items: center;
}
.order-status-icon {
    position: absolute; left: 12px; z-index: 2;
    color: var(--omuted); font-size: 13px; pointer-events: none;
}
.order-status-select {
    padding: 8px 36px 8px 36px;
    border-radius: 8px; font-size: 13px; font-weight: 600;
    background: rgba(255,255,255,0.04);
    border: 1px solid var(--oborder); color: var(--otext);
    cursor: pointer; transition: all 0.2s ease;
    font-family: inherit;
    appearance: none; -webkit-appearance: none; -moz-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%2394a3b8' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 10px center;
    min-width: 140px;
}
.order-status-select:hover { border-color: var(--oprimary); }
.order-status-select:focus { outline: none; border-color: var(--oprimary); box-shadow: 0 0 0 3px rgba(96,165,250,0.15); }
.order-status-select option { background: #1e293b; color: var(--otext); }

/* Grid */
.order-show-grid {
    display: grid; grid-template-columns: 1fr 1fr; gap: 20px;
    margin-bottom: 20px;
}

/* Info Cards */
.order-info-card {
    background: var(--ord); border: 1px solid var(--oborder);
    border-radius: 14px; overflow: hidden; backdrop-filter: blur(8px);
}
.order-info-card-header {
    display: flex; align-items: center; gap: 8px;
    padding: 14px 20px;
    background: linear-gradient(135deg, rgba(96,165,250,0.08), rgba(96,165,250,0.02));
    border-bottom: 1px solid var(--oborder);
    font-size: 13px; font-weight: 600; color: var(--oprimary);
    text-transform: uppercase; letter-spacing: 0.4px;
}
.order-info-card-header i { font-size: 15px; }
.order-info-card-body { padding: 16px 20px; }
.order-info-row {
    display: flex; justify-content: space-between; align-items: center;
    padding: 6px 0;
}
.order-info-label { font-size: 13px; color: var(--omuted); }
.order-info-value { font-size: 14px; font-weight: 600; color: var(--otext); text-align: right; }
.order-info-email { color: var(--oprimary); text-decoration: none; transition: color 0.2s; }
.order-info-email:hover { color: #93c5fd; text-decoration: underline; }
.order-info-divider { height: 1px; background: var(--oborder); margin: 4px 0; }

/* Order Summary */
.order-summary-rows { display: flex; flex-direction: column; gap: 4px; }
.order-summary-row {
    display: flex; justify-content: space-between; align-items: center;
    padding: 6px 0;
}
.order-summary-label { font-size: 13px; color: var(--omuted); }
.order-summary-value { font-size: 14px; font-weight: 600; color: var(--otext); }
.order-summary-divider { height: 1px; background: var(--oborder); margin: 8px 0 4px; }
.order-summary-total { padding: 8px 0 4px; }
.order-summary-total-label { font-size: 15px; font-weight: 700; color: var(--otext); }
.order-summary-total-value { font-size: 20px; font-weight: 800; color: var(--oprimary); font-family: 'JetBrains Mono', 'SF Mono', monospace; }

/* Items Card */
.order-items-card {
    background: var(--ord); border: 1px solid var(--oborder);
    border-radius: 14px; overflow: hidden; backdrop-filter: blur(8px);
}
.order-items-card-header {
    display: flex; align-items: center; gap: 8px;
    padding: 14px 20px;
    background: linear-gradient(135deg, rgba(96,165,250,0.08), rgba(96,165,250,0.02));
    border-bottom: 1px solid var(--oborder);
    font-size: 13px; font-weight: 600; color: var(--oprimary);
    text-transform: uppercase; letter-spacing: 0.4px;
}
.order-items-card-header i { font-size: 15px; }
.order-items-list { padding: 0 20px; }
.order-item-row {
    display: flex; justify-content: space-between; align-items: center;
    padding: 14px 0; border-bottom: 1px solid var(--oborder);
}
.order-item-row:last-child { border-bottom: none; }
.order-item-info { }
.order-item-name { font-size: 14px; font-weight: 600; color: var(--otext); }
.order-item-meta { font-size: 12px; color: var(--osub); margin-top: 2px; }
.order-item-pricing { text-align: right; }
.order-item-price { font-size: 13px; color: var(--oprimary); font-weight: 600; font-family: 'JetBrains Mono', 'SF Mono', monospace; }
.order-item-total { font-size: 11px; color: var(--osub); margin-top: 1px; }
.order-items-footer {
    display: flex; justify-content: space-between; align-items: center;
    padding: 14px 20px;
    border-top: 1px solid var(--oborder);
    background: linear-gradient(135deg, rgba(96,165,250,0.06), rgba(96,165,250,0.02));
}
.order-items-footer-label { font-size: 14px; font-weight: 700; color: var(--otext); }
.order-items-footer-value { font-size: 20px; font-weight: 800; color: var(--oprimary); font-family: 'JetBrains Mono', 'SF Mono', monospace; }

@media (max-width: 992px) {
    .order-show-page { padding: 20px 22px; }
}
@media (max-width: 768px) {
    .order-show-page { padding: 16px; }
    .order-show-grid { grid-template-columns: 1fr; }
    .order-show-header { flex-direction: column; align-items: flex-start; }
    .order-show-header-right { width: 100%; }
    .order-show-header-right .status-badge { margin-left: auto; }
}
@media (max-width: 480px) {
    .order-show-page { padding: 12px; }
    .order-show-header { padding: 14px 16px; }
    .order-info-card-body { padding: 14px 16px; }
    .order-items-list { padding: 0 16px; }
    .order-item-row { padding: 12px 0; }
}
</style>
@endsection
