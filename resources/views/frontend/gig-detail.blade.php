@extends('frontend.app')

@section('content')
<style>
    /* ===== CSS VARIABLES (self-contained for theme) ===== */
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
        --radius-sm: 8px;
        --radius-md: 12px;
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

    /* ===== PAGE LAYOUT ===== */
    .gig-detail-page {
        padding-top: 100px;
        padding-bottom: 5rem;
        min-height: 100vh;
        background: linear-gradient(180deg, var(--bg-primary) 0%, #080d1a 100%);
    }
    html.light-theme .gig-detail-page {
        background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
    }

    .gig-container {
        max-width: 1100px;
        margin: 0 auto;
    }

    /* ===== BACK BUTTON ===== */
    .top-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.55rem 1.2rem;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        color: var(--text-secondary);
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
    }
    .back-link:hover {
        border-color: var(--border-hover);
        color: var(--accent-light);
        transform: translateX(-4px);
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.08);
    }

    /* ===== HERO / COVER IMAGE ===== */
    .gig-hero {
        position: relative;
        width: 100%;
        border-radius: var(--radius-xl);
        overflow: hidden;
        margin-bottom: 2.5rem;
        border: 1px solid var(--border-color);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        background: var(--bg-secondary);
    }
    .gig-hero .image-wrapper {
        position: relative;
        width: 100%;
        /* 16:9 aspect ratio */
        aspect-ratio: 16 / 9;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .gig-hero .image-wrapper img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .gig-hero:hover .image-wrapper img {
        transform: scale(1.04);
    }
    /* Gradient overlay at bottom */
    .gig-hero .hero-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 60%;
        background: linear-gradient(0deg, rgba(10, 15, 30, 0.85) 0%, transparent 100%);
        pointer-events: none;
    }
    html.light-theme .gig-hero .hero-overlay {
        background: linear-gradient(0deg, rgba(248, 250, 252, 0.85) 0%, transparent 100%);
    }
    /* Hero text on image */
    .gig-hero .hero-text {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 2.5rem 2.5rem 2rem;
        z-index: 2;
    }
    .gig-hero .hero-text h1 {
        font-size: 2.2rem;
        font-weight: 800;
        color: #fff;
        margin: 0 0 0.5rem;
        letter-spacing: -0.5px;
        text-shadow: 0 2px 20px rgba(0, 0, 0, 0.4);
    }
    html.light-theme .gig-hero .hero-text h1 {
        color: var(--text-primary);
        text-shadow: none;
    }
    .gig-hero .hero-text p {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.8);
        margin: 0;
        max-width: 600px;
        line-height: 1.6;
    }
    html.light-theme .gig-hero .hero-text p {
        color: var(--text-secondary);
    }

    /* Floating badge on image */
    .gig-hero .hero-badge {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        z-index: 2;
        display: flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.4rem 1rem;
        background: rgba(10, 15, 30, 0.6);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 50px;
        color: #fff;
        font-size: 0.78rem;
        font-weight: 600;
    }
    html.light-theme .gig-hero .hero-badge {
        background: rgba(248, 250, 252, 0.7);
        border-color: rgba(59, 130, 246, 0.15);
        color: var(--text-primary);
    }
    .gig-hero .hero-badge i {
        color: var(--accent-light);
    }

    /* ===== DESCRIPTION ===== */
    .gig-description-wrap {
        max-width: 800px;
        margin: 0 auto 3.5rem;
    }
    .gig-description-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 2rem 2.5rem;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .gig-description-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 3px;
        height: 100%;
        background: linear-gradient(180deg, #3b82f6, #8b5cf6);
        border-radius: 0 3px 3px 0;
    }
    .gig-description-card:hover {
        border-color: var(--border-hover);
        box-shadow: 0 8px 30px rgba(59, 130, 246, 0.05);
    }
    .gig-description-card .desc-label {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--accent-light);
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .gig-description-card .desc-label i {
        font-size: 0.85rem;
    }
    .gig-description-card .desc-text {
        color: var(--text-secondary);
        font-size: 1rem;
        line-height: 1.8;
        margin: 0;
        white-space: pre-line;
    }

    /* ===== PRICING SECTION ===== */
    .pricing-section-title {
        text-align: center;
        margin-bottom: 2.5rem;
    }
    .pricing-section-title h2 {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 0.4rem;
        letter-spacing: -0.5px;
    }
    .pricing-section-title p {
        color: var(--text-secondary);
        font-size: 0.95rem;
        margin: 0;
    }
    .pricing-section-title .title-line {
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, #3b82f6, #8b5cf6);
        margin: 0.8rem auto 0;
        border-radius: 2px;
    }

    .pricing-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.8rem;
        max-width: 1100px;
        margin: 0 auto;
    }

    /* ===== PRICING CARD ===== */
    .pricing-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-xl);
        padding: 2.2rem 1.8rem 2rem;
        text-align: center;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        display: flex;
        flex-direction: column;
    }
    /* Glass shine */
    .pricing-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at var(--shine-x, 50%) var(--shine-y, 50%), rgba(59, 130, 246, 0.06), transparent 60%);
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.5s ease;
        border-radius: inherit;
    }
    .pricing-card:hover::before {
        opacity: 1;
    }
    .pricing-card:hover {
        border-color: var(--border-hover);
        box-shadow: 0 12px 40px rgba(59, 130, 246, 0.08);
        transform: translateY(-6px);
    }
    .pricing-card:active {
        transform: translateY(-3px);
    }

    /* Featured (Standard) card */
    .pricing-card.featured {
        border-color: rgba(59, 130, 246, 0.3);
        box-shadow: 0 0 40px rgba(59, 130, 246, 0.08), 0 10px 40px rgba(0, 0, 0, 0.15);
        transform: scale(1.04);
        z-index: 2;
    }
    .pricing-card.featured:hover {
        transform: scale(1.04) translateY(-6px);
        box-shadow: 0 0 60px rgba(59, 130, 246, 0.12), 0 16px 50px rgba(0, 0, 0, 0.2);
    }
    .pricing-card.featured .featured-tag {
        position: absolute;
        top: 0.8rem;
        right: -2.5rem;
        transform: rotate(45deg);
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        color: #fff;
        padding: 0.3rem 2.8rem;
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }

    /* Top accent line */
    .pricing-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 1.5rem;
        right: 1.5rem;
        height: 2px;
        background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.3), transparent);
        border-radius: 0 0 2px 2px;
        transition: opacity 0.3s ease;
    }
    .pricing-card.featured::after {
        background: linear-gradient(90deg, transparent, #3b82f6, #8b5cf6, transparent);
        opacity: 1;
    }

    .pricing-card .pkg-icon {
        width: 48px;
        height: 48px;
        margin: 0 auto 0.8rem;
        background: rgba(59, 130, 246, 0.08);
        border: 1px solid rgba(59, 130, 246, 0.1);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        color: var(--accent-light);
        transition: all 0.4s ease;
        position: relative;
        z-index: 1;
    }
    .pricing-card:hover .pkg-icon {
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        border-color: transparent;
        color: #fff;
        transform: scale(1.1) rotate(-3deg);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.25);
    }

    .pricing-card .pkg-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.3rem;
        position: relative;
        z-index: 1;
    }
    .pricing-card .pkg-subtitle {
        font-size: 0.78rem;
        color: var(--text-muted);
        margin-bottom: 1rem;
        position: relative;
        z-index: 1;
    }

    .pricing-card .pkg-price {
        font-size: 2.4rem;
        font-weight: 800;
        color: var(--accent-light);
        line-height: 1;
        margin-bottom: 0.25rem;
        position: relative;
        z-index: 1;
    }
    .pricing-card .pkg-price .currency {
        font-size: 1.2rem;
        font-weight: 600;
        vertical-align: super;
    }
    .pricing-card .pkg-duration {
        font-size: 0.78rem;
        color: var(--text-muted);
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 1;
    }

    /* Divider */
    .pricing-card .pkg-divider {
        width: 60%;
        height: 1px;
        margin: 0 auto 1.2rem;
        background: linear-gradient(90deg, transparent, var(--border-color), transparent);
        position: relative;
        z-index: 1;
    }

    /* Features list */
    .pricing-features {
        list-style: none;
        padding: 0;
        margin: 0 0 1.5rem;
        flex: 1;
        position: relative;
        z-index: 1;
    }
    .pricing-features li {
        padding: 0.6rem 0.5rem;
        color: var(--text-secondary);
        font-size: 0.88rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        border-bottom: 1px solid var(--border-color);
        transition: all 0.3s ease;
    }
    .pricing-features li:last-child { border-bottom: none; }
    .pricing-features li i {
        color: #22c55e;
        font-size: 0.85rem;
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }
    .pricing-card:hover .pricing-features li i {
        transform: scale(1.2);
    }
    .pricing-features li .feature-text {
        flex: 1;
        text-align: left;
    }

    /* Order button */
    .btn-order {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        width: 100%;
        padding: 0.8rem 1.5rem;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: #fff;
        border: none;
        border-radius: 14px;
        font-weight: 700;
        font-size: 0.95rem;
        font-family: 'Inter', sans-serif;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.25);
        position: relative;
        overflow: hidden;
        z-index: 1;
    }
    .btn-order::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.12), transparent);
        transition: left 0.6s ease;
    }
    .btn-order:hover::before { left: 100%; }
    .btn-order:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 8px 30px rgba(59, 130, 246, 0.4);
        color: #fff;
    }
    .btn-order:active {
        transform: translateY(-1px) scale(0.98);
    }
    .btn-order i {
        font-size: 1rem;
        transition: transform 0.4s ease;
    }
    .btn-order:hover i {
        transform: translateX(4px);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 968px) {
        .pricing-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }
        .pricing-card.featured {
            transform: none;
            grid-column: 1 / -1;
            max-width: 500px;
            margin: 0 auto;
        }
        .pricing-card.featured:hover {
            transform: translateY(-6px);
        }
        .gig-hero .hero-text h1 { font-size: 1.8rem; }
        .gig-hero .hero-text { padding: 2rem 1.8rem 1.5rem; }
    }
    @media (max-width: 768px) {
        .gig-detail-page { padding-top: 85px; }
        .pricing-grid { grid-template-columns: 1fr; gap: 1.4rem; }
        .pricing-card.featured { max-width: 100%; }
        .gig-hero .hero-text h1 { font-size: 1.5rem; }
        .gig-hero .hero-text p { font-size: 0.9rem; }
        .gig-hero .hero-text { padding: 1.5rem 1.2rem 1.2rem; }
        .gig-description-card { padding: 1.5rem 1.2rem; }
        .gig-description-card .desc-text { font-size: 0.92rem; }
    }
    @media (max-width: 480px) {
        .gig-detail-page { padding-top: 75px; }
        .gig-hero .hero-text h1 { font-size: 1.3rem; }
        .gig-hero .hero-text p { font-size: 0.82rem; }
        .gig-hero .hero-text { padding: 1.2rem 1rem 1rem; }
        .gig-hero .hero-badge { top: 1rem; right: 1rem; font-size: 0.7rem; padding: 0.3rem 0.8rem; }
        .pricing-card { padding: 1.8rem 1.2rem 1.5rem; }
        .pricing-card .pkg-price { font-size: 2rem; }
        .top-bar { margin-bottom: 1.5rem; }
        .pricing-section-title h2 { font-size: 1.4rem; }
    }
