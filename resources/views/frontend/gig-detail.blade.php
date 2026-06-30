@extends('frontend.app')

@section('content')
<style>
    :root {
        --bg-primary: #0a0f1e;
        --bg-secondary: #0f172a;
        --bg-card: rgba(17, 28, 46, 0.8);
        --accent: #3b82f6;
        --accent-light: #60a5fa;
        --accent-dark: #2563eb;
        --text-primary: #e2e8f0;
        --text-secondary: #94a3b8;
        --text-muted: #64748b;
        --border-color: rgba(59, 130, 246, 0.12);
        --border-hover: rgba(59, 130, 246, 0.3);
        --radius-lg: 20px;
        --radius-xl: 24px;
        --transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    html.light-theme {
        --bg-primary: #f8fafc;
        --bg-secondary: #f1f5f9;
        --bg-card: rgba(255, 255, 255, 0.92);
        --text-primary: #0f172a;
        --text-secondary: #475569;
        --text-muted: #94a3b8;
        --border-color: rgba(59, 130, 246, 0.15);
    }
    html.light-theme body { background: #f8fafc; }

    .gig-detail-page {
        padding-top: 100px;
        padding-bottom: 4rem;
        min-height: 100vh;
        background: linear-gradient(180deg, var(--bg-primary) 0%, #080d1a 100%);
    }
    html.light-theme .gig-detail-page {
        background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
    }

    .gig-header {
        text-align: center;
        margin-bottom: 3rem;
    }
    .gig-header h1 {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #3b82f6, #a78bfa);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
    }
    .gig-header p {
        color: var(--text-secondary);
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
    }

    .gig-cover {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
        border-radius: var(--radius-xl);
        margin-bottom: 3rem;
        box-shadow: 0 20px 60px rgba(0,0,0,0.4);
        border: 1px solid var(--border-color);
    }

    .gig-description {
        max-width: 800px;
        margin: 0 auto 3rem;
        color: var(--text-secondary);
        font-size: 1.05rem;
        line-height: 1.8;
        text-align: center;
    }

    .pricing-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.8rem;
        max-width: 1100px;
        margin: 0 auto;
    }
    .pricing-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-xl);
        padding: 2rem 1.5rem;
        text-align: center;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }
    .pricing-card:hover {
        border-color: var(--border-hover);
        box-shadow: 0 10px 40px rgba(59, 130, 246, 0.15);
        transform: translateY(-4px);
    }
    .pricing-card.featured {
        border-color: #3b82f6;
        box-shadow: 0 0 40px rgba(59, 130, 246, 0.15);
        transform: scale(1.04);
    }
    .pricing-card.featured:hover {
        transform: scale(1.04) translateY(-4px);
    }
    .pricing-badge {
        display: inline-block;
        padding: 0.25rem 1rem;
        background: rgba(59, 130, 246, 0.12);
        color: var(--accent-light);
        border: 1px solid rgba(59, 130, 246, 0.25);
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }
    .pricing-card h3 {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.8rem;
    }
    .pricing-price {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--accent-light);
        margin-bottom: 1.5rem;
    }
    .pricing-features {
        list-style: none;
        padding: 0;
        margin: 0 0 1.8rem;
    }
    .pricing-features li {
        padding: 0.5rem 0;
        color: var(--text-secondary);
        font-size: 0.92rem;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    .pricing-features li:last-child { border-bottom: none; }
    .pricing-features li i { color: #22c55e; font-size: 0.9rem; }

    .btn-order {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.7rem 2rem;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        transition: var(--transition);
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }
    .btn-order:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.5);
        color: #fff;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--accent-light);
        text-decoration: none;
        font-weight: 500;
        margin-bottom: 2rem;
        transition: var(--transition);
    }
    .back-link:hover { gap: 0.8rem; color: var(--accent); }

    @media (max-width: 768px) {
        .pricing-grid { grid-template-columns: 1fr; gap: 1.4rem; }
        .pricing-card.featured { transform: none; }
        .pricing-card.featured:hover { transform: translateY(-4px); }
        .gig-header h1 { font-size: 1.8rem; }
    }
    @media (max-width: 480px) {
        .gig-detail-page { padding-top: 80px; }
        .gig-header h1 { font-size: 1.5rem; }
        .pricing-price { font-size: 1.8rem; }
    }
</style>

<div class="gig-detail-page">
    <div class="container">

        <a href="{{ route('home') }}#gigs" class="back-link">
            <i class="bi bi-arrow-left"></i> {{ __('messages.back_to_gigs') }}
        </a>

        <div class="gig-header">
            <h1>{{ $gig->title }}</h1>
            @if($gig->short_description)
                <p>{{ $gig->short_description }}</p>
            @endif
        </div>

        @if($gig->image)
            <img src="{{ config('app.storage_url') }}{{ $gig->image }}" alt="{{ $gig->title }}" class="gig-cover">
        @endif

        @if($gig->description)
            <div class="gig-description">
                {{ $gig->description }}
            </div>
        @endif

        <div class="pricing-grid">
            <div class="pricing-card">
                <span class="pricing-badge">{{ $gig->basic_name ?: 'Basic' }}</span>
                <h3>{{ $gig->basic_name ?: 'Basic' }}</h3>
                <div class="pricing-price">{{ $gig->basic_price }} USD</div>
                @if($gig->basic_features)
                    <ul class="pricing-features">
                        @foreach(explode("\n", $gig->basic_features) as $feature)
                            @if(trim($feature))
                                <li><i class="bi bi-check-circle-fill"></i> {{ trim($feature) }}</li>
                            @endif
                        @endforeach
                    </ul>
                @endif
                <form action="{{ route('inbox.order', [$gig->id, 'basic']) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-order" style="border:none; cursor:pointer;">{{ __('messages.order_now') }} <i class="bi bi-arrow-right"></i></button>
                </form>
            </div>

            <div class="pricing-card featured">
                <span class="pricing-badge">{{ $gig->standard_name ?: 'Standard' }}</span>
                <h3>{{ $gig->standard_name ?: 'Standard' }}</h3>
                <div class="pricing-price">{{ $gig->standard_price }} USD</div>
                @if($gig->standard_features)
                    <ul class="pricing-features">
                        @foreach(explode("\n", $gig->standard_features) as $feature)
                            @if(trim($feature))
                                <li><i class="bi bi-check-circle-fill"></i> {{ trim($feature) }}</li>
                            @endif
                        @endforeach
                    </ul>
                @endif
                <form action="{{ route('inbox.order', [$gig->id, 'standard']) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-order" style="border:none; cursor:pointer;">{{ __('messages.order_now') }} <i class="bi bi-arrow-right"></i></button>
                </form>
            </div>

            <div class="pricing-card">
                <span class="pricing-badge">{{ $gig->premium_name ?: 'Premium' }}</span>
                <h3>{{ $gig->premium_name ?: 'Premium' }}</h3>
                <div class="pricing-price">{{ $gig->premium_price }} USD</div>
                @if($gig->premium_features)
                    <ul class="pricing-features">
                        @foreach(explode("\n", $gig->premium_features) as $feature)
                            @if(trim($feature))
                                <li><i class="bi bi-check-circle-fill"></i> {{ trim($feature) }}</li>
                            @endif
                        @endforeach
                    </ul>
                @endif
                <form action="{{ route('inbox.order', [$gig->id, 'premium']) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-order" style="border:none; cursor:pointer;">{{ __('messages.order_now') }} <i class="bi bi-arrow-right"></i></button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