</style>

<div class="gig-detail-page">
    <div class="container">
        <div class="gig-container">

            {{-- Top Bar --}}
            <div class="top-bar">
                <a href="{{ route('home') }}#gigs" class="back-link">
                    <i class="bi bi-arrow-left"></i> {{ __('messages.back_to_gigs') }}
                </a>
            </div>

            {{-- Hero Image + Title --}}
            <div class="gig-hero">
                <div class="image-wrapper">
                    @if($gig->image)
                        <img src="{{ config('app.storage_url') }}{{ $gig->image }}" alt="{{ $gig->title }}">
                    @else
                        <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background:linear-gradient(135deg, rgba(59,130,246,0.05), rgba(139,92,246,0.05)); color:var(--text-muted); font-size:4rem;">
                            <i class="bi bi-image"></i>
                        </div>
                    @endif
                </div>
                <div class="hero-overlay"></div>

                {{-- Badge on image --}}
                <div class="hero-badge">
                    <i class="bi bi-star-fill"></i> {{ __('messages.premium_service') ?? 'Premium Service' }}
                </div>

                {{-- Text overlayed --}}
                <div class="hero-text">
                    <h1>{{ $gig->title }}</h1>
                    @if($gig->short_description)
                        <p>{{ $gig->short_description }}</p>
                    @endif
                </div>
            </div>

            {{-- Description --}}
            @if($gig->description)
                <div class="gig-description-wrap">
                    <div class="gig-description-card">
                        <div class="desc-label">
                            <i class="bi bi-info-circle"></i> {{ __('messages.about_this_gig') ?? 'About This Gig' }}
                        </div>
                        <p class="desc-text">{{ $gig->description }}</p>
                    </div>
                </div>
            @endif

            {{-- Pricing Section --}}
            <div class="pricing-section-title">
                <h2>{{ __('messages.pricing_plans') ?? 'Choose Your Plan' }}</h2>
                <p>{{ __('messages.choose_package') ?? 'Select the perfect package for your project needs' }}</p>
                <div class="title-line"></div>
            </div>

            <div class="pricing-grid">
                {{-- Basic --}}
                <div class="pricing-card">
                    <div class="pkg-icon"><i class="bi bi-rocket-takeoff"></i></div>
                    <div class="pkg-name">{{ $gig->basic_name ?: 'Basic' }}</div>
                    <div class="pkg-subtitle">{{ __('messages.starter_package') ?? 'Starter Package' }}</div>
                    <div class="pkg-price">
                        <span class="currency">$</span>{{ number_format($gig->basic_price, 0) }}
                    </div>
                    <div class="pkg-duration">{{ __('messages.one_time') ?? 'One Time' }}</div>
                    <div class="pkg-divider"></div>
                    @if($gig->basic_features)
                        <ul class="pricing-features">
                            @foreach(explode("\n", $gig->basic_features) as $feature)
                                @if(trim($feature))
                                    <li>
                                        <i class="bi bi-check-circle-fill"></i>
                                        <span class="feature-text">{{ trim($feature) }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                    <form action="{{ route('inbox.order', [$gig->id, 'basic']) }}" method="POST" style="position:relative; z-index:1;">
                        @csrf
                        <button type="submit" class="btn-order">
                            {{ __('messages.order_now') }} <i class="bi bi-arrow-right"></i>
                        </button>
                    </form>
                </div>

                {{-- Standard (Featured) --}}
                <div class="pricing-card featured">
                    <div class="featured-tag">{{ __('messages.popular') ?? 'Popular' }}</div>
                    <div class="pkg-icon"><i class="bi bi-stars"></i></div>
                    <div class="pkg-name">{{ $gig->standard_name ?: 'Standard' }}</div>
                    <div class="pkg-subtitle">{{ __('messages.best_value') ?? 'Best Value' }}</div>
                    <div class="pkg-price">
                        <span class="currency">$</span>{{ number_format($gig->standard_price, 0) }}
                    </div>
                    <div class="pkg-duration">{{ __('messages.one_time') ?? 'One Time' }}</div>
                    <div class="pkg-divider"></div>
                    @if($gig->standard_features)
                        <ul class="pricing-features">
                            @foreach(explode("\n", $gig->standard_features) as $feature)
                                @if(trim($feature))
                                    <li>
                                        <i class="bi bi-check-circle-fill"></i>
                                        <span class="feature-text">{{ trim($feature) }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                    <form action="{{ route('inbox.order', [$gig->id, 'standard']) }}" method="POST" style="position:relative; z-index:1;">
                        @csrf
                        <button type="submit" class="btn-order">
                            {{ __('messages.order_now') }} <i class="bi bi-arrow-right"></i>
                        </button>
                    </form>
                </div>

                {{-- Premium --}}
                <div class="pricing-card">
                    <div class="pkg-icon"><i class="bi bi-gem"></i></div>
                    <div class="pkg-name">{{ $gig->premium_name ?: 'Premium' }}</div>
                    <div class="pkg-subtitle">{{ __('messages.premium_package') ?? 'Premium Package' }}</div>
                    <div class="pkg-price">
                        <span class="currency">$</span>{{ number_format($gig->premium_price, 0) }}
                    </div>
                    <div class="pkg-duration">{{ __('messages.one_time') ?? 'One Time' }}</div>
                    <div class="pkg-divider"></div>
                    @if($gig->premium_features)
                        <ul class="pricing-features">
                            @foreach(explode("\n", $gig->premium_features) as $feature)
                                @if(trim($feature))
                                    <li>
                                        <i class="bi bi-check-circle-fill"></i>
                                        <span class="feature-text">{{ trim($feature) }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                    <form action="{{ route('inbox.order', [$gig->id, 'premium']) }}" method="POST" style="position:relative; z-index:1;">
                        @csrf
                        <button type="submit" class="btn-order">
                            {{ __('messages.order_now') }} <i class="bi bi-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    // Glass shine follow cursor on pricing cards
    document.querySelectorAll('.pricing-card').forEach(card => {
        card.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = ((e.clientX - rect.left) / rect.width) * 100;
            const y = ((e.clientY - rect.top) / rect.height) * 100;
            this.style.setProperty('--shine-x', x + '%');
            this.style.setProperty('--shine-y', y + '%');
        });
    });
</script>
@endsection
